<?php

namespace App\Repositories\SaleRequest;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SaleRequestRepositoryInterface
{
    public function getPaginate(int $paginationCount = 20): LengthAwarePaginator;
    public function store(array $data);
    public function update(int $id, array $data);
}
