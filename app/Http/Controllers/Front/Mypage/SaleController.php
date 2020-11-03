<?php

namespace App\Http\Controllers\Front\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Repositories\SaleRequest\SaleRequestRepositoryInterface;
use App\Repositories\Transaction\SaleRepositoryInterface;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

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
     * @var SaleRepositoryInterface
     */
    private $saleRepository;

    /**
     * SaleController constructor.
     *
     * @param TransactionRepositoryInterface $transactionRepository
     * @param SaleRequestRepositoryInterface $saleRequestRepository
     * @param SaleRepositoryInterface $saleRepository
     */
    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        SaleRequestRepositoryInterface $saleRequestRepository,
        SaleRepositoryInterface $saleRepository
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->saleRequestRepository = $saleRequestRepository;
        $this->saleRepository = $saleRepository;
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
        $calcData = $this->calcSaleData();

        return view('front.mypage.sales.request', $calcData);
    }

    /**
     * 売上申請処理
     *
     * @param SaleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRequest(SaleRequest $request)
    {
        $calcData = $this->calcSaleData();

        $price = $calcData['remainTotalPrice'];
        // 申請登録
        $saleRequest = $this->saleRequestRepository->store($request->all() + [
                'user_id' => auth()->user()->id,
                'price' => $price,
                'transfer_limit_date' => Carbon::now()->addMonth()->endOfMonth(), // 仮で翌月末とする TODO:仕様確認
            ]
        );
        // 売上にsale_request_idをいれる
        $this->saleRepository->updateRequestId(auth()->user()->id, $saleRequest->id);

        // TODO: 管理者へ通知処理

        return redirect(route('front.mypage.sales.request'))->with('message', '申請完了しました。');
    }

    /**
     * 売上関連データを算出する
     *
     * @return array
     */
    private function calcSaleData(): array
    {
        $sales = $this->saleRepository->getCompleteSaleByUserId(auth()->user()->id);
        $totalPrice = $remainTotalPrice = $scheduledTransferPrice = 0;

        foreach ($sales as $sale) {
            // 売上から手数料を引いた料金を加算する
            $price = $sale->price - $sale->fee;
            // 累計売上
            $totalPrice += $price;

            // 振り込み済みフラグ・振り込み申請IDともにfalseの場合
            if (!$sale->is_transferred && !$sale->sale_request_id) {
                // 売上金残高
                $remainTotalPrice += $price;
            }
            // 振り込み済みフラグがfalse・振り込み申請済みフラグがtrueの場合
            if (!$sale->is_transferred && $sale->sale_request_id) {
                // 振り込み予定金額
                $scheduledTransferPrice += $price;
            }
        }
        // TODO: 仕様確認
        $scheduledTransferDate = '2020年12月30日';

        return compact(
            'totalPrice',
            'remainTotalPrice',
            'scheduledTransferPrice',
            'scheduledTransferDate'
        );
    }
}
