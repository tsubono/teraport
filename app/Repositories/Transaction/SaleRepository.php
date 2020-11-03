<?php

namespace App\Repositories\Transaction;

use App\Models\TransactionSale;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class SaleRepository
 *
 * @package App\Repositories\Transaction
 */
class SaleRepository implements SaleRepositoryInterface
{
    /**
     * @var TransactionSale
     */
    private $sale;

    public function __construct(TransactionSale $sale) {
        $this->sale = $sale;
    }

    /**
     * 1件取得する
     *
     * @param int $id
     * @retusn TransactionSale
     */
    public function getOne(int $id): TransactionSale
    {
        return $this->sale->find($id);
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
            $transaction = $this->sale->create($data);

            DB::commit();

            return $transaction;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }

    /**
     * ユーザーIDに紐づく完了した売り上げをすべて取得する
     * @param int $userId
     * @return Collection
     */
    public function getCompleteSaleByUserId(int $userId): Collection
    {
        return $this->sale
            ->query()
            ->whereHas('transaction', function ($query) use ($userId) {
                $query->where('seller_user_id', $userId)
                    ->where('status', 1);
            })
            ->get();
    }

    /**
     * 売上申請IDを更新する
     *
     * @param int $userId
     * @param int $saleRequestId
     */
    public function updateRequestId(int $userId, int $saleRequestId)
    {
        $this->sale->query()
            ->whereHas('transaction', function($query) use($userId) {
            $query->where('seller_user_id', $userId);
            })
            ->whereNull('sale_request_id')
            ->update(['sale_request_id' => $saleRequestId]);
    }
}
