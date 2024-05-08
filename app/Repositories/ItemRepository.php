<?php

namespace App\Repositories;

use App\Interfaces\ItemInterface;
use App\Models\Item;
use App\Services\SearchService;

class ItemRepository implements ItemInterface
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function all()
    {
        return Item::paginate(10);
    }

    public function firstOrCreate(array $data)
    {
        return Item::firstOrCreate($data);
    }

    public function update(array $data, $item)
    {
        return $item->update($data);
    }

    public function delete($item)
    {
        return $item->delete();
    }

    public function find($item)
    {
        return $item;
    }

    public function search($request, $model, $conditions, $relations)
    {
        return $this->searchService->handle($request, $model, $conditions, $relations)->paginate(10)->withQueryString()->withPath('items');
    }
}
