<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductCategoryService;
use App\Services\ProductService;
use App\Services\ReturnRedirectService;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;

class ProductController extends Controller
{
    protected $productService;

    protected $productCategoryService;

    protected $returnRedirectService;

    public function __construct(ProductService $productService, ProductCategoryService $productCategoryService, ReturnRedirectService $returnRedirectService)
    {
        $this->productService = $productService;
        $this->productCategoryService = $productCategoryService;
        $this->returnRedirectService = $returnRedirectService;
    }

    public function indexFront()
    {
        return view('pages.product');
    }

    public function detailFront()
    {
        return view('pages.product-detail');
    }

    public function index(Request $request)
    {
        return view('pages.admin-seller.products.index', [
            'products' => $this->productService->search($request, new Product, ['name', 'stock', 'goods_price', 'sell_price', 'description', 'type'], ['productCategory']),
            'productCategories' => $this->productCategoryService->all(),
        ]);
    }

    public function store(ProductRequest $request)
    {
        // dd($request->validated());
        $this->productService->create($request->validated());

        Toaster::success('Product created successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.products.index'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->productService->update($request->validated(), $product);

        Toaster::success('Product updated successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.products.index'));
    }

    public function destroy(Request $request, Product $product)
    {
        $this->productService->delete($product);

        Toaster::success('Product deleted successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.products.index'));
    }

    public function search(Request $request)
    {
        return view('pages.admin-seller.products.table', [
            'products' => $this->productService->search($request, new Product, ['name', 'stock', 'goods_price', 'sell_price', 'description', 'type'], ['productCategory']),
            'productCategories' => $this->productCategoryService->all(),
        ]);
    }

    public function toggleActive(Request $request, Product $product)
    {
        $this->productService->toogleActive($product);

        Toaster::success('Product update status successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.products.index'));
    }
}
