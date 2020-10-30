<?php

namespace App\Repositories\Transaction;

interface MessageRepositoryInterface
{
    public function storeMessage(int $transactionId, array $data);
    public function updateMessagesToRead(int $transactionId);
}
