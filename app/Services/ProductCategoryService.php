<?php

namespace App\Services;

use App\Interfaces\ProductCategoryInterface;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

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

    public function firstOrCreate(array $data)
    {
        if (isset($data['image'])) {
            $imagePath = $data['image']->store(ProductCategory::IMAGE_PATH);
            $data['image'] = $imagePath;
        }

        return $this->productCategoryInterface->firstOrCreate($data);
    }

    public function update($request, array $data, $productCategory)
    {
        if ($request->hasFile('image')) {
            Storage::delete($productCategory->image);
            $imagePath = $data['image']->store(ProductCategory::IMAGE_PATH);
            $data['image'] = $imagePath;
        } else {
            $data['image'] = $productCategory->image;
        }

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
