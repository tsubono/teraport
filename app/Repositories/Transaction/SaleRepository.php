<?php

namespace App\Repositories\Transaction;

use App\Models\TransactionSale;
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
}
