<?php

namespace App\Repositories;

use App\Interfaces\CustomerInterface;
use App\Models\Role;
use App\Models\User;
use App\Services\SearchService;

class CustomerRepository implements CustomerInterface
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function all()
    {
        return User::whereHas('role', fn ($query) => $query->where('name', 'customer'))->paginate(10);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data, $customer)
    {
        return $customer->update($data);
    }

    public function toggleActive($customer)
    {
        return $customer->update(['is_active' => ! $customer->is_active]);
    }

    public function find($customer)
    {
        return $customer;
    }

    public function search($request, $model, $conditions)
    {
        return $this->searchService->handle($request, $model, $conditions)->paginate(10)->withQueryString()->withPath('customers');
    }

    public function assignRoleCustomer(array $data)
    {
        $data['role_id'] = Role::where('name', 'customer')->first()->id;

        return $data;
    }
}
