<?php

namespace App\Repositories\SaleRequest;

interface SaleRequestRepositoryInterface
{
    public function store(array $data);
    public function update(int $id, array $data);
}
