<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{

    public function index(Request $request)
    {
        $page =  $request->get('page', 1);
        $notifications = auth()->user()->notifications()->paginate(20, ['*'], 'page', $page);
        return view('front.notifications.index', compact('notifications'));
    }

    /**
     * 通知を既読にする
     *
     * @param DatabaseNotification $notification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function read(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        return redirect($notification->data['url']);
    }

    /**
     * 全て通知を既読にする
     *
     * @param DatabaseNotification $notification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function readAll(DatabaseNotification $notification)
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect(route('front.notifications.index'));
    }
}
