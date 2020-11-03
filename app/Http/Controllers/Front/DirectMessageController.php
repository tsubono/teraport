<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\DirectMessageFile;
use App\Models\DirectMessageRoom;
use App\Repositories\DirectMessage\DirectMessageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotification;

class DirectMessageController extends Controller
{
    /**
     * @var DirectMessageRepositoryInterface
     */
    private $messageRepository;

    /**
     * MessageController constructor.
     * @param DirectMessageRepositoryInterface $messageRepository
     */
    public function __construct(DirectMessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * ダイレクトメッセージ一覧
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $directMessageRooms = $this->messageRepository->getRoomByUserId(auth()->user()->id);

        return view('front.direct-messages.index', compact('directMessageRooms'));
    }

    /**
     * ダイレクトメッセージ詳細
     *
     * @param DirectMessageRoom $room
     * @return \Illuminate\View\View
     */
    public function show(DirectMessageRoom $room)
    {
        // 関係ない人は見れないように
        if ($room->user_1_id !== auth()->user()->id && $room->user_2_id !== auth()->user()->id) {
            abort(404);
        }

        // 既読にする
        $this->messageRepository->updateMessagesToRead($room->id);

        return view('front.direct-messages.show', compact('room'));
    }

    /**
     * メッセージボックス作成
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // TODO: ユーザーが存在するかチェック
        if (empty($request->get('to_user_id'))) {
            abort(404);
        }

        // 登録処理
        $room = $this->messageRepository->storeRoom(auth()->user()->id, $request->get('to_user_id'));

        return redirect(route('front.direct-messages.show', compact('room')));
    }

    /**
     * メッセージ送信
     *
     * @param DirectMessageRoom $room
     * @param MessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(DirectMessageRoom $room, MessageRequest $request)
    {
        // TODO: ファイルサイズチェック (フロントで行う？)

        // ユーザーID取得
        $fromUserId = auth()->user()->id;
        $toUserId =
            $room->user_1_id !== $fromUserId ? $room->user_1_id : $room->user_2_id;

        // メッセージ登録
        $this->messageRepository->storeMessage($room->id, $request->all()
            + [
                'from_user_id' => $fromUserId,
                'to_user_id' => $toUserId
            ]);

        // TODO: 通知
        $name = auth()->user()->name;
        $to = $room->to_user->email;
        $currentUrl = url()->current();
        $url = str_replace('/send', '', $currentUrl);
        $text = "$name". "からダイレクトメッセージが届いています。\nログインして確認してください。\n". "url：". $url;
        $title = 'ダイレクトメッセージ通知';
        Mail::to($to)->send(new MailNotification($title, $text));

        return redirect(route('front.direct-messages.show', ['room' => $room]));
    }

    /**
     * メッセージ添付ファイルをダウンロード
     *
     * @param DirectMessageFile $file
     * @return mixed
     */
    public function download(DirectMessageFile $file)
    {
        // 関係ない人はダウンロードできないように
        $room = $file->directMessage->room;
        if ($room->user_1_id !== auth()->user()->id
            && $room->user_2_id !== auth()->user()->id) {
            abort(404);
        }

        return Storage::disk('public')
            ->download($file->file_path, $file->file_name);
    }
}
