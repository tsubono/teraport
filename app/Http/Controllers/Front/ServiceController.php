<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
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
     * ServiceController constructor.
     * @param ServiceRepositoryInterface $serviceRepository
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(ServiceRepositoryInterface $serviceRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->serviceRepository = $serviceRepository;
        $this->categoryRepository = $categoryRepository;
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
        $services = $this->serviceRepository->getByCondition($params, 1);

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
        return view('front.services.show', compact('service'));
    }
}
