<?php

namespace App\Http\Controllers\Front\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Service;
use App\Repositories\DirectMessage\DirectMessageRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var DirectMessageRepositoryInterface
     */
    private $messageRepository;
    /**
     * @var ServiceRepositoryInterface
     */
    private $serviceRepository;

    /**
     * MypageController constructor.
     * @param UserRepositoryInterface $userRepository
     * @param DirectMessageRepositoryInterface $messageRepository
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        DirectMessageRepositoryInterface $messageRepository,
        ServiceRepositoryInterface $serviceRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->messageRepository = $messageRepository;
        $this->serviceRepository = $serviceRepository;
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

        $directMessageRooms = $this->messageRepository->getRoomByUserId(auth()->user()->id, 3);
        $services = $this->serviceRepository->getByUserId(auth()->user()->id, 3);

        return view('front.mypage.index',
            compact(
                'params',
                'directMessageRooms',
                'services'
            )
        );
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
