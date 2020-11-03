<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use App\Repositories\Transaction\ReviewRepositoryInterface;

class UserController extends Controller
{
    /**
     * @var ReviewRepositoryInterface
     */
    private $reviewRepository;

    /**
     * UserController constructor.
     * @param ReviewRepositoryInterface $reviewRepository
     */
    public function __construct(ReviewRepositoryInterface $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
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

    /**
     * ユーザーに紐づく評価一覧を表示する
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function reviews(User $user)
    {
        // 評価一覧を取得
        $reviews = $this->reviewRepository->getPaginateByToUserId($user->id);
        return view('front.users.reviews', compact('user', 'reviews'));
    }
}
