<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\TransactionMessageFile;
use App\Notifications\DatabaseNotify;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Transaction\MessageRepositoryInterface;
use App\Repositories\Transaction\ReviewRepositoryInterface;
use App\Repositories\Transaction\SaleRepositoryInterface;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotification;


class TransactionController extends Controller
{
    /**
     * @var TransactionRepositoryInterface
     */
    private $transactionRepository;
    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepository;
    /**
     * @var ServiceRepositoryInterface
     */
    private $serviceRepository;
    /**
     * @var SaleRepositoryInterface
     */
    private $saleRepository;
    /**
     * @var ReviewRepositoryInterface
     */
    private $reviewRepository;

    /**
     * TransactionController constructor.
     * @param TransactionRepositoryInterface $transactionRepository
     * @param MessageRepositoryInterface $messageRepository
     * @param ServiceRepositoryInterface $serviceRepository
     * @param SaleRepositoryInterface $saleRepository
     * @param ReviewRepositoryInterface $reviewRepository
     */
    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        MessageRepositoryInterface $messageRepository,
        ServiceRepositoryInterface $serviceRepository,
        SaleRepositoryInterface $saleRepository,
        ReviewRepositoryInterface $reviewRepository
    )
    {
        $this->transactionRepository = $transactionRepository;
        $this->messageRepository = $messageRepository;
        $this->serviceRepository = $serviceRepository;
        $this->saleRepository = $saleRepository;
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * (サービス利用時) 取引を開始する
     *
     * @param TransactionRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TransactionRequest $request)
    {
        $service = $this->serviceRepository->getOne($request->get('service_id'));
        if (empty($service)) {
            abort(404);
        }

        // 決済
        Stripe::setApiKey(config('payment.stripe.secret_key'));
        $customer = Customer::create(array(
            'email' => $request->stripeEmail,
            'source' => $request->stripeToken
        ));
        $charge = Charge::create(array(
            'customer' => $customer->id,
            'amount' => $service->price,
            'currency' => 'jpy'
        ));

        // 取引登録
        $transaction = $this->transactionRepository->store([
            'service_id' => $service->id,
            'seller_user_id' => $service->user_id,
            'buyer_user_id' => auth()->user()->id,
        ]);
        // 売上登録
        $this->saleRepository->store([
            'transaction_id' => $transaction->id,
            'category_id' => $service->category_id,
            'title' => $service->title,
            'content' => $service->content,
            'price' => $service->price,
            'fee' => $service->price * 0.1, // 手数料は1割
            'request_for_purchase' => $service->request_for_purchase,
            'stripe_charge_id' => $charge->id,
        ]);

        /**
         * 通知関連
         */
        $fromUser = auth()->user();
        $title = "提供している商品の利用通知";
        $text = "提供している商品が{$fromUser->name}に利用されました。\n";
        $url = route('front.transactions.messages.show', ['transaction' => $transaction]);
        // メール通知
        Mail::to($transaction->to_user->email)->send(
            new MailNotification(
                $title,
                "{$transaction->to_user->name}さん\n\n". $text. "以下のURLからやりとりをおこないサービスを提供してください。\n",
                $url
            )
        );
        // データベース通知
        $transaction->to_user->notify(
            new DatabaseNotify(
                $title,
                $text,
                $url
            )
        );

        return redirect(route('front.transactions.messages.show', ['transaction' => $transaction]));
    }

    /**
     * 取引メッセージ詳細
     *
     * @param Transaction $transaction
     * @return \Illuminate\View\View
     */
    public function showMessages(Transaction $transaction)
    {
        // 関係ない人は見れないように
        if ($transaction->seller_user_id !== auth()->user()->id
            && $transaction->buyer_user_id !== auth()->user()->id) {
            abort(404);
        }

        // 既読にする
        $this->messageRepository->updateMessagesToRead($transaction->id);

        return view('front.transactions.messages.show', compact('transaction'));
    }

    /**
     * 取引メッセージ送信
     *
     * @param Transaction $transaction
     * @param MessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessage(Transaction $transaction, MessageRequest $request)
    {
        // ユーザーID取得
        $fromUserId = auth()->user()->id;
        $toUserId =
            $transaction->seller_user_id !== $fromUserId ? $transaction->seller_user_id : $transaction->buyer_user_id;

        // メッセージ登録
        $this->messageRepository->storeMessage($transaction->id, $request->all()
            + [
                'from_user_id' => $fromUserId,
                'to_user_id' => $toUserId
            ]);

        // statusが1の場合、取引レコードを解決済みステータスに更新
        $request->get('status') == Transaction::STATUS_COMPLETE &&
            $this->transactionRepository->update($transaction->id, ['status' => $request->get('status')]);

        /**
         * 通知関連
         */
        $fromUser = auth()->user();
        $url = route('front.transactions.messages.show', ['transaction' => $transaction]);
        // 解決済みにする場合
        if ($request->get('status') == 1) {
            $title = "サービスの提供完了通知";
            $text = $textDb = "{$fromUser->name}から利用したサービスの提供が完了しました。\n\n商品の評価登録をおこなってください。\n";
        } else {
            $title = "{$fromUser->name}から取引メッセージが届いています";
            $text = "{$fromUser->name}から取引メッセージが届いています。\n\n";
            $textDb = $request->get('content');
        }
        // メール送信
        Mail::to($transaction->to_user->email)->send(
            new MailNotification(
                $title,
                "{$transaction->to_user->name}さん\n\n". $text. "以下のURLから内容を確認してください。\n",
                $url
            )
        );
        // データベース通知
        $transaction->to_user->notify(
            new DatabaseNotify(
                $title,
                $textDb,
                $url
            )
        );

        return redirect(route('front.transactions.messages.show', ['transaction' => $transaction]));
    }

    /**
     * メッセージ添付ファイルをダウンロード
     *
     * @param TransactionMessageFile $file
     * @return mixed
     */
    public function download(TransactionMessageFile $file)
    {
        // 関係ない人はダウンロードできないように
        $transaction = $file->transactionMessage->transaction;
        if ($transaction->seller_user_id !== auth()->user()->id
            && $transaction->buyer_user_id !== auth()->user()->id) {
            abort(404);
        }

        return Storage::disk('public')
            ->download($file->file_path, $file->file_name);
    }

    /**
     * 取引評価フォーム
     *
     * @param Transaction $transaction
     * @return \Illuminate\View\View
     */
    public function review(Transaction $transaction)
    {
        // 関係ない人は見れないように
        if ($transaction->seller_user_id !== auth()->user()->id
            && $transaction->buyer_user_id !== auth()->user()->id) {
            abort(404);
        }

        // TODO: 解決済みになっていない取引は弾く


        return view('front.transactions.review', compact('transaction'));
    }

    /**
     * 取引評価登録
     *
     * @param Transaction $transaction
     * @param ReviewRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeReview(Transaction $transaction, ReviewRequest $request)
    {

        // 関係ない人は見れないように
        if ($transaction->seller_user_id !== auth()->user()->id
            && $transaction->buyer_user_id !== auth()->user()->id) {
            abort(404);
        }

        $toUserId =
            $transaction->seller_user_id !== auth()->user()->id ? $transaction->seller_user_id : $transaction->buyer_user_id;
        $this->reviewRepository->store($request->all() +
            [
                'transaction_id' => $transaction->id,
                'from_user_id' => auth()->user()->id,
                'to_user_id' => $toUserId
            ]);

        /**
         * 通知関連
         */
        $title = "{$transaction->service->title}の評価通知";
        $text = "{$transaction->service->title}の評価がおこなわれました。\n";
        $url = route('front.transactions.messages.show', ['transaction' => $transaction]);
        // メール通知
        Mail::to($transaction->to_user->email)->send(
            new MailNotification(
                $title,
                "{$transaction->to_user->name}さん\n\n". $text. "以下のURLから内容を確認してください。\n",
                $url
            )
        );
        // データベース通知
        $transaction->to_user->notify(
            new DatabaseNotify(
                $title,
                $text,
                $url
            )
        );

        return redirect($url)->with('message', '評価を登録しました');
    }

    /**
     * キャンセルリクエスト
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelRequest(Transaction $transaction)
    {
        $this->transactionRepository->update($transaction->id,
            [
                'status' => Transaction::STATUS_CANCEL_REQUEST,
                'cancel_by_user_id' => auth()->user()->id
            ]
        );

        /**
         * 通知関連
         */
        $title = "{$transaction->service->title}のキャンセルリクエスト通知";
        $text = "{$transaction->service->title}のキャンセルリクエストが届きました。\n";
        $url = route('front.transactions.messages.show', ['transaction' => $transaction]);
        // メール通知
        Mail::to($transaction->to_user->email)->send(
            new MailNotification(
                $title,
                "{$transaction->to_user->name}さん\n\n". $text. "以下のURLから内容を確認してください。\n",
                $url
            )
        );
        // データベース通知
        $transaction->to_user->notify(
            new DatabaseNotify(
                $title,
                $text,
                $url
            )
        );

        return redirect(route('front.transactions.messages.show', ['transaction' => $transaction]))->with('message', 'キャンセルリクエストを送信しました');
    }

    /**
     * キャンセルリクエスト承認
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelApproval(Transaction $transaction)
    {
        $this->transactionRepository->update($transaction->id, ['status' => Transaction::STATUS_CANCEL]);

        /**
         * 通知関連
         */
        $title = "{$transaction->service->title}のキャンセルリクエスト承認通知";
        $text = "{$transaction->service->title}のキャンセルリクエストが承認されました。\n";
        $url = route('front.transactions.messages.show', ['transaction' => $transaction]);
        // メール通知
        Mail::to($transaction->to_user->email)->send(
            new MailNotification(
                $title,
                "{$transaction->to_user->name}さん\n\n". $text. "以下のURLから内容を確認してください。\n",
                $url
            )
        );
        // データベース通知
        $transaction->to_user->notify(
            new DatabaseNotify(
                $title,
                $text,
                $url
            )
        );

        // 管理者に通知
        Mail::to(config('mail.admin_address'))->send(
            new MailNotification(
                "【重要】返金依頼通知",
                "取引ID: {$transaction->id}の取引がキャンセルになりました。\n\n下記のIDに紐づく決済の返金処理を、Stripe管理画面より行ってください。\n{$transaction->sale->stripe_charge_id}\n")
        );

        return redirect(route('front.transactions.messages.show', ['transaction' => $transaction]))->with('message', 'キャンセルリクエストを承認しました');
    }

    /**
     * キャンセルリクエスト否認
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelDisapproval(Transaction $transaction)
    {
        $this->transactionRepository->update($transaction->id, ['status' => null]);

        /**
         * 通知関連
         */
        $title = "{$transaction->service->title}のキャンセルリクエスト否認通知";
        $text = "{$transaction->service->title}のキャンセルリクエストが否認されました。\n";
        $url = route('front.transactions.messages.show', ['transaction' => $transaction]);
        // メール通知
        Mail::to($transaction->to_user->email)->send(
            new MailNotification(
                $title,
                "{$transaction->to_user->name}さん\n\n". $text. "以下のURLから内容を確認してください。\n",
                $url
            )
        );
        // データベース通知
        $transaction->to_user->notify(
            new DatabaseNotify(
                $title,
                $text,
                $url
            )
        );

        return redirect(route('front.transactions.messages.show', ['transaction' => $transaction]))->with('message', 'キャンセルリクエストを否認しました');
    }
}
