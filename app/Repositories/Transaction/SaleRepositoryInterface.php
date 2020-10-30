<?php

namespace App\Repositories\Transaction;

use App\Models\TransactionSale;

interface SaleRepositoryInterface
{
    public function getOne(int $id): TransactionSale;
    public function store(array $data);
}
