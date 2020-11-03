<?php

namespace App\Repositories\SaleRequest;

use App\Models\SaleRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SaleRequestRepositoryInterface
{
    public function getPaginate(int $paginationCount = 20): LengthAwarePaginator;
    public function store(array $data): SaleRequest;
    public function update(int $id, array $data);
}
