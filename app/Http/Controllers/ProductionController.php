<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductionRequest;
use App\Models\Production;
use App\Services\ItemCategoryService;
use App\Services\ProductCategoryService;
use App\Services\ProductionService;
use App\Services\ReturnRedirectService;
use App\Services\WeaverService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;

class ProductionController extends Controller
{
    protected $productionService;

    protected $returnRedirectService;

    protected $weaverService;

    protected $itemCategoryService;

    protected $productCategoryService;

    public function __construct(ProductionService $productionService, ReturnRedirectService $returnRedirectService, WeaverService $weaverService, ItemCategoryService $itemCategoryService, ProductCategoryService $productCategoryService)
    {
        $this->productionService = $productionService;
        $this->returnRedirectService = $returnRedirectService;
        $this->weaverService = $weaverService;
        $this->itemCategoryService = $itemCategoryService;
        $this->productCategoryService = $productCategoryService;
    }

    public function index(Request $request): View
    {
        return view('pages.admin.productions.index', [
            'productions' => $this->productionService->search($request, new Production, ['name', 'date', 'estimate', 'material', 'service', 'total', 'goods_price'], ['items', 'products']),
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.productions.create', [
            'weavers' => $this->weaverService->all(),
        ]);
    }

    public function store(ProductionRequest $request): RedirectResponse
    {
        $this->productionService->create($request->validated());

        Toaster::success('Productions created successfully!');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.productions.index'));
    }

    public function edit(Production $production): View
    {
        return view('pages.admin.productions.edit', [
            'production' => $production,
            'weavers' => $this->weaverService->all(),
        ]);
    }

    public function update(ProductionRequest $request, Production $production): RedirectResponse
    {
        // dd($request->validated());
        $this->productionService->update($request->validated(), $production);

        Toaster::success('Productions updated successfully!');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.productions.index'));
    }

    public function search(Request $request): View
    {
        return view('pages.admin.productions.table', [
            'productions' => $this->productionService->search($request, new Production, ['name', 'date', 'estimate', 'material', 'service', 'total', 'goods_price'], ['items', 'products']),
        ]);
    }

    public function show(Production $production): View
    {
        return view('pages.admin.productions.show', [
            'itemCategories' => $this->itemCategoryService->all(),
            'productCategories' => $this->productCategoryService->all(),
            'items' => $production->items()->paginate(10),
            'products' => $production->products()->paginate(10),
            'production' => $production,
        ]);
    }

    //response json

    public function allWeaverJson(): JsonResponse
    {
        return response()->json($this->weaverService->all());
    }
}
