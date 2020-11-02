<?php

namespace App\Repositories\SaleRequest;

use App\Models\SaleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class SaleRequestRepository
 *
 * @package App\Repositories\Transaction
 */
class SaleRequestRepository implements SaleRequestRepositoryInterface
{
    /**
     * @var SaleRequest
     */
    private $saleRequest;

    public function __construct(SaleRequest $saleRequest) {
        $this->saleRequest = $saleRequest;
    }

    /**
     * 登録する
     *
     * @param array $data
     * @throws \Exception
     */
    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $this->saleRequest->create($data);

            DB::commit();
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
     * @throws \Exception
     */
    public function update(int $id, array $data)
    {
        DB::beginTransaction();
        try {
            $saleRequest = $this->saleRequest->findOrFail($id);
            $saleRequest->update($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }
}
