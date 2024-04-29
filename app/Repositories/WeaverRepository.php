<?php

namespace App\Repositories;

use App\Interfaces\WeaverInterface;
use App\Models\Role;
use App\Models\User;
use App\Services\SearchService;

class WeaverRepository implements WeaverInterface
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function all()
    {
        return User::whereHas('role', fn ($query) => $query->where('name', 'weaver'))->paginate(10);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data, $user)
    {
        return $user->update($data);
    }

    public function delete($user)
    {
        return $user->delete();
    }

    public function find($user)
    {
        return $user;
    }

    public function search($request, $model, $conditions)
    {
        return $this->searchService->handle($request, $model, $conditions)->paginate(10)->withQueryString()->withPath('weavers');
    }

    public function assignRoleWeaver(array $data)
    {
        $data['role_id'] = Role::where('name', 'weaver')->first()->id;

        return $data;
    }
}
