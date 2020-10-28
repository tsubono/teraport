<?php

namespace App\Repositories\Message;

use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

interface MessageRepositoryInterface
{
    public function getAll(): Collection;
    public function getOne(int $id): Message;
    public function store(int $transaction_id);
    public function storeItem(int $id, array $data);
    public function updateItemsToRead(int $id);
}
