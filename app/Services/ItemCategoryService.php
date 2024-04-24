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

    public function create(array $data)
    {
        return $this->itemCategoryInterface->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->itemCategoryInterface->update($data, $id);
    }

    public function delete($id)
    {
        return $this->itemCategoryInterface->delete($id);
    }

    public function find($id)
    {
        return $this->itemCategoryInterface->find($id);
    }

    public function search($request, $model, $conditions)
    {
        return $this->itemCategoryInterface->search($request, $model, $conditions);
    }
}
