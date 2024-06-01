<?php

namespace App\Repositories;

use App\Interfaces\ShippingInterface;
use App\Models\Shipping;
use App\Services\SearchService;

class ShippingRepository implements ShippingInterface
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

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

    public function search($request, $model, $conditions, $relations)
    {
        return $this->searchService->handle($request, $model, $conditions, $relations)->latest()->paginate(8)->withQueryString()->withPath('show');
    }
}
