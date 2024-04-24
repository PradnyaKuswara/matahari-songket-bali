<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemCategoryRequest;
use App\Models\ItemCategory;
use App\Services\ItemCategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Masmerise\Toaster\Toaster;

class ItemCategoryController extends Controller
{
    protected $itemCategoryService;

    public function __construct(ItemCategoryService $itemCategoryService)
    {
        $this->itemCategoryService = $itemCategoryService;
    }

    public function index(Request $request): View
    {
        $itemCategories = $this->itemCategoryService->search($request, new ItemCategory, ['name']);

        return view('pages.admin.items.categories.index', [
            'itemCategories' => $itemCategories,
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.items.categories.create');
    }

    public function store(ItemCategoryRequest $request): RedirectResponse
    {
        $this->itemCategoryService->create($request->validated());

        Toaster::success('Item category created successfully');

        return redirect()->route('admin.dashboard.items.categories.index');
    }

    public function edit(ItemCategory $itemCategory): View
    {
        return view('pages.admin.items.categories.edit', [
            'itemCategory' => $this->itemCategoryService->find($itemCategory),
        ]);
    }

    public function update(ItemCategoryRequest $request, ItemCategory $itemCategory): RedirectResponse
    {
        $this->itemCategoryService->update($request->validated(), $itemCategory);

        Toaster::success('Item category updated successfully');

        return redirect()->route('admin.dashboard.items.categories.index');
    }

    public function destroy(ItemCategory $itemCategory): RedirectResponse
    {
        $this->itemCategoryService->delete($itemCategory);

        Toaster::success('Item category deleted successfully');

        return redirect()->route('admin.dashboard.items.categories.index');
    }

    public function search(Request $request): View
    {
        $itemCategories = $this->itemCategoryService->search($request, new ItemCategory, ['name']);

        return view('pages.admin.items.categories.table', [
            'itemCategories' => $itemCategories,
        ]);
    }
}
