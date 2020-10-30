<?php

namespace App\Repositories\Transaction;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TransactionRepositoryInterface
{
    public function getAll(): Collection;
    public function getSaleByUserId(int $userId, int $paginationCount = 20): LengthAwarePaginator;
    public function getBuyByUserId(int $userId, int $paginationCount = 20): LengthAwarePaginator;
    public function getOne(int $id): Transaction;
    public function store(array $data);
    public function updateToComplete(int $id);
}
