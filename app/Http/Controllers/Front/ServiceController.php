<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
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
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * service index
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $services = $this->serviceRepository->getAll();
        return view('front.services.index', compact('services', 'params'));
    }

    /**
     * show
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        return view('front.services.show');
    }
}
