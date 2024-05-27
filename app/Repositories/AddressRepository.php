<?php

namespace App\Repositories;

use App\Interfaces\AddressInterface;
use App\Services\SearchService;

class AddressRepository implements AddressInterface
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function all($user)
    {
        return $user->addresses()->latest()->paginate(9);
    }

    public function create(array $data, $user)
    {
        return $user->addresses()->create($data);
    }

    public function update(array $data, $address)
    {
        return $address->update($data);
    }

    public function updateStatus($user, $address)
    {
        return $address->update(['is_active' => ! $address->is_active]);
    }

    public function deactiveAllStatus($user)
    {
        return $user->addresses()->update(['is_active' => false]);
    }

    public function delete($address)
    {
        return $address->delete();
    }

    public function find($address)
    {
        return $address;
    }

    public function addressCheckOut($user)
    {
        return $user->load(['addresses' => function ($query) {
            $query->where('is_active', true);
        }]);
    }
}
