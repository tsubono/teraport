<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaleRequest;
use App\Repositories\SaleRequest\SaleRequestRepositoryInterface;
use Illuminate\Http\Request;

class SaleRequestController extends Controller
{
    /**
     * @var SaleRequestRepositoryInterface
     */
    private $saleRequestRepository;

    /**
     * SaleRequestController constructor.
     *
     * @param SaleRequestRepositoryInterface $saleRequestRepository
     */
    public function __construct(SaleRequestRepositoryInterface $saleRequestRepository) {
        $this->saleRequestRepository = $saleRequestRepository;
    }

    /**
     * 売上申請一覧
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $saleRequests = $this->saleRequestRepository->getPaginate();
        return view('admin.sale-requests.index', compact('saleRequests'));
    }

    /**
     * 売上申請更新処理
     *
     * @param SaleRequest $saleRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SaleRequest $saleRequest)
    {
        $this->saleRequestRepository->update($saleRequest->id, ['status' => 1]);

        return redirect(route('admin.sale-requests.index'))->with('message', '振り込み済みに更新しました');
    }
}
