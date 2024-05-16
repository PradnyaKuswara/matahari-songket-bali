<?php

namespace App\Repositories;

use App\Interfaces\ProductionInterface;
use App\Models\Production;
use App\Services\SearchService;

class ProductionRepository implements ProductionInterface
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function all()
    {
        return Production::paginate(10);
    }

    public function create(array $data)
    {
        return Production::create($data);
    }

    public function createAttachedItem(array $data, $production)
    {
        return $production->items()->attach($data);
    }

    public function createAttachedProduct(array $data, $production, $weaverName)
    {
        return $production->products()->attach($data, ['weaver_name' => $weaverName]);
    }

    public function update(array $data, $production)
    {
        return $production->update($data);
    }

    public function delete($production)
    {
        return $production->delete();
    }

    public function deleteDetachedItem($production, $item)
    {
        return $production->items()->detach($item);
    }

    public function deleteDetachedProduct($production, $product)
    {
        return $production->products()->detach($product);
    }

    public function find($production)
    {
        return $production;
    }

    public function search($request, $model, $conditions, $relations)
    {
        return $this->searchService->handle($request, $model, $conditions, $relations)->latest()->paginate(10)->withQueryString()->withPath('productions');
    }
}
