<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\UserRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * @var Service
     */
    private $service;

    /**
     * MypageController constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
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
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        // TODO: メッセージ取得
        return view('front.messages.show');
    }

    /**
     * メッセージ送信
     *
     * @param MessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(MessageRequest $request)
    {
        $data = $request->all();
        // TODO: 送信
        return redirect(route('front.messages.show', ['id' => 1]));
    }
}
