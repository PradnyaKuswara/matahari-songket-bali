<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request): View
    {
        return view('pages.customer.orders.index', [
            'orders' => $this->orderService->all($request->user())->latest()->paginate(8),
        ]);
    }

    public function show(Order $order): View
    {
        return view('pages.customer.orders.show', [
            'order' => $order,
        ]);
    }

    public function showAdminSeller(Request $request): View
    {
        return view('pages.admin-seller.orders.show', [
            'orders' => $this->orderService->search($request, new Order, ['generate_id']),
        ]);
    }

    public function detailOrderAdminSeller(Order $order): View
    {
        return view('pages.admin-seller.orders.detail-order', [
            'order' => $order,
        ]);
    }

    public function search(Request $request): View
    {
        return view('pages.admin-seller.orders.data', [
            'orders' => $this->orderService->search($request, new Order, ['generate_id']),
        ]);
    }
}
