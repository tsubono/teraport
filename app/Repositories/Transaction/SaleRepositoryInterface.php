<?php

namespace App\Repositories\Transaction;

use App\Models\TransactionSale;
use Illuminate\Database\Eloquent\Collection;

interface SaleRepositoryInterface
{
    public function getOne(int $id): TransactionSale;
    public function store(array $data);
    public function getCompleteSaleByUserId(int $userId): Collection;
    public function updateRequestId(int $userId, int $saleRequestId);
}
