<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * ユーザー一覧
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        if (!empty($params['name'])) {
            $users = $this->userRepository->getByName($params['name']);
        } else {
            $users = $this->userRepository->getAll();
        }

        return view('admin.users.index', compact('users', 'params'));
    }


    /**
     * ステータス更新処理
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleIsInvalid(User $user)
    {
        $this->userRepository->update($user->id, ['is_invalid' => $user->is_invalid ? null : 1]);

        return redirect(route('admin.users.index'))->with('message', 'ステータスを更新しました。');
    }
}
