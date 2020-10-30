<?php

namespace App\Repositories\Transaction;

use App\Models\Transaction;
use App\Models\TransactionMessage;
use App\Models\TransactionMessageFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class MessageRepository
 *
 * @package App\Repositories\Transaction
 */
class MessageRepository implements MessageRepositoryInterface
{
    /**
     * @var Transaction
     */
    private $transaction;

    /**
     * @var TransactionMessage
     */
    private $message;

    /**
     * @var TransactionMessageFile
     */
    private $file;

    public function __construct(Transaction $transaction, TransactionMessage $message, TransactionMessageFile $file) {
        $this->transaction = $transaction;
        $this->message = $message;
        $this->file = $file;
    }

    /**
     * メッセージを登録する
     *
     * @param int $transactionId
     * @param array $data
     * @throws \Exception
     */
    public function storeMessage(int $transactionId, array $data)
    {
        DB::beginTransaction();
        try {
            // 取引取得
            $transaction = $this->transaction->findOrFail($transactionId);
            // メッセージ登録処理
            $message = $transaction->messages()->create([
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
     * @param int $transactionId
     * @throws \Exception
     */
    public function updateMessagesToRead(int $transactionId)
    {
        DB::beginTransaction();
        try {
            // 部屋取得
            $transaction = $this->transaction->findOrFail($transactionId);
            // 既読ステータス更新処理
            $transaction->messages()
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
