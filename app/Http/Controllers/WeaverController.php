<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeaverRequest;
use App\Models\User;
use App\Services\AddressService;
use App\Services\WeaverService;
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

    public function index()
    {
        return view('pages.admin.weavers.index', [
            'weavers' => $this->weaverService->all(),
        ]);
    }

    public function create()
    {
        return view('pages.admin.weavers.create');
    }

    public function store(WeaverRequest $request)
    {
        $weaver = $this->weaverService->create(collect($request->validated())->only(['name', 'gender', 'date_of_birth', 'phone_number'])->toArray());

        $this->addressService->create(collect($request->validated())->only(['city', 'province', 'address'])->toArray(), $weaver);

        Toaster::success('Weaver created successfully');

        return redirect()->route('admin.dashboard.weavers.index');
    }

    public function edit(User $weaver)
    {
        return view('pages.admin.weavers.edit', [
            'weaver' => $this->weaverService->find($weaver),
        ]);
    }

    public function update(WeaverRequest $request, User $weaver)
    {
        $this->weaverService->update(collect($request->validated())->only(['name', 'gender', 'date_of_birth', 'phone_number'])->toArray(), $weaver);

        $this->addressService->update(collect($request->validated())->only(['city', 'province', 'address'])->toArray(), $weaver->addresses()->first());

        Toaster::success('Weaver updated successfully');

        return redirect()->route('admin.dashboard.weavers.index');
    }

    public function destroy(User $weaver)
    {
        $this->weaverService->delete($weaver);

        Toaster::success('Weaver deleted successfully');

        return redirect()->route('admin.dashboard.weavers.index');
    }

    public function search(Request $request)
    {
        $user = User::whereHas('role', fn ($query) => $query->where('name', 'weaver'));

        return view('pages.admin.weavers.table', [
            'weavers' => $this->weaverService->search($request, $user, ['name']),
        ]);
    }
}
