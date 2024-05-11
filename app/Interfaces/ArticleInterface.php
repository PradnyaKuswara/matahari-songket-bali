<?php

namespace App\Interfaces;

interface ArticleInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $itemCategory);

    public function toggleActive($customer);

    public function delete($itemCategory);

    public function find($itemCategory);

    public function search($request, $model, $conditions, $relations);
}
