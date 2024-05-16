<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;
use App\Services\SearchService;

class ProductRepository implements ProductInterface
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function all()
    {
        return Product::where('is_active', true);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(array $data, $product)
    {
        return $product->update($data);
    }

    public function toogleActive($product)
    {
        return $product->update(['is_active' => ! $product->is_active]);
    }

    public function delete($product)
    {
        return $product->delete();
    }

    public function find($product)
    {
        return $product;
    }

    public function search($request, $model, $conditions, $relations)
    {
        return $this->searchService->handle($request, $model, $conditions, $relations)->latest()->paginate(10)->withQueryString()->withPath('products');
    }

    public function searchFront($request, $model, $conditions, $relations)
    {
        return $this->searchService->handle($request, $model, $conditions, $relations)->where('is_active', true)->orderByRaw('stock > 0 desc, created_at desc')->paginate(9)->withQueryString()->withPath('products');
    }
}
