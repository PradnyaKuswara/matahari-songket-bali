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
        return Product::paginate(10);
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
        return $this->searchService->handle($request, $model, $conditions, $relations)->paginate(10)->withQueryString()->withPath('products');
    }
}
