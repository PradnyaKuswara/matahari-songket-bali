<?php

namespace App\Interfaces;

interface TransactionInterface
{
    public function all($user);

    public function create(array $data, $order);

    public function updateStatus($transaction, $status);
}
