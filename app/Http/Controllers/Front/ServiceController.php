<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * @var ServiceRepositoryInterface
     */
    private $serviceRepository;
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;
    /**
     * @var TransactionRepositoryInterface
     */
    private $transactionRepository;

    /**
     * ServiceController constructor.
     * @param ServiceRepositoryInterface $serviceRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param TransactionRepositoryInterface $transactionRepository
     */
    public function __construct(
        ServiceRepositoryInterface $serviceRepository,
        CategoryRepositoryInterface $categoryRepository,
        TransactionRepositoryInterface $transactionRepository
    )
    {
        $this->serviceRepository = $serviceRepository;
        $this->categoryRepository = $categoryRepository;
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * サービス一覧
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $category = $this->categoryRepository->getOne($params['c'] ?? 0);
        // 対象のカテゴリ自体存在しない場合は404
        if (!empty($params['c']) && empty($category)) {
            abort(404);
        }
        $categoryName = !empty($category) ? $category->name : '全カテゴリ';
        $services = $this->serviceRepository->getByCondition($params);

        return view('front.services.index', compact('services', 'params', 'categoryName'));
    }

    /**
     * サービス詳細
     *
     * @param Service $service
     * @return \Illuminate\View\View
     */
    public function show(Service $service)
    {
        if ($service->is_invalid || $service->user->is_invalid || !$service->is_public) {
            abort(404);
        }
        return view('front.services.show', compact('service'));
    }
}
