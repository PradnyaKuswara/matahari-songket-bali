<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeaverRequest;
use App\Models\User;
use App\Services\AddressService;
use App\Services\WeaverService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Masmerise\Toaster\Toaster;

class WeaverController extends Controller
{
    protected $weaverService;

    protected $addressService;

    public function __construct(WeaverService $weaverService, AddressService $addressService)
    {
        $this->weaverService = $weaverService;
        $this->addressService = $addressService;
    }

    public function index(Request $request): View
    {
        $user = User::whereHas('role', fn ($query) => $query->where('name', 'weaver'));

        $provinces = cache()->remember('provinces', 60 * 60 * 24, function () {
            return Http::get('https://pro.rajaongkir.com/api/province', [
                'key' => config('shipping.api_key'),
            ])['rajaongkir']['results'];
        });

        $provinceAfter = [];

        foreach ($provinces as $province) {
            $provinceAfter[] = [
                'id' => $province['province_id'],
                'name' => $province['province'],
            ];
        }

        return view('pages.admin.weavers.index', [
            'weavers' => $this->weaverService->search($request, $user, ['name', 'phone_number', 'gender', 'address', 'province', 'city'], ['addresses']),
            'provinces' => $provinceAfter,
        ]);
    }

    public function store(WeaverRequest $request): RedirectResponse
    {
        $weaver = $this->weaverService->create(collect($request->validated())->only(['name', 'gender', 'date_of_birth', 'phone_number'])->toArray());

        $this->addressService->create(collect($request->validated())->only(['city', 'province', 'subdistrict', 'address', 'provinceSelect', 'citySelect', 'subdistrictSelect'])->toArray(), $weaver);

        Toaster::success('Weaver created successfully');

        return redirect()->route('admin.dashboard.weavers.index');
    }

    public function update(WeaverRequest $request, User $weaver): RedirectResponse
    {
        $this->weaverService->update(collect($request->validated())->only(['name', 'gender', 'date_of_birth', 'phone_number'])->toArray(), $weaver);

        $this->addressService->update(collect($request->validated())->only(['city', 'province', 'subdistrict', 'address', 'provinceSelect', 'citySelect', 'subdistrictSelect'])->toArray(), $weaver->addresses()->first());

        Toaster::success('Weaver updated successfully');

        return redirect()->route('admin.dashboard.weavers.index');
    }

    public function toggleActive(User $weaver): RedirectResponse
    {
        $this->weaverService->toogleActive($weaver);

        Toaster::success('Weaver update status successfully');

        return redirect()->route('admin.dashboard.weavers.index');
    }

    public function search(Request $request): View
    {
        $user = User::whereHas('role', fn ($query) => $query->where('name', 'weaver'));

        $provinces = cache()->remember('provinces', 60 * 60 * 24, function () {
            return Http::get('https://pro.rajaongkir.com/api/province', [
                'key' => config('shipping.api_key'),
            ])['rajaongkir']['results'];
        });

        $provinceAfter = [];

        foreach ($provinces as $province) {
            $provinceAfter[] = [
                'id' => $province['province_id'],
                'name' => $province['province'],
            ];
        }

        return view('pages.admin.weavers.table', [
            'weavers' => $this->weaverService->search($request, $user, ['name', 'phone_number', 'gender', 'address', 'province', 'city'], ['addresses']),
            'provinces' => $provinceAfter,
        ]);
    }
}
