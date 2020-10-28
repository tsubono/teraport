<?php

namespace App\Repositories\Message;

use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class MessageRepository
 *
 * @package App\Repositories\Message
 */
class MessageRepository implements MessageRepositoryInterface
{
    /**
     * @var Message
     */
    private $message;

    public function __construct(Message $message) {
        $this->message = $message;
    }

    /**
     * 全件取得する
     *
     * @return Message
     */
    public function getAll(): Collection
    {
        return $this->message->orderBy('created_at', 'desc')->get();
    }

    /**
     * 1件取得する
     *
     * @param int $id
     * @return Message
     */
    public function getOne(int $id): Message
    {
        return $this->message->find($id);
    }

    /**
     * 登録する
     *
     * @param array $data
     * @return Message
     * @throws \Exception
     */
    public function store(array $data): Message
    {
        DB::beginTransaction();
        try {
            $message = $this->message->create($data);

            DB::commit();

            return $message;

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
     * @return Message
     * @throws \Exception
     */
    public function update(int $id, array $data): Message
    {
        DB::beginTransaction();
        try {
            $message = $this->message->findOrFail($id);
            $message->update($data);

            DB::commit();

            return $message;

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
            $message = $this->message->findOrFail($id);
            $message->delete();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }
}
