<?php

namespace App\Repositories\Message;

use App\Models\Message;
use Carbon\Carbon;
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
     * @param int $transaction_id
     * @return Message | object
     * @throws \Exception
     */
    public function store(int $transaction_id)
    {
        DB::beginTransaction();
        try {
            $message = $this->message
                ->query()
                ->where('transaction_id', $transaction_id)
                ->first();

            if (!empty($message)) {
                return $message;
            }

            $message = $this->message->create(compact('transaction_id'));

            DB::commit();

            return $message;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }

    /**
     * メッセージを送信する
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function storeItem(int $id, array $data)
    {
        DB::beginTransaction();
        try {
            $message = $this->message->findOrFail($id);
            $item = $message->items()->create([
                'content' => $data['content'],
                'from_user_id' => $data['from_user_id'],
                'to_user_id' => $data['to_user_id'],
                'image_path' => $data['content'],
            ]);

            // ファイルがあれば登録
            foreach ($data['files'] ?? [] as $file) {
                $filename = Carbon::now()->format('YmdHis').rand(1, 9).".". $file->extension();
                $path = $file->storeAs("uploaded_images/messages/{$message->id}", $filename, 'public');
                $item->files()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName()
                ]);
            }

            DB::commit();

            return $message;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }

    /**
     * メッセージを既読にする
     *
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function updateItemsToRead(int $id)
    {
        DB::beginTransaction();
        try {
            $message = $this->message->findOrFail($id);
            $message->items()
                ->whereNull('is_read')
                // 自分宛のもの
                ->where('to_user_id', auth()->user()->id)
                ->update([
                    'is_read' => true,
                ]);

            DB::commit();

            return $message;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }
}
