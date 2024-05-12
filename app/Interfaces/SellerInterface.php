<?php

namespace App\Interfaces;

interface SellerInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $seller);

    public function toogleActive($seller);

    public function find($seller);

    public function search($request, $model, $conditions);

    public function assignRoleSeller(array $data);
}
