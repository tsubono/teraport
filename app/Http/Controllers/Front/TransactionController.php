<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\Transaction;
use App\Models\TransactionMessageFile;
use App\Repositories\Transaction\MessageRepositoryInterface;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Storage;

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
     * TransactionController constructor.
     * @param TransactionRepositoryInterface $transactionRepository
     * @param MessageRepositoryInterface $messageRepository
     */
    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        MessageRepositoryInterface $messageRepository
    )
    {
        $this->transactionRepository = $transactionRepository;
        $this->messageRepository = $messageRepository;
    }

    /**
     * メッセージ詳細
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
     * メッセージ送信
     *
     * @param Transaction $transaction
     * @param MessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Transaction $transaction, MessageRequest $request)
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

        // TODO: 通知

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
     * レビュー
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

        return view('front.transactions.review', compact('transaction'));
    }

    /**
     * レビュー登録
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeReview(Transaction $transaction)
    {
        // 関係ない人は見れないように
        if ($transaction->seller_user_id !== auth()->user()->id
            && $transaction->buyer_user_id !== auth()->user()->id) {
            abort(404);
        }

        // TODO: 飛ばす場所考える
        return redirect(route('front.transactions.review'))->with('message', '評価を登録しました');
    }
}
