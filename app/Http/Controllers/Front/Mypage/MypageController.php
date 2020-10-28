<?php

namespace App\Http\Controllers\Front\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Service;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * MypageController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * マイページ
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        !isset($params['type']) && $params['type'] = 'buyer';

        return view('front.mypage.index', compact('params'));
    }

    /**
     * プロフィール編集
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('front.mypage.profile');
    }

    /**
     * プロフィール更新
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(UserRequest $request)
    {
        $this->userRepository->update(auth()->user()->id, $request->all());

        return redirect(route('front.mypage.profile'))->with('message', '更新しました');
    }

}
