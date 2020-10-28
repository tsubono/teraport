<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repositories\Service\ServiceRepositoryInterface;

class TopController extends Controller
{
    /**
     * @var ServiceRepositoryInterface
     */
    private $serviceRepository;

    /**
     * TopController constructor.
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * Top
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $services = $this->serviceRepository->getCurrent();

        return view('front.top', compact('services'));
    }
}
