<?php

namespace App\Http\Controllers\Front\Mypage;

use App\Http\Controllers\Controller;
use App\Repositories\Transaction\TransactionRepositoryInterface;

class SaleController extends Controller
{
    /**
     * @var TransactionRepositoryInterface
     */
    private $transactionRepository;

    /**
     * SaleController constructor.
     */
    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * 購入された取引一覧
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $transactions = $this->transactionRepository->getSaleByUserId(auth()->user()->id);

        return view('front.mypage.sales.index', compact('transactions'));
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
