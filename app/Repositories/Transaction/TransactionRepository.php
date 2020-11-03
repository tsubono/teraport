<?php

namespace App\Repositories\Transaction;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
     * ユーザーが購入した取引一覧を取得する
     *
     * @param int $userId
     * @param int $paginationCount
     * @return LengthAwarePaginator
     */
    public function getBuyByUserId(int $userId, int $paginationCount = 20): LengthAwarePaginator
    {
        return $this->transaction
            ->query()
            ->where('buyer_user_id', $userId)
            ->paginate($paginationCount);
    }

    /**
     * ユーザーが購入された取引一覧を取得する
     *
     * @param int $userId
     * @param int $paginationCount
     * @return LengthAwarePaginator
     */
    public function getSaleByUserId(int $userId, int $paginationCount = 20): LengthAwarePaginator
    {
        return $this->transaction
            ->query()
            ->where('seller_user_id', $userId)
            ->paginate($paginationCount);
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
     * 取引を完了にする
     *
     * @param int $id
     */
    public function updateToComplete(int $id)
    {
        $this->transaction->where('id', $id)->update(['status' => 1]);
    }
}
