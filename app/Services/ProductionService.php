<?php

namespace App\Services;

use App\Interfaces\ProductionInterface;
use Illuminate\Support\Arr;

class ProductionService
{
    protected $ProductionInterface;

    protected $ItemService;

    protected $itemCategoryService;

    protected $ProductService;

    protected $productCategoryService;

    public function __construct(ProductionInterface $ProductionInterface, ItemService $ItemService, ItemCategoryService $itemCategoryService, ProductService $ProductService, ProductCategoryService $productCategoryService)
    {
        $this->ProductionInterface = $ProductionInterface;
        $this->ItemService = $ItemService;
        $this->itemCategoryService = $itemCategoryService;
        $this->ProductService = $ProductService;
        $this->productCategoryService = $productCategoryService;
    }

    public function all()
    {
        return $this->ProductionInterface->all();
    }

    public function create(array $data)
    {
        $items = $this->createItemProduction($data);
        $products = $this->createProductProduction($items['data']);

        $production = $this->ProductionInterface->create(Arr::except($items['data'], 'items'));

        foreach ($items['items'] as $item) {
            $this->createAttachedItem(['item_id' => $item->id], $production);
        }

        foreach ($products as $index => $product) {
            $this->createAttachedProduct(['product_id' => $product->id], $production, $data['products'][$index]['weaver_name']);
        }

        return $production;
    }

    public function createAttachedItem(array $data, $production)
    {
        return $this->ProductionInterface->createAttachedItem($data, $production);
    }

    public function createAttachedProduct(array $data, $production, $weaverName)
    {
        return $this->ProductionInterface->createAttachedProduct($data, $production, $weaverName);
    }

    public function update(array $data, $production)
    {
        $items = $this->createItemProduction($data);

        $this->ProductionInterface->update(Arr::except($items['data'], 'items'), $production);

        $itemId = [];
        foreach ($items['items'] as $item) {
            array_push($itemId, $item->id);
        }
        $production->items()->detach();
        $this->createAttachedItem($itemId, $production);

        $productId = [];
        $weaverName = [];
        foreach ($data['products'] as $index => $product_input) {
            $productCategory = $this->productCategoryService->firstOrCreate(['name' => $product_input['category_name']]);

            if ($index < $production->products()->count()) {
                $product = $production->products[$index];
                $product->update([
                    'name' => $product_input['name'],
                    'goods_price' => $items['data']['goods_price'],
                    'sell_price' => floatval(str_replace('.', '', $product_input['profit'])) + $items['data']['goods_price'],
                    'product_category_id' => $productCategory->id,
                    'is_active' => false,
                    'type' => 'manufactured',
                ]);
            } else {
                $product = $this->ProductService->create([
                    'name' => $product_input['name'],
                    'goods_price' => $items['data']['goods_price'],
                    'sell_price' => floatval(str_replace('.', '', $product_input['profit'])) + $items['data']['goods_price'],
                    'product_category_id' => $productCategory->id,
                    'is_active' => false,
                    'type' => 'manufactured',
                ]);
            }

            array_push($productId, $product->id);
            array_push($weaverName, $product_input['weaver_name']);
        }

        $production->products()->detach();
        foreach ($productId as $index => $id) {
            $this->createAttachedProduct(['product_id' => $id], $production, $weaverName[$index]);
        }

        return $production;
    }

    public function delete($production)
    {
        return $this->ProductionInterface->delete($production);
    }

    public function deleteDetachedItem($production, $item)
    {
        return $this->ProductionInterface->deleteDetachedItem($production, $item);
    }

    public function deleteDetachedProduct($production, $product)
    {
        return $this->ProductionInterface->deleteDetachedProduct($production, $product);
    }

    public function find($production)
    {
        return $this->ProductionInterface->find($production);
    }

    public function search($request, $model, $conditions, $relations)
    {
        return $this->ProductionInterface->search($request, $model, $conditions, $relations);
    }

    public function createItemProduction(array $data)
    {
        // Initialize variables
        $data['material'] = 0;
        $data['service'] = 0;
        $data['total'] = 0;
        $data['goods_price'] = 0;
        $items = [];

        foreach ($data['items'] as $index => $item_input) {
            $itemCategory = $this->itemCategoryService->firstOrCreate(['name' => $item_input['category_name']]);

            $items[] = $this->ItemService->firstOrCreate([
                'name' => $item_input['name'],
                'price' => floatval(str_replace('.', '', $item_input['price'])),
                'item_category_id' => $itemCategory->id,
            ]);

            $data['material'] += $items[$index]->itemCategory->name == 'material' ? $items[$index]->price : 0;
            $data['service'] += $items[$index]->itemCategory->name == 'service' ? $items[$index]->price : 0;
        }

        $data['total'] += $data['material'] + $data['service'];
        $data['goods_price'] = $data['total'] / count($data['products']);

        return [
            'data' => $data,
            'items' => $items,
        ];
    }

    public function createProductProduction(array $data)
    {
        $products = [];

        foreach ($data['products'] as $index => $product_input) {
            $productCategory = $this->productCategoryService->firstOrCreate(['name' => $product_input['category_name']]);

            $products[] = $this->ProductService->create([
                'name' => $product_input['name'],
                'goods_price' => $data['goods_price'],
                'sell_price' => floatval(str_replace('.', '', $product_input['profit'])) + $data['goods_price'],
                'product_category_id' => $productCategory->id,
                'is_active' => false,
                'type' => 'manufactured',
            ]);
        }

        return $products;
    }
}
