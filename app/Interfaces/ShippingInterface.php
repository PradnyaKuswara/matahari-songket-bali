<?php

namespace App\Interfaces;

interface ShippingInterface
{
    public function all($user);

    public function getAll();

    public function create(array $data, $order);

    public function update(array $data, $shipping);

    public function confirmation($shipping);

    public function search($request, $model, $conditions, $relations);
}
