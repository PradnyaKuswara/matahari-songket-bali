<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.product');
    }

    public function detail()
    {
        return view('pages.product-detail');
    }
}
