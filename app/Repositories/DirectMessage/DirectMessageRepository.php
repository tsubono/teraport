<?php

namespace App\Repositories\DirectMessage;

use App\Models\DirectMessage;
use App\Models\DirectMessageFile;
use App\Models\DirectMessageRoom;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class DirectMessageRepository
 *
 * @package App\Repositories\DirectMessage
 */
class DirectMessageRepository implements DirectMessageRepositoryInterface
{
    /**
     * @var DirectMessageRoom
     */
    private $room;

    /**
     * @var DirectMessage
     */
    private $message;

    /**
     * @var DirectMessageFile
     */
    private $file;

    public function __construct(DirectMessageRoom $room, DirectMessage $message, DirectMessageFile $file) {
        $this->room = $room;
        $this->message = $message;
        $this->file = $file;
    }

    /**
     * ユーザーIDに紐づくメッセージ部屋を取得する
     *
     * @param int $userId
     * @param int|null $count
     * @return Collection
     */
    public function getRoomByUserId(int $userId, int $count = null): Collection
    {
        $query = $this->room
            ->query()
            // メッセージがあるもののみ
            ->whereHas('messages')
            ->orderBy('created_at', 'desc');
        if (!is_null($count)) {
            $query->take($count);
        }

        return $query->get();
    }

    /**
     * メッセージ部屋を登録する
     *
     * @param int $userId1
     * @param int $userId2
     * @return DirectMessage | object
     * @throws \Exception
     */
    public function storeRoom(int $userId1, int $userId2)
    {
        DB::beginTransaction();
        try {
            // 登録済みのデータがあるか検索
            $room = $this->room
                ->query()
                ->where('user_1_id', $userId1)
                ->where('user_2_id', $userId2)
                ->first();
            // 既に部屋がある場合はそれを返す
            if (!empty($room)) {
                return $room;
            }

            // 部屋登録処理
            $room = $this->room->create([
                'user_1_id' => $userId1,
                'user_2_id' => $userId2
            ]);

            DB::commit();

           return $room;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }

    /**
     * メッセージを登録する
     *
     * @param int $roomId
     * @param array $data
     * @throws \Exception
     */
    public function storeMessage(int $roomId, array $data)
    {
        DB::beginTransaction();
        try {
            // 部屋取得
            $room = $this->room->findOrFail($roomId);
            // メッセージ登録処理
            $message = $room->messages()->create([
                'content' => $data['content'],
                'from_user_id' => $data['from_user_id'],
                'to_user_id' => $data['to_user_id'],
            ]);
            // ファイルがあれば登録
            foreach ($data['files'] ?? [] as $file) {
                $filename = Carbon::now()->format('YmdHis').rand(1, 9).".". $file->extension();
                $path = $file->storeAs("uploaded_images/messages/{$message->id}", $filename, 'public');
                $message->files()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName()
                ]);
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }

    /**
     * メッセージを既読にする
     *
     * @param int $roomId
     * @throws \Exception
     */
    public function updateMessagesToRead(int $roomId)
    {
        DB::beginTransaction();
        try {
            // 部屋取得
            $room = $this->room->findOrFail($roomId);
            // 既読ステータス更新処理
            $room->messages()
                // まだ既読じゃないもの
                ->where('is_read', false)
                // 自分宛のもの
                ->where('to_user_id', auth()->user()->id)
                ->update([
                    'is_read' => true,
                ]);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }
}
