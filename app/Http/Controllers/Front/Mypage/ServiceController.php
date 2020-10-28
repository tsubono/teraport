<?php

namespace App\Http\Controllers\Front\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Repositories\Service\ServiceRepositoryInterface;

class ServiceController extends Controller
{
    /**
     * @var ServiceRepositoryInterface
     */
    private $serviceRepository;

    /**
     * ServiceController constructor.
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * サービス管理
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $services = $this->serviceRepository->getByUserId(auth()->user()->id);

        return view('front.mypage.services.index', compact('services'));
    }

    /**
     * サービス登録
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $service = new Service();
        return view('front.mypage.services.create', compact('service'));
    }

    /**
     * サービス登録処理
     *
     * @param ServiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ServiceRequest $request)
    {
        $this->serviceRepository->store($request->all() + ['user_id' => auth()->user()->id]);

        return redirect(route('front.mypage.services.index'))->with('message', '登録しました');
    }

    /**
     * サービス編集
     *
     * @param Service $service
     * @return \Illuminate\View\View
     */
    public function edit(Service $service)
    {
        return view('front.mypage.services.edit', compact('service'));
    }

    /**
     * サービス更新処理
     *
     * @param ServiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Service $service, ServiceRequest $request)
    {
        $this->serviceRepository->update($service->id, $request->all());

        return redirect(route('front.mypage.services.index'))->with('message', '更新しました');
    }

}
