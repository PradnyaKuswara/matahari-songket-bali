<?php

namespace App\Repositories;

use App\Interfaces\SellerInterface;
use App\Models\Role;
use App\Models\User;
use App\Services\SearchService;

class SellerRepository implements SellerInterface
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function all()
    {
        return User::whereHas('role', fn ($query) => $query->where('name', 'seller'))->get();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data, $seller)
    {
        return $seller->update($data);
    }

    public function toogleActive($seller)
    {
        return $seller->update(['is_active' => ! $seller->is_active]);
    }

    public function find($seller)
    {
        return $seller;
    }

    public function search($request, $model, $conditions)
    {
        return $this->searchService->handle($request, $model, $conditions)->latest()->paginate(10)->withQueryString()->withPath('sellers');
    }

    public function assignRoleSeller(array $data)
    {
        $data['role_id'] = Role::where('name', 'seller')->first()->id;

        return $data;
    }
}
