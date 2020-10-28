<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\UserRequest;
use App\Models\Message;
use App\Models\MessageItemFile;
use App\Models\Service;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepository;
    /**
     * @var TransactionRepositoryInterface
     */
    private $transactionRepository;

    /**
     * MessageController constructor.
     * @param MessageRepositoryInterface $messageRepository
     * @param TransactionRepositoryInterface $transactionRepository
     */
    public function __construct(MessageRepositoryInterface $messageRepository, TransactionRepositoryInterface $transactionRepository)
    {
        $this->messageRepository = $messageRepository;
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * メッセージ一覧
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        !isset($params['type']) && $params['type'] = 'buyer';

        return view('front.messages.index', compact('params'));
    }

    /**
     * メッセージ詳細
     *
     * @param Message $message
     * @return \Illuminate\View\View
     */
    public function show(Message $message)
    {
        // 関係ない人は見れないように
        if ($message->transaction->seller_user_id !== auth()->user()->id && $message->transaction->buyer_user_id !== auth()->user()->id) {
            abort(404);
        }

        // 既読にする
        $this->messageRepository->updateItemsToRead($message->id);

        return view('front.messages.show', compact('message'));
    }

    /**
     * メッセージボックス作成
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        // TODO: ユーザーが存在するかチェック
        if (empty($request->get('to_user_id'))) {
            abort(404);
        }

        // 登録処理
        $transaction = $this->transactionRepository->store([
            'seller_user_id' => $request->get('to_user_id'),
            'buyer_user_id' => auth()->user()->id,
            'status' => 0,
        ]);
        $message = $this->messageRepository->store($transaction->id);

        return redirect(route('front.messages.show', compact('message')));
    }

    /**
     * メッセージ送信
     *
     * @param Message $message
     * @param MessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Message $message, MessageRequest $request)
    {
        // TODO: ファイルサイズチェック (フロントで行う？)
        $fromUserId = auth()->user()->id;
        $toUserId = $message->transaction->seller_user_id !== $fromUserId ? $message->transaction->seller_user_id : $message->transaction->buyer_user_id;

        $this->messageRepository->storeItem($message->id, $request->all()
            + [
                'from_user_id' => auth()->user()->id,
                'to_user_id' => $toUserId
            ]
        );
        // TODO: 通知

        return redirect(route('front.messages.show', ['message' => $message->id]));
    }

    public function download(MessageItemFile $messageItemFile)
    {
        // 関係ない人はダウンロードできないように
        $message = $messageItemFile->item->message;
        if ($message->transaction->seller_user_id !== auth()->user()->id && $message->transaction->buyer_user_id !== auth()->user()->id) {
            abort(404);
        }

        return Storage::disk('public')->download($messageItemFile->file_path, $messageItemFile->file_name);
    }
}
