<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use App\Services\ProductCategoryService;
use App\Services\ReturnRedirectService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;

class ProductCategoryController extends Controller
{
    protected $productCategoryService;

    protected $returnRedirectService;

    public function __construct(ProductCategoryService $productCategoryService, ReturnRedirectService $returnRedirectService)
    {
        $this->productCategoryService = $productCategoryService;
        $this->returnRedirectService = $returnRedirectService;
    }

    public function index(Request $request): View
    {
        return view('pages.admin.products.categories.index', [
            'productCategories' => $this->productCategoryService->search($request, new ProductCategory, ['name']),
        ]);
    }

    public function store(ProductCategoryRequest $request): RedirectResponse
    {
        $this->productCategoryService->firstOrCreate($request->validated());

        Toaster::success('Product category created successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.products.categories.index'));
    }

    public function update(ProductCategoryRequest $request, ProductCategory $productCategory): RedirectResponse
    {
        $this->productCategoryService->update($request, $request->validated(), $productCategory);

        Toaster::success('Product category updated successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.products.categories.index'));
    }

    public function destroy(Request $request, ProductCategory $productCategory): RedirectResponse
    {
        $this->productCategoryService->delete($productCategory);

        Toaster::success('Product category deleted successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.products.categories.index'));
    }

    public function search(Request $request): View
    {
        return view('pages.admin.products.categories.table', [
            'productCategories' => $this->productCategoryService->search($request, new ProductCategory, ['name']),
        ]);
    }
}
