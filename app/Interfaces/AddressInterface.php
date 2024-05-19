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

    public function addressCheckOut($user);
}
