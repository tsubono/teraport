<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;

class TopController extends Controller
{
    /**
     * @var Service
     */
    private $service;

    /**
     * TopController constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Top
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('front.top');
    }
}
