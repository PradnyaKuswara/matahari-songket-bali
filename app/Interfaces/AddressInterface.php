<?php

namespace App\Interfaces;

interface AddressInterface
{
    public function all($user);

    public function create(array $data, $user);

    public function update(array $data, $address);

    public function updateStatus($user, $address);

    public function deactiveAllStatus($user);

    public function delete($address);

    public function find($address);

    // public function search($request, $model, $conditions);

    // public function createAttached(array $data, $user, $status);

    // public function deleteDetached($user, $address);
}
