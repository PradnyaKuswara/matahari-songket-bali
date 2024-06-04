<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): View
    {
        $products = $this->productService->all()->where('stock', '>', 0)->latest()->take(6)->get();

        return view('pages.home', [
            'products' => $products,
        ]);
    }
}
