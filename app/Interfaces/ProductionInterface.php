<?php

namespace App\Interfaces;

interface ProductionInterface
{
    public function all();

    public function create(array $data);

    public function createAttachedItem(array $data, $production);

    public function createAttachedProduct(array $data, $production, $weaverName);

    public function update(array $data, $production);

    public function delete($production);

    public function deleteDetachedItem($production, $item);

    public function deleteDetachedProduct($production, $product);

    public function find($production);

    public function search($request, $model, $conditions, $relations);
}
