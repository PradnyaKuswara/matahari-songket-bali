<?php

namespace App\Http\Controllers;

use App\Services\ProductCategoryService;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    protected $productService;

    protected $productCategoryService;

    public function __construct(ProductService $productService, ProductCategoryService $productCategoryService)
    {
        $this->productService = $productService;
        $this->productCategoryService = $productCategoryService;
    }

    public function index(): View
    {
        $products = $this->productService->all()->where('stock', '>', 0)->latest()->take(6)->get();
        $productCategories = $this->productCategoryService->all()->where('image', '!=', null)->get();

        return view('pages.home', [
            'products' => $products,
            'productCategories' => $productCategories,
        ]);
    }

    public function successVerification(): View
    {
        return view('pages.success-verification-email');
    }
}
