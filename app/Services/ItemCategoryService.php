<?php

namespace App\Services;

use App\Interfaces\ItemCategoryInterface;

class ItemCategoryService
{
    protected $itemCategoryInterface;

    public function __construct(ItemCategoryInterface $itemCategoryInterface)
    {
        $this->itemCategoryInterface = $itemCategoryInterface;
    }

    public function all()
    {
        return $this->itemCategoryInterface->all();
    }

    public function firstOrCreate(array $data)
    {
        return $this->itemCategoryInterface->firstOrCreate($data);
    }

    public function update(array $data, $itemCategory)
    {
        return $this->itemCategoryInterface->update($data, $itemCategory);
    }

    public function delete($itemCategory)
    {
        return $this->itemCategoryInterface->delete($itemCategory);
    }

    public function find($itemCategory)
    {
        return $this->itemCategoryInterface->find($itemCategory);
    }

    public function search($request, $model, $conditions)
    {
        return $this->itemCategoryInterface->search($request, $model, $conditions);
    }
}
