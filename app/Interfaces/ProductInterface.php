<?php

namespace App\Interfaces;

interface ProductInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $product);

    public function toogleActive($weaver);

    public function delete($product);

    public function find($product);

    public function search($request, $model, $conditions, $relations);
}
