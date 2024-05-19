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
        $courier = $data['courier'];

        if ($courier == 'JNE') {
            $data['tracking_link'] = 'https://www.jne.co.id/en/tracking/trace';
        }

        if ($courier == 'JNT') {
            $data['tracking_link'] = 'https://www.jet.co.id/track';
        }
        $data['status'] = 'shipping';
        $data['max_confirm'] = Carbon::parse($data['shipped_at'])->addDays(7);
        $shipping = $this->shippingInterface->update($data, $shipping);

        return $shipping;
    }

    public function confirmation($shipping)
    {
        return $this->shippingInterface->confirmation($shipping);
    }
}
