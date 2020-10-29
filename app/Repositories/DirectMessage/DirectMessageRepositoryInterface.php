<?php

namespace App\Repositories\DirectMessage;

interface DirectMessageRepositoryInterface
{
    public function storeRoom(int $userId1, int $userId2);
    public function storeMessage(int $roomId, array $data);
    public function updateMessagesToRead(int $roomId);
}
