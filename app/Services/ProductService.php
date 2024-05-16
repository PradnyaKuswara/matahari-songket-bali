<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Interfaces\ProductInterface;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    protected $productInterface;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
    }

    public function all()
    {
        return $this->productInterface->all();
    }

    public function create(array $data)
    {
        $data['slug'] = $data['name'];
        $data['stock'] = floatval(str_replace('.', '', $data['stock']));
        $data['goods_price'] = floatval(str_replace('.', '', $data['goods_price']));
        $data['sell_price'] = floatval(str_replace('.', '', $data['sell_price']));

        for ($i = 0; $i < 4; $i++) {
            $image = 'image_'.($i + 1);
            if (isset($data[$image])) {
                $data[$image] = $data[$image]->store('products');
            }
        }

        return $this->productInterface->create($data);
    }

    public function update(ProductRequest $request, array $data, $product)
    {

        $data['stock'] = floatval(str_replace('.', '', $data['stock']));
        $data['goods_price'] = floatval(str_replace('.', '', $data['goods_price']));
        $data['sell_price'] = floatval(str_replace('.', '', $data['sell_price']));

        if ($request->name !== $product->name) {
            $data['slug'] = $data['name'];
        }

        for ($i = 0; $i < 4; $i++) {
            $image = 'image_'.($i + 1);
            if (isset($data[$image])) {
                Storage::delete($product->image_.($i + 1));
                $data[$image] = $data[$image]->store('products');
            }
        }

        return $this->productInterface->update($data, $product);
    }

    public function toogleActive($product)
    {
        return $this->productInterface->toogleActive($product);
    }

    public function delete($product)
    {
        return $this->productInterface->delete($product);
    }

    public function find($product)
    {
        return $this->productInterface->find($product);
    }

    public function search($request, $model, $conditions, $relations)
    {
        return $this->productInterface->search($request, $model, $conditions, $relations);
    }

    public function searchFront($request, $model, $conditions, $relations)
    {
        return $this->productInterface->searchFront($request, $model, $conditions, $relations);
    }
}
