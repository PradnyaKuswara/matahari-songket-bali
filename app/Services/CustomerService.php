<?php

namespace App\Services;

use App\Interfaces\CustomerInterface;

class CustomerService
{
    protected $customerInterface;

    public function __construct(CustomerInterface $customerInterface)
    {
        $this->customerInterface = $customerInterface;
    }

    public function all()
    {
        return $this->customerInterface->all();
    }

    public function create(array $data)
    {
        return $this->customerInterface->create($this->assignRoleCustomer($data));
    }

    public function update(array $data, $customer)
    {
        return $this->customerInterface->update($data, $customer);
    }

    public function updatePassword($customer, $password)
    {
        return $this->customerInterface->updatePassword($customer, $password);
    }

    public function toggleActive($customer)
    {
        return $this->customerInterface->toggleActive($customer);
    }

    public function find($customer)
    {
        return $this->customerInterface->find($customer);
    }

    public function search($request, $model, $conditions)
    {
        return $this->customerInterface->search($request, $model, $conditions);
    }

    public function assignRoleCustomer(array $data)
    {
        return $this->customerInterface->assignRoleCustomer($data);
    }
}
