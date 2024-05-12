<?php

namespace App\Services;

use App\Interfaces\SellerInterface;

class SellerService
{
    protected $sellerInterface;

    public function __construct(SellerInterface $sellerInterface)
    {
        $this->sellerInterface = $sellerInterface;
    }

    public function all()
    {
        return $this->sellerInterface->all();
    }

    public function create(array $data)
    {
        return $this->sellerInterface->create($this->assignRoleSeller($data));
    }

    public function update(array $data, $seller)
    {
        return $this->sellerInterface->update($data, $seller);
    }

    public function toogleActive($seller)
    {
        return $this->sellerInterface->toogleActive($seller);
    }

    public function find($seller)
    {
        return $this->sellerInterface->find($seller);
    }

    public function search($request, $model, $conditions)
    {
        return $this->sellerInterface->search($request, $model, $conditions);
    }

    public function assignRoleSeller(array $data)
    {
        return $this->sellerInterface->assignRoleSeller($data);
    }
}
