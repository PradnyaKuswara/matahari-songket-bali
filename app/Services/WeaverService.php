<?php

namespace App\Services;

use App\Interfaces\WeaverInterface;

class WeaverService
{
    protected $weaverInterface;

    public function __construct(WeaverInterface $weaverInterface)
    {
        $this->weaverInterface = $weaverInterface;
    }

    public function all()
    {
        return $this->weaverInterface->all();
    }

    public function create(array $data)
    {
        return $this->weaverInterface->create($this->assignRoleWeaver($data));
    }

    public function update(array $data, $weaver)
    {
        return $this->weaverInterface->update($data, $weaver);
    }

    public function toogleActive($weaver)
    {
        return $this->weaverInterface->toogleActive($weaver);
    }

    public function find($weaver)
    {
        return $this->weaverInterface->find($weaver);
    }

    public function search($request, $model, $conditions)
    {
        return $this->weaverInterface->search($request, $model, $conditions);
    }

    public function assignRoleWeaver(array $data)
    {
        return $this->weaverInterface->assignRoleWeaver($data);
    }
}
