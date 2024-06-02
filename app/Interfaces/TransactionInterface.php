<?php

namespace App\Interfaces;

interface TransactionInterface
{
    public function all($user);

    public function getAll();

    public function create(array $data, $order);

    public function updateStatus($transaction, $status);

    public function search($request, $model, $conditions);
}
