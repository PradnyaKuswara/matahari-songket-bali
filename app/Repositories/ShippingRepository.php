<?php

namespace App\Repositories;

use App\Interfaces\ShippingInterface;
use App\Models\Shipping;

class ShippingRepository implements ShippingInterface
{
    public function all($user)
    {
        return $user->shippings();
    }

    public function getAll()
    {
        return Shipping::query();
    }

    public function create(array $data, $order)
    {
        return $order->shipping()->create($data);
    }

    public function update(array $data, $shipping)
    {
        return $shipping->update($data);
    }

    public function confirmation($shipping)
    {
        return $shipping->update(['status' => 'delivered']);
    }
}
