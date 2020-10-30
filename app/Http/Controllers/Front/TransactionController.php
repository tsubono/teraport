<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\TransactionMessageFile;
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
     * (サービス購入時) 取引を開始する
     * TODO: 長いのでリファクタしたい
     *
     * @param TransactionRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TransactionRequest $request)
    {
        // TODO: try catch

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
        // TODO 手数料確認
        $this->saleRepository->store([
            'transaction_id' => $transaction->id,
            'category_id' => $service->category_id,
            'title' => $service->title,
            'content' => $service->content,
            'price' => $service->price,
            'request_for_purchase' => $service->request_for_purchase,
            'stripe_charge_id' => $charge->id,
        ]);

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
        // TODO: ファイルサイズチェック (フロントで行う？)

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

        // 解決済みにする場合
        if ($request->get('status') == 1) {
            $this->transactionRepository->updateToComplete($transaction->id);

            // TODO: 購入者へ完了通知

        } else {
            // TODO: 送信先ユーザーへメッセージ通知
        }

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

        // TODO: 飛ばす場所考える
        return redirect(route('front.transactions.review', ['transaction' => $transaction]))->with('message', '評価を登録しました');
    }
}
