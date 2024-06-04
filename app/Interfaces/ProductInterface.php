<?php

namespace App\Interfaces;

interface ProductInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $product);

    public function toogleActive($product);

    public function delete($product);

    public function find($product);

    public function search($request, $model, $conditions, $relations);

    public function searchFront($request, $model, $conditions, $relations);

    public function updateStock($order);
}
