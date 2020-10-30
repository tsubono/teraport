<?php

namespace App\Repositories\DirectMessage;

use Illuminate\Database\Eloquent\Collection;

interface DirectMessageRepositoryInterface
{
    public function getRoomByUserId(int $userId, int $count = null): Collection;
    public function storeRoom(int $userId1, int $userId2);
    public function storeMessage(int $roomId, array $data);
    public function updateMessagesToRead(int $roomId);
}
