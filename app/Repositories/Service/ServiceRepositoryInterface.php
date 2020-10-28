<?php

namespace App\Repositories\Service;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ServiceRepositoryInterface
{
    public function getByCondition(array $condition, int $paginationCount = 20): LengthAwarePaginator;
    public function getCurrent(int $count = 6): Collection;
    public function getOne(int $id): Service;
    public function getByUserId(int $userId): Collection;
    public function store(array $data): Service;
    public function update(int $id, array $data): Service;
    // public function destroy(int $id);
}
