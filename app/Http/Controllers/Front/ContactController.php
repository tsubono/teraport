<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactNotification;
use App\Mail\MailNotification;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * お問い合わせフォーム
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('front.contact');
    }

    /**
     * お問い合わせ送信
     *
     * @param ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function send(ContactRequest $request)
    {
        if (!auth()->check()) {
            abort(404);
        }

        // メール通知
        Mail::to('info@teraport.jp')->send(
            new ContactNotification(
                $request->get('name'),
                $request->get('type'),
                $request->get('email'),
                $request->get('content'),
            )
        );

        return redirect(route('front.contact.index'))->with('message', '送信が完了しました');
    }

}
