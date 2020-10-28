<?php

namespace App\Repositories\Message;

use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

interface MessageRepositoryInterface
{
    public function getAll(): Collection;
    public function getOne(int $id): Message;
    public function store(array $data): Message;
    public function update(int $id, array $data): Message;
    public function destroy(int $id);
}
