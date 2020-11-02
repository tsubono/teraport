<?php

namespace App\Http\Controllers\Front\Mypage;

use App\Http\Controllers\Controller;
use App\Repositories\SaleRequest\SaleRequestRepositoryInterface;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    /**
     * @var TransactionRepositoryInterface
     */
    private $transactionRepository;
    /**
     * @var SaleRequestRepositoryInterface
     */
    private $saleRequestRepository;

    /**
     * SaleController constructor.
     *
     * @param TransactionRepositoryInterface $transactionRepository
     * @param SaleRequestRepositoryInterface $saleRequestRepository
     */
    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        SaleRequestRepositoryInterface $saleRequestRepository
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->saleRequestRepository = $saleRequestRepository;
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRequest(Request $request)
    {
        // TODO: 算出処理
        $price = 10000;
        $this->saleRequestRepository->store([
                'user_id' => auth()->user()->id,
                'price' => $price,
                'transfer_limit_date' => Carbon::now()->addMonth()->endOfMonth(), // 仮で翌月末とする TODO:仕様確認
            ]
        );
        // TODO: 管理者へ通知処理

        return redirect(route('front.mypage.sales.request'))->with('message', '申請完了しました。');
    }
}
