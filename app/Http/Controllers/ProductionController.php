<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductionRequest;
use App\Models\Production;
use App\Services\ProductionService;
use App\Services\ReturnRedirectService;
use App\Services\WeaverService;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    protected $productionService;

    protected $returnRedirectService;

    protected $weaverService;

    public function __construct(ProductionService $productionService, ReturnRedirectService $returnRedirectService, WeaverService $weaverService)
    {
        $this->productionService = $productionService;
        $this->returnRedirectService = $returnRedirectService;
        $this->weaverService = $weaverService;
    }

    public function index(Request $request)
    {
        return view('pages.admin-seller.productions.index', [
            'productions' => $this->productionService->search($request, new Production, ['name', 'date', 'estimate', 'material', 'service', 'total', 'goods_price'], ['items', 'products']),
        ]);
    }

    public function create()
    {
        return view('pages.admin-seller.productions.create', [
            'weavers' => $this->weaverService->all(),
        ]);
    }

    public function store(ProductionRequest $request)
    {

        // dd($request->validated());

        $this->productionService->create($request->validated());

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.productions.index'));
    }

    public function edit(Production $production)
    {
        return view('pages.admin-seller.productions.edit', [
            'production' => $production,
            'weavers' => $this->weaverService->all(),
        ]);
    }

    public function update(ProductionRequest $request, Production $production)
    {

        // dd($request->validated());
        $this->productionService->update($request->validated(), $production);

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.productions.index'));
    }

    public function search(Request $request)
    {
        return view('pages.admin-seller.productions.table', [
            'productions' => $this->productionService->search($request, new Production, ['name', 'date', 'estimate', 'material', 'service', 'total', 'goods_price'], ['items', 'products']),
        ]);
    }

    //response json

    public function allWeaverJson()
    {
        return response()->json($this->weaverService->all());
    }
}
