<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressUpdateRequest;
use App\Models\Address;
use App\Services\AddressService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
        $provinces = Http::get('https://pro.rajaongkir.com/api/province', [
            'key' => config('shipping.api_key'),
        ])['rajaongkir']['results'];

        // change array key province_id to id and province to name
        $provinces = array_map(function ($province) {
            return [
                'id' => $province['province_id'],
                'name' => $province['province'],
            ];
        }, $provinces);

        return view('pages.customer.addresses.index', [
            'addresses' => $this->addressService->all($request->user()),
            'provinces' => $provinces,
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

        if (session()->has('link-direct-checkout')) {
            session()->forget('link-direct-checkout');

            return redirect()->route('checkout.index');
        }

        return redirect()->route('customer.dashboard.address.index');
    }

    public function getCities(Request $request): JsonResponse
    {
        $cities = Http::get('https://pro.rajaongkir.com/api/city', [
            'key' => config('shipping.api_key'),
            'province' => $request->province_id,
        ])['rajaongkir']['results'];

        // change array key city_id to id and city_name to name
        $cities = array_map(function ($city) {
            return [
                'id' => $city['city_id'],
                'name' => $city['city_name'],
                'postal_code' => $city['postal_code'],
            ];
        }, $cities);

        return response()->json([
            'status' => 'success',
            'value' => $cities,
        ], 200);
    }

    public function getSubdistricts(Request $request): JsonResponse
    {
        $districts = Http::get('https://pro.rajaongkir.com/api/subdistrict', [
            'key' => config('shipping.api_key'),
            'city' => $request->city_id,
        ])['rajaongkir']['results'];

        // change array key subdistrict_id to id and subdistrict_name to name
        $districts = array_map(function ($district) {
            return [
                'id' => $district['subdistrict_id'],
                'name' => $district['subdistrict_name'],
            ];
        }, $districts);

        return response()->json([
            'status' => 'success',
            'value' => $districts,
        ], 200);
    }
}
