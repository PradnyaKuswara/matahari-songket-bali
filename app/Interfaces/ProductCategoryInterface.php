<?php

namespace App\Interfaces;

interface ProductCategoryInterface
{
    public function all();

    public function firstOrCreate(array $data);

    public function update(array $data, $productCategory);

    public function delete($productCategory);

    public function find($productCategory);

    public function search($request, $model, $conditions);
}
