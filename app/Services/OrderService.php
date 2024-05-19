<?php

namespace App\Services;

use App\Interfaces\OrderInterface;

class OrderService
{
    protected $orderInterface;

    public function __construct(OrderInterface $orderInterface)
    {
        $this->orderInterface = $orderInterface;
    }

    public function all($user)
    {
        return $this->orderInterface->all($user);
    }

    public function getAll()
    {
        return $this->orderInterface->getAll();
    }

    public function find($id)
    {
        return $this->orderInterface->find($id);
    }

    public function create(array $data)
    {
        return $this->orderInterface->create($data);
    }

    public function createAttachedProduct(array $data, $order)
    {
        return $this->orderInterface->createAttachedProduct($data, $order);
    }

    public function updateStatus($order, $status)
    {
        return $this->orderInterface->updateStatus($order, $status);
    }

    public function checkStock($order)
    {
        return $this->orderInterface->checkStock($order);
    }
}
