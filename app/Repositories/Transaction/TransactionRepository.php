<?php

namespace App\Repositories\Transaction;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class TransactionRepository
 *
 * @package App\Repositories\Transaction
 */
class TransactionRepository implements TransactionRepositoryInterface
{
    /**
     * @var Transaction
     */
    private $transaction;

    public function __construct(Transaction $transaction) {
        $this->transaction = $transaction;
    }

    /**
     * 全件取得する
     *
     * @retusn Transaction
     */
    public function getAll(): Collection
    {
        return $this->transaction->orderBy('created_at', 'desc')->get();
    }

    /**
     * 1件取得する
     *
     * @param int $id
     * @retusn Transaction
     */
    public function getOne(int $id): Transaction
    {
        return $this->transaction->find($id);
    }

    /**
     * 登録する
     *
     * @param array $data
     * @retusn Transaction | object
     * @throws \Exception
     */
    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            // service_idがない場合はダイレクトメッセージ
            if (empty($data['service_id'])) {
                $transaction = $this->transaction
                    ->query()
                    ->where('seller_user_id', $data['seller_user_id'])
                    ->where('buyer_user_id', $data['buyer_user_id'])
                    ->first();

                // ダイレクトメッセージは1つのみ
                if ($transaction) {
                    return $transaction;
                }
            }

            $transaction = $this->transaction->create($data);

            DB::commit();

            return $transaction;

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
     * @retusn Transaction | object
     * @throws \Exception
     */
    public function update(int $id, array $data)
    {
        DB::beginTransaction();
        try {
            $transaction = $this->transaction->findOrFail($id);
            $transaction->update($data);

            DB::commit();

            return $transaction;

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
            $transaction = $this->transaction->findOrFail($id);
            $transaction->delete();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }
}
