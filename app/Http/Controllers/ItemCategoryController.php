<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemCategoryRequest;
use App\Models\ItemCategory;
use App\Services\ItemCategoryService;
use App\Services\ReturnRedirectService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;

class ItemCategoryController extends Controller
{
    protected $itemCategoryService;

    protected $returnRedirectService;

    public function __construct(ItemCategoryService $itemCategoryService, ReturnRedirectService $returnRedirectService)
    {
        $this->itemCategoryService = $itemCategoryService;
        $this->returnRedirectService = $returnRedirectService;
    }

    public function index(Request $request): View
    {
        return view('pages.admin-seller.items.categories.index', [
            'itemCategories' => $this->itemCategoryService->search($request, new ItemCategory, ['name']),
        ]);
    }

    public function store(ItemCategoryRequest $request): RedirectResponse
    {
        $this->itemCategoryService->firstOrCreate($request->validated());

        Toaster::success('Item category created successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.items.categories.index'));
    }

    public function search(Request $request): View
    {
        $itemCategories = $this->itemCategoryService->search($request, new ItemCategory, ['name']);

        return view('pages.admin-seller.items.categories.table', [
            'itemCategories' => $itemCategories,
        ]);
    }
}
