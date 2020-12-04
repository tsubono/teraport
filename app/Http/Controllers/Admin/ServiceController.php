<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repositories\Service\ServiceRepositoryInterface;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * @var ServiceRepositoryInterface
     */
    private $serviceRepository;

    /**
     * ServiceController constructor.
     *
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(
        ServiceRepositoryInterface $serviceRepository
    ) {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * 出品サービス一覧
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        if (!empty($params['name'])) {
            $services = $this->serviceRepository->getByName($params['name']);
        } else {
            $services = $this->serviceRepository->getAll();
        }

        return view('admin.services.index', compact('services', 'params'));
    }


    /**
     * ステータス更新処理
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleIsInvalid(Service $service)
    {
        $this->serviceRepository->update($service->id, ['is_invalid' => $service->is_invalid ? null : 1]);

        return redirect(route('admin.services.index'))->with('message', 'ステータスを更新しました。');
    }
}
