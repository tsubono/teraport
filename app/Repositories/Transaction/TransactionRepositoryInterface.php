<?php

namespace App\Repositories\Transaction;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

interface TransactionRepositoryInterface
{
    public function getAll(): Collection;
    public function getOne(int $id): Transaction;
    public function store(array $data): Transaction;
    public function update(int $id, array $data): Transaction;
    public function destroy(int $id);
}
