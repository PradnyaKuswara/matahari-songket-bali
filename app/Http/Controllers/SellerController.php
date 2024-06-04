<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellerRequest;
use App\Models\User;
use App\Services\AddressService;
use App\Services\SellerService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;

class SellerController extends Controller
{
    protected $sellerService;

    protected $addressService;

    public function __construct(SellerService $sellerService, AddressService $addressService)
    {
        $this->sellerService = $sellerService;
        $this->addressService = $addressService;
    }

    public function index(Request $request): View
    {
        $user = User::whereHas('role', fn ($query) => $query->where('name', 'seller'));

        return view('pages.admin.sellers.index', [
            'sellers' => $this->sellerService->search($request, $user, ['name', 'phone_number']),
        ]);
    }

    public function store(SellerRequest $request): RedirectResponse
    {
        $this->sellerService->create($request->validated());

        Toaster::success('Seller created successfully');

        return redirect()->route('admin.dashboard.sellers.index');
    }

    public function update(SellerRequest $request, User $seller): RedirectResponse
    {
        $this->sellerService->update($request->validated(), $seller);

        Toaster::success('Seller update successfully');

        return redirect()->route('admin.dashboard.sellers.index');
    }

    public function toggleActive(User $seller): RedirectResponse
    {
        $this->sellerService->toogleActive($seller);

        Toaster::success('Seller update status successfully');

        return redirect()->route('admin.dashboard.sellers.index');
    }

    public function search(Request $request): View
    {
        $user = User::whereHas('role', fn ($query) => $query->where('name', 'seller'));

        return view('pages.admin.sellers.table', [
            'sellers' => $this->sellerService->search($request, $user, ['name', 'phone_number']),
        ]);

    }
}
