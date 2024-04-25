<?php

namespace App\Repositories;

use App\Interfaces\ProductCategoryInterface;
use App\Models\ProductCategory;
use App\Services\SearchService;

class ProductCategoryRepository implements ProductCategoryInterface
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function all()
    {
        return ProductCategory::paginate(10);
    }

    public function create(array $data)
    {
        return ProductCategory::create($data);
    }

    public function update(array $data, $itemCategory)
    {
        return $itemCategory->update($data);
    }

    public function delete($itemCategory)
    {
        return $itemCategory->delete();
    }

    public function find($itemCategory)
    {
        return $itemCategory;
    }

    public function search($request, $model, $conditions)
    {
        return $this->searchService->handle($request, $model, $conditions)->paginate(10)->withQueryString()->withPath('categories');
    }
}
