<?php

namespace App\Services;

use App\Interfaces\TransactionInterface;

class TransactionService
{
    protected $transactionInterface;

    public function __construct(TransactionInterface $transactionInterface)
    {
        $this->transactionInterface = $transactionInterface;
    }

    public function all($user)
    {
        return $this->transactionInterface->all($user);
    }

    public function create(array $data, $order)
    {
        return $this->transactionInterface->create($data, $order);
    }

    public function updateStatus($transaction, $status)
    {
        return $this->transactionInterface->updateStatus($transaction, $status);
    }
}
