<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Services\ItemCategoryService;
use App\Services\ItemService;
use App\Services\ReturnRedirectService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Masmerise\Toaster\Toaster;

class ItemController extends Controller
{
    protected $itemService;

    protected $itemCategoryService;

    protected $returnRedirectService;

    public function __construct(ItemService $itemService, ItemCategoryService $itemCategoryService, ReturnRedirectService $returnRedirectService)
    {
        $this->itemService = $itemService;
        $this->itemCategoryService = $itemCategoryService;
        $this->returnRedirectService = $returnRedirectService;
    }

    public function index(Request $request): View
    {
        return view('pages.admin-seller.items.index', [
            'items' => $this->itemService->search($request, new Item, ['name', 'price'], ['itemCategory']),
            'itemCategories' => $this->itemCategoryService->all(),
        ]);
    }

    public function store(ItemRequest $request): RedirectResponse
    {
        $this->itemService->firstOrCreate($request->validated());

        Toaster::success('Item created successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.items.index'));
    }

    public function update(ItemRequest $request, Item $item): RedirectResponse
    {
        $this->itemService->update($request->validated(), $item);

        Toaster::success('Item updated successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.items.index'));
    }

    public function destroy(Request $request, Item $item): RedirectResponse
    {
        $this->itemService->delete($item);

        Toaster::success('Item deleted successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.items.index'));
    }

    public function search(Request $request): View
    {
        return view('pages.admin-seller.items.table', [
            'items' => $this->itemService->search($request, new Item, ['name', 'price'], ['itemCategory']),
            'itemCategories' => $this->itemCategoryService->all(),
        ]);
    }
}
