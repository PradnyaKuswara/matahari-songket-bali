<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\User;
use App\Services\AddressService;
use App\Services\CustomerService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;

class CustomerController extends Controller
{
    protected $customerService;

    protected $addressService;

    public function __construct(CustomerService $customerService, AddressService $addressService)
    {
        $this->customerService = $customerService;
        $this->addressService = $addressService;
    }

    public function index(Request $request): View
    {
        $user = User::whereHas('role', fn ($query) => $query->where('name', 'customer'));

        return view('pages.admin.customers.index', [
            'customers' => $this->customerService->search($request, $user, ['name', 'email', 'username', 'gender', 'phone_number']),
        ]);
    }

    public function store(CustomerRequest $request): RedirectResponse
    {
        $this->customerService->create($request->validated());

        Toaster::success('Customer created successfully');

        return redirect()->route('admin.dashboard.customers.index');
    }

    public function update(CustomerRequest $request, User $customer): RedirectResponse
    {
        $this->customerService->update($request->validated(), $customer);

        Toaster::success('Customer update successfully');

        return redirect()->route('admin.dashboard.customers.index');
    }

    public function updatePassword(Request $request, User $customer): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'min:8'],
        ]);

        $this->customerService->updatePassword($customer, $request->password);

        Toaster::success('Customer update successfully');

        return redirect()->back();
    }

    public function toggleActive(User $customer): RedirectResponse
    {
        $this->customerService->toggleActive($customer);

        Toaster::success('Customer update successfully');

        return redirect()->route('admin.dashboard.customers.index');
    }

    public function search(Request $request): View
    {
        $user = User::whereHas('role', fn ($query) => $query->where('name', 'customer'));

        return view('pages.admin.customers.table', [
            'customers' => $this->customerService->search($request, $user, ['name', 'email', 'username', 'gender', 'phone_number']),
        ]);
    }

    public function showMenu(User $customer): View
    {
        return view('pages.admin.customers.show-menu', [
            'customer' => $customer,
        ]);
    }

    public function showAddress(User $customer): View
    {
        return view('pages.admin.customers.show-address', [
            'addresses' => $this->addressService->all($customer),
            'customer' => $customer,
        ]);
    }

    public function trackingOrder(): View
    {
        return view('pages.customer.trackings.index');
    }
}
