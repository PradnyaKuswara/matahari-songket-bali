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

    protected $cities;

    protected $provinces;

    protected $districts;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;

        $this->provinces = cache()->remember('provinces', 180 * 24 * 60 * 60, function () {
            return Http::get('https://pro.rajaongkir.com/api/province', [
                'key' => config('shipping.api_key'),
            ])['rajaongkir']['results'];
        });

        $this->cities = cache()->remember('cities', 180 * 24 * 60 * 60, function () {
            return Http::get('https://pro.rajaongkir.com/api/city', [
                'key' => config('shipping.api_key'),
            ])['rajaongkir']['results'];
        });
    }

    public function index(Request $request): View
    {

        $provinceAfter = [];

        foreach ($this->provinces as $province) {
            $provinceAfter[] = [
                'id' => $province['province_id'],
                'name' => $province['province'],
            ];
        }

        return view('pages.customer.addresses.index', [
            'addresses' => $this->addressService->all($request->user()),
            'provinces' => $provinceAfter,
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
        $cities = array_filter($this->cities, function ($city) use ($request) {
            return $city['province_id'] == $request->province_id;
        });

        $citiesAfter = [];

        foreach ($cities as $city) {
            $citiesAfter[] = [
                'id' => $city['city_id'],
                'name' => $city['city_name'],
                'postal_code' => $city['postal_code'],
            ];
        }

        return response()->json([
            'status' => 'success',
            'value' => $citiesAfter,
        ], 200);
    }

    public function getSubdistricts(Request $request): JsonResponse
    {
        $districts = cache()->remember('districts_'.$request->city_id, 180 * 24 * 60 * 60, function () use ($request) {
            return Http::get('https://pro.rajaongkir.com/api/subdistrict', [
                'key' => config('shipping.api_key'),
                'city' => $request->city_id,
            ])['rajaongkir']['results'];
        });

        $districtsAfter = [];

        foreach ($districts as $district) {
            $districtsAfter[] = [
                'id' => $district['subdistrict_id'],
                'name' => $district['subdistrict_name'],
            ];
        }

        return response()->json([
            'status' => 'success',
            'value' => $districtsAfter,
        ], 200);
    }
}
