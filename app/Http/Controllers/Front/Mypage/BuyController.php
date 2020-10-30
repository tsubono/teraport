<?php

namespace App\Http\Controllers\Front\Mypage;

use App\Http\Controllers\Controller;
use App\Repositories\Transaction\TransactionRepositoryInterface;

class BuyController extends Controller
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
     * 購入サービス一覧
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $transactions = $this->transactionRepository->getBuyByUserId(auth()->user()->id);

        return view('front.mypage.buys.index', compact('transactions'));
    }
}
