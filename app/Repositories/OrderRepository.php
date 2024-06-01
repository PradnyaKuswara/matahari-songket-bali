<?php

namespace App\Repositories;

use App\Interfaces\OrderInterface;
use App\Models\Order;
use App\Services\SearchService;

class OrderRepository implements OrderInterface
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function all($user)
    {
        return $user->orders();
    }

    public function getAll()
    {
        return Order::query();
    }

    public function find($id)
    {
        return Order::find($id);
    }

    public function create(array $data)
    {
        return Order::create($data);
    }

    public function createAttachedProduct(array $data, $order)
    {
        return $order->products()->attach(['product_id' => $data['product_id']], ['quantity' => $data['quantity'], 'price' => $data['price'], 'total_price' => $data['total_price']]);
    }

    public function updateStatus($order, $status)
    {
        return $order->update(['status' => $status]);
    }

    public function checkStock($order)
    {
        foreach ($order->products as $product) {
            if ($product->pivot->quantity > $product->stock) {
                $order->update(['status' => false]);
                $order->transaction()->update(['status' => 'cancel']);

                return false;
            }
        }

        return true;
    }

    public function search($request, $model, $conditions)
    {
        return $this->searchService->handle($request, $model, $conditions)->latest()->paginate(8)->withQueryString()->withPath('show');
    }
}
