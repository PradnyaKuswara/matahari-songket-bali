<?php

namespace App\Repositories;

use App\Interfaces\ItemCategoryInterface;
use App\Models\ItemCategory;
use App\Services\SearchService;

class ItemCategoryRepository implements ItemCategoryInterface
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function all()
    {
        return ItemCategory::all();
    }

    public function firstOrCreate(array $data)
    {
        return ItemCategory::firstOrCreate($data);
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
        return $this->searchService->handle($request, $model, $conditions)->latest()->paginate(10)->withQueryString()->withPath('categories');
    }
}
