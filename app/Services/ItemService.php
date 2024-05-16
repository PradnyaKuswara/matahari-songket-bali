<?php

namespace App\Services;

use App\Interfaces\ItemInterface;

class ItemService
{
    protected $itemInterface;

    public function __construct(ItemInterface $itemInterface)
    {
        $this->itemInterface = $itemInterface;
    }

    public function all()
    {
        return $this->itemInterface->all();
    }

    public function firstOrCreate(array $data)
    {
        $data['price'] = floatval(str_replace('.', '', $data['price']));

        return $this->itemInterface->firstOrCreate($data);
    }

    public function update(array $data, $item)
    {
        $data['price'] = floatval(str_replace('.', '', $data['price']));

        return $this->itemInterface->update($data, $item);
    }

    public function delete($item)
    {
        return $this->itemInterface->delete($item);
    }

    public function find($item)
    {
        return $this->itemInterface->find($item);
    }

    public function search($request, $model, $conditions, $relations)
    {
        return $this->itemInterface->search($request, $model, $conditions, $relations);
    }
}
