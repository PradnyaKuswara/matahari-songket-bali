<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressUpdateRequest;
use App\Models\Address;
use App\Services\AddressService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;

class AddressController extends Controller
{
    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function index(Request $request): View
    {
        return view('pages.customer.addresses.index', [
            'addresses' => $this->addressService->all($request->user()),
        ]);
    }

    public function store(AddressUpdateRequest $request): RedirectResponse
    {
        $this->addressService->create($request->validated(), $request->user());

        Toaster::success('Address created successfully');

        if (session()->has('link-direct-checkout')) {
            session()->forget('link-direct-checkout');

            return redirect()->route('checkout.index');
        }

        return redirect()->route('customer.dashboard.address.index');
    }

    public function update(AddressUpdateRequest $request, Address $address): RedirectResponse
    {
        $this->authorize('customer-address', $address);

        $this->addressService->update($request->validated(), $address);

        Toaster::success('Address updated successfully');

        if (session()->has('link-direct-checkout')) {
            session()->forget('link-direct-checkout');

            return redirect()->route('checkout.index');
        }

        return redirect()->route('customer.dashboard.address.index');
    }

    public function updateStatus(Request $request, Address $address): RedirectResponse
    {
        $this->authorize('customer-address', $address);

        $this->addressService->updateStatus($request->user(), $address);

        Toaster::success('Address status updated successfully');

        if (session()->has('link-direct-checkout')) {
            session()->forget('link-direct-checkout');

            return redirect()->route('checkout.index');
        }

        return redirect()->route('customer.dashboard.address.index');
    }

    public function destroy(Address $address): RedirectResponse
    {
        $this->authorize('customer-address', $address);

        $this->addressService->delete($address);

        Toaster::success('Address deleted successfully');

        return redirect()->route('customer.dashboard.address.index');
    }
}
