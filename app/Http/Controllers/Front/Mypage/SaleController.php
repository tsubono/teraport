<?php

namespace App\Http\Controllers\Front\Mypage;

use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    /**
     * SaleController constructor.
     */
    public function __construct()
    {
    }

    /**
     * 売上一覧
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // TODO: 売上一覧取得
        return view('front.mypage.sales.index');
    }


    /**
     * 売上申請
     *
     * @return \Illuminate\View\View
     */
    public function request()
    {
        // TODO: 売上一覧取得
        return view('front.mypage.sales.request');
    }

    /**
     * 売上申請処理
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRequest()
    {
        // TODO: 申請処理

        return redirect(route('front.mypage.sales.request'))->with('message', '申請完了しました。');
    }
}
