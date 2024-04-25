<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use App\Services\ProductCategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Masmerise\Toaster\Toaster;

class ProductCategoryController extends Controller
{
    protected $productCategoryService;

    public function __construct(ProductCategoryService $productCategoryService)
    {
        $this->productCategoryService = $productCategoryService;
    }

    public function index(Request $request)
    {
        return view('pages.admin.products.categories.index', [
            'productCategories' => $this->productCategoryService->search($request, new ProductCategory, ['name']),
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.products.categories.create');
    }

    public function store(ProductCategoryRequest $request): RedirectResponse
    {
        $this->productCategoryService->create($request->validated());

        Toaster::success('Product category created successfully');

        return redirect()->route('admin.dashboard.products.categories.index');
    }

    public function edit(ProductCategory $productCategory): View
    {
        return view('pages.admin.products.categories.edit', [
            'productCategory' => $this->productCategoryService->find($productCategory),
        ]);
    }

    public function update(ProductCategoryRequest $request, ProductCategory $productCategory): RedirectResponse
    {
        $this->productCategoryService->update($request->validated(), $productCategory);

        Toaster::success('Product category updated successfully');

        return redirect()->route('admin.dashboard.products.categories.index');
    }

    public function destroy(ProductCategory $productCategory): RedirectResponse
    {
        $this->productCategoryService->delete($productCategory);

        Toaster::success('Product category deleted successfully');

        return redirect()->route('admin.dashboard.products.categories.index');
    }

    public function search(Request $request): View
    {
        return view('pages.admin.products.categories.table', [
            'productCategories' => $this->productCategoryService->search($request, new ProductCategory, ['name']),
        ]);
    }
}
