<?php

namespace App\Interfaces;

interface ItemInterface
{
    public function all();

    public function firstOrCreate(array $data);

    public function update(array $data, $item);

    public function delete($item);

    public function find($item);

    public function search($request, $model, $conditions, $relations);
}
