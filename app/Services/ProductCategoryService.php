<?php

namespace App\Services;

use App\Interfaces\ProductCategoryInterface;

class ProductCategoryService
{
    protected $productCategoryInterface;

    public function __construct(ProductCategoryInterface $productCategoryInterface)
    {
        $this->productCategoryInterface = $productCategoryInterface;
    }

    public function all()
    {
        return $this->productCategoryInterface->all();
    }

    public function create(array $data)
    {
        return $this->productCategoryInterface->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->productCategoryInterface->update($data, $id);
    }

    public function delete($id)
    {
        return $this->productCategoryInterface->delete($id);
    }

    public function find($id)
    {
        return $this->productCategoryInterface->find($id);
    }

    public function search($request, $model, $conditions)
    {
        return $this->productCategoryInterface->search($request, $model, $conditions);
    }
}
