<?php

namespace App\Interfaces;

interface ItemCategoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $productCategory);

    public function delete($productCategory);

    public function find($productCategory);

    public function search($request, $model, $conditions);
}
