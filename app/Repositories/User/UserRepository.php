<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class UserRepository
 *
 * @package App\Repositories\User
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * 全件取得する
     *
     * @return User
     */
    public function getAll(): Collection
    {
        return $this->user->orderBy('created_at', 'desc')->get();
    }

    /**
     * 1件取得する
     *
     * @param int $id
     * @return User
     */
    public function getOne(int $id): User
    {
        return $this->user->find($id);
    }

    /**
     * 登録する
     *
     * @param array $data
     * @return User
     * @throws \Exception
     */
    public function store(array $data): User
    {
        DB::beginTransaction();
        try {
            $user = $this->user->create($data);

            DB::commit();

            return $user;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }

    /**
     * 更新する
     *
     * @param int $id
     * @param array $data
     * @return User
     * @throws \Exception
     */
    public function update(int $id, array $data): User
    {
        DB::beginTransaction();
        try {
            $user = $this->user->findOrFail($id);
            if (empty($data['password'])) {
                unset($data['password']);
            } else {
                $data['password'] = bcrypt($data['password']);
            }
            $user->update($data);

            DB::commit();

            return $user;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }

    /**
     * 削除する
     *
     * @param int $id
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        DB::beginTransaction();
        try {
            $user = $this->user->findOrFail($id);
            $user->delete();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }
}
