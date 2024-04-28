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

    public function update(array $data, $productCategory)
    {
        return $this->productCategoryInterface->update($data, $productCategory);
    }

    public function delete($productCategory)
    {
        return $this->productCategoryInterface->delete($productCategory);
    }

    public function find($productCategory)
    {
        return $this->productCategoryInterface->find($productCategory);
    }

    public function search($request, $model, $conditions)
    {
        return $this->productCategoryInterface->search($request, $model, $conditions);
    }
}
