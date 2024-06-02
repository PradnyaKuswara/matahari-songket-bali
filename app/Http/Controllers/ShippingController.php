<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingRequest;
use App\Models\Shipping;
use App\Services\MailService;
use App\Services\ShippingService;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;

class ShippingController extends Controller
{
    protected $shippingService;

    protected $mailService;

    public function __construct(ShippingService $shippingService, MailService $mailService)
    {
        $this->shippingService = $shippingService;
        $this->mailService = $mailService;
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
            'shippings' => $this->shippingService->getAll()->where('status', 'packing')->latest()->paginate(8),
        ]);
    }

    public function showSeller(Shipping $shipping)
    {
        return view('pages.seller.shippings.show', [
            'shipping' => $shipping,
        ]);
    }

    public function update(ShippingRequest $request, Shipping $shipping)
    {
        if ($request->shipped_at > $request->delivered_at) {
            Toaster::error('Shipped at must be less than delivered at');

            return back()->with('error', 'Shipped at must be less than delivered at');
        }

        if ($request->shipped_at < now()->format('Y-m-d')) {
            Toaster::error('Shipped at must be greater than now');

            return back()->with('error', 'Shipped at must be greater than now');
        }

        if ($request->delivered_at < now()->format('Y-m-d')) {
            Toaster::error('Delivered at must be greater than now');

            return back()->with('error', 'Delivered at must be greater than now');
        }

        $this->shippingService->update($request->validated(), $shipping);

        if ($request->notification == 'yes') {
            $this->mailService->sendShipped($shipping);
        }

        Toaster::success('Shipping updated successfully');

        return redirect()->route('seller.dashboard.shippings.index');
    }

    public function confirmation(Shipping $shipping)
    {
        $this->shippingService->confirmation($shipping);

        Toaster::success('Shipping confirmed successfully');

        return back()->with('success', 'Shipping confirmed successfully');
    }

    public function showAdminSeller(Request $request)
    {
        return view('pages.admin-seller.shippings.show', [
            'shippings' => $this->shippingService->search($request, new Shipping, ['generate_id'], ['order']),
        ]);
    }

    public function detailShippingAdminSeller(Shipping $shipping)
    {
        return view('pages.admin-seller.shippings.detail-shipping', [
            'shipping' => $shipping,
        ]);
    }

    public function search(Request $request)
    {
        return view('pages.admin-seller.shippings.data', [
            'shippings' => $this->shippingService->search($request, new Shipping, ['generate_id'], ['order']),
        ]);
    }
}
