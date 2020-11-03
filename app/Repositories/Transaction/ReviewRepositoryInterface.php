<?php

namespace App\Repositories\Transaction;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ReviewRepositoryInterface
{
    public function store(array $data);
    public function getPaginateByToUserId(int $userId, int $paginationCount = 20): LengthAwarePaginator;
}
