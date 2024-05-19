<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingRequest;
use App\Models\Shipping;
use App\Services\ShippingService;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;

class ShippingController extends Controller
{
    protected $shippingService;

    public function __construct(ShippingService $shippingService)
    {
        $this->shippingService = $shippingService;
    }

    public function index(Request $request)
    {
        return view('pages.customer.shippings.index', [
            'shippings' => $this->shippingService->all($request->user())->latest()->paginate(8),
        ]);
    }

    public function show(Shipping $shipping)
    {
        return view('pages.customer.shippings.show', [
            'shipping' => $shipping,
        ]);
    }

    public function indexSeller()
    {
        return view('pages.seller.shippings.index', [
            'shippings' => $this->shippingService->getAll()->where('status', 'pending')->latest()->paginate(8),
        ]);
    }

    public function update(ShippingRequest $request, Shipping $shipping)
    {
        $this->shippingService->update($request->validated(), $shipping);

        Toaster::success('Shipping updated successfully');

        return back()->with('success', 'Shipping updated successfully');
    }

    public function confirmation(Shipping $shipping)
    {
        $this->shippingService->confirmation($shipping);

        Toaster::success('Shipping confirmed successfully');

        return back()->with('success', 'Shipping confirmed successfully');
    }
}
