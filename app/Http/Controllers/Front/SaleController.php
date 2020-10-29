<?php

namespace App\Http\Controllers\Front;

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
        return view('front.sales.index');
    }
}
