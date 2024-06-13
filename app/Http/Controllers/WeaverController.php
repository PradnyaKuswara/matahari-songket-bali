<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeaverRequest;
use App\Models\User;
use App\Services\AddressService;
use App\Services\WeaverService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        return view('pages.admin.weavers.index', [
            'weavers' => $this->weaverService->search($request, $user, ['name', 'phone_number', 'gender']),
        ]);
    }

    public function store(WeaverRequest $request): RedirectResponse
    {
        $weaver = $this->weaverService->create(collect($request->validated())->only(['name', 'gender', 'date_of_birth', 'phone_number'])->toArray());

        $this->addressService->create(collect($request->validated())->only(['city', 'province', 'address'])->toArray(), $weaver);

        Toaster::success('Weaver created successfully');

        return redirect()->route('admin.dashboard.weavers.index');
    }

    public function update(WeaverRequest $request, User $weaver): RedirectResponse
    {
        $this->weaverService->update(collect($request->validated())->only(['name', 'gender', 'date_of_birth', 'phone_number'])->toArray(), $weaver);

        $this->addressService->update(collect($request->validated())->only(['city', 'province', 'address'])->toArray(), $weaver->addresses()->first());

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

        return view('pages.admin.weavers.table', [
            'weavers' => $this->weaverService->search($request, $user, ['name', 'phone_number', 'gender']),
        ]);
    }
}
