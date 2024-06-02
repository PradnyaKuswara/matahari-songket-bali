<?php

namespace App\Interfaces;

interface OrderInterface
{
    public function all($user);

    public function getAll();

    public function find($id);

    public function create(array $data);

    public function createAttachedProduct(array $data, $order);

    public function updateStatus($order, $status);

    public function checkStock($order);

    public function search($request, $model, $conditions);
}
