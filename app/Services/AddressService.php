<?php

namespace App\Services;

use App\Interfaces\AddressInterface;

class AddressService
{
    protected $addressInterface;

    public function __construct(AddressInterface $addressInterface)
    {
        $this->addressInterface = $addressInterface;
    }

    public function all($user)
    {
        return $this->addressInterface->all($user);
    }

    public function create(array $data, $user)
    {
        if ($user->addresses->count() == 0) {
            $data['is_active'] = true;
        }

        return $this->addressInterface->create($data, $user);
    }

    public function update(array $data, $address)
    {
        return $this->addressInterface->update($data, $address);
    }

    public function updateStatus($user, $address)
    {
        $this->deactiveAllStatus($user);

        return $this->addressInterface->updateStatus($user, $address);
    }

    public function deactiveAllStatus($user)
    {
        return $this->addressInterface->deactiveAllStatus($user);
    }

    public function delete($address)
    {
        return $this->addressInterface->delete($address);
    }

    public function find($address)
    {
        return $this->addressInterface->find($address);
    }

    public function addressCheckOut($user)
    {
        return $this->addressInterface->addressCheckOut($user);
    }

    // public function search($request, $model, $conditions)
    // {
    //     return $this->addressInterface->search($request, $model, $conditions);
    // }

    // public function createAttached(array $data, $user)
    // {
    //     $address = $this->create($data);

    //     if ($user->addresses->count() == 0 || $user->addresses->every(function ($address) use ($user) {
    //         return $address->users->find($user->id)->pivot->is_active == false;
    //     })) {
    //         return $this->addressInterface->createAttached(['address_id' => $address->id], $user, true);
    //     }

    //     return $this->addressInterface->createAttached(['address_id' => $address->id], $user, false);
    // }

    // public function deleteDetached($user, $address)
    // {
    //     return $this->addressInterface->deleteDetached($user, $address);
    // }

}
