<?php

namespace App\Repositories;

use App\Interfaces\TransactionInterface;

class TransactionRepository implements TransactionInterface
{
    public function all($user)
    {
        return $user->transactions();
    }

    public function create(array $data, $order)
    {
        return $order->transaction()->create($data);
    }

    public function updateStatus($transaction, $status)
    {
        return $transaction->update(['status' => $status]);
    }
}
