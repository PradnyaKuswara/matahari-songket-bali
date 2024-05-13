<?php

namespace App\Http\Controllers;

use App\Services\ProductService;

class HomeController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->all()->where('stock', '>', 0)->latest()->take(6)->get();

        return view('pages.home', [
            'products' => $products,
        ]);
    }
}
