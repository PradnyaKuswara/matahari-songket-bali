<?php

namespace App\Interfaces;

interface ItemCategoryInterface
{
    public function all();

    public function firstOrCreate(array $data);

    public function update(array $data, $itemCategory);

    public function delete($itemCategory);

    public function find($itemCategory);

    public function search($request, $model, $conditions);
}
