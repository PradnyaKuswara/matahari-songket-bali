<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\User;
use App\Services\AddressService;
use App\Services\CustomerService;
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

    public function index(Request $request)
    {
        $user = User::whereHas('role', fn ($query) => $query->where('name', 'customer'));

        return view('pages.admin.customers.index', [
            'customers' => $this->customerService->search($request, $user, ['name', 'phone_number']),
        ]);
    }

    public function create()
    {
        return view('pages.admin.customers.create');
    }

    public function store(CustomerRequest $request)
    {
        $this->customerService->create($request->validated());

        Toaster::success('Customer created successfully');

        return redirect()->route('admin.dashboard.customers.index');
    }

    public function edit(User $customer)
    {
        return view('pages.admin.customers.edit', [
            'customer' => $customer,
        ]);
    }

    public function update(CustomerRequest $request, User $customer)
    {
        $this->customerService->update($request->validated(), $customer);

        Toaster::success('Customer update successfully');

        return redirect()->route('admin.dashboard.customers.index');
    }

    public function toggleActive(User $customer)
    {
        $this->customerService->toggleActive($customer);

        Toaster::success('Customer update successfully');

        return redirect()->route('admin.dashboard.customers.index');
    }

    public function search(Request $request)
    {
        $user = User::whereHas('role', fn ($query) => $query->where('name', 'customer'));

        return view('pages.admin.customers.table', [
            'customers' => $this->customerService->search($request, $user, ['name', 'phone_number']),
        ]);
    }

    public function showMenu(User $customer)
    {
        return view('pages.admin.customers.show-menu', [
            'customer' => $customer,
        ]);
    }

    public function showAddress(User $customer)
    {
        return view('pages.admin.customers.show-address', [
            'addresses' => $this->addressService->all($customer),
        ]);
    }
}
