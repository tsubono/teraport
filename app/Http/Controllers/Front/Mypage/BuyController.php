<?php

namespace App\Http\Controllers\Front\Mypage;

use App\Http\Controllers\Controller;

class BuyController extends Controller
{
    /**
     * SaleController constructor.
     */
    public function __construct()
    {
    }

    /**
     * 購入サービス一覧
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // TODO: 購入一覧取得
        return view('front.mypage.buys.index');
    }
}
