<?php

namespace App\Interfaces;

interface CustomerInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $customer);

    public function updatePassword($customer, $password);

    public function toggleActive($customer);

    public function find($customer);

    public function search($request, $model, $conditions);

    public function assignRoleCustomer(array $data);
}
