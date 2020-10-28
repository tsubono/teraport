<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * プロフィール
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('front.users.show', compact('user'));
    }
}
