<?php

namespace App\Services;

use App\Interfaces\ShippingInterface;
use Carbon\Carbon;

class ShippingService
{
    protected $shippingInterface;

    public function __construct(ShippingInterface $shippingInterface)
    {
        $this->shippingInterface = $shippingInterface;
    }

    public function all($user)
    {
        return $this->shippingInterface->all($user);
    }

    public function getAll()
    {
        return $this->shippingInterface->getAll();
    }

    public function create(array $data, $order)
    {
        return $this->shippingInterface->create($data, $order);
    }

    public function update(array $data, $shipping)
    {
        $data['status'] = 'shipping';
        $data['max_confirm'] = Carbon::parse($data['delivered_at'])->addDays(7);
        $shipping = $this->shippingInterface->update($data, $shipping);

        return $shipping;
    }

    public function confirmation($shipping)
    {
        return $this->shippingInterface->confirmation($shipping);
    }

    public function search($request, $model, $conditions, $relations)
    {
        return $this->shippingInterface->search($request, $model, $conditions, $relations);
    }
}
