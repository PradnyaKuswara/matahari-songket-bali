<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Visitor;
use App\Services\ProductCategoryService;
use App\Services\ProductService;
use App\Services\ReturnRedirectService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;

class ProductController extends Controller
{
    protected $productService;

    protected $productCategoryService;

    protected $returnRedirectService;

    public function __construct(ProductService $productService, ProductCategoryService $productCategoryService, ReturnRedirectService $returnRedirectService)
    {
        $this->productService = $productService;
        $this->productCategoryService = $productCategoryService;
        $this->returnRedirectService = $returnRedirectService;
    }

    public function index(Request $request): View
    {
        return view('pages.admin-seller.products.index', [
            'products' => $this->productService->search($request, new Product, ['name', 'stock', 'goods_price', 'sell_price', 'description', 'type'], ['productCategory']),
            'productCategories' => $this->productCategoryService->all(),
        ]);
    }

    public function show(): View
    {
        return view('pages.admin-seller.products.show', [
            'products' => $this->productService->all()->orderByRaw('stock > 0 desc, created_at desc')->paginate(9),
        ]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        // dd($request->validated());
        $this->productService->create($request->validated());

        Toaster::success('Product created successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.products.index'));
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $this->productService->update($request, $request->validated(), $product);

        Toaster::success('Product updated successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.products.index'));
    }

    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $this->productService->delete($product);

        Toaster::success('Product deleted successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.products.index'));
    }

    public function search(Request $request): View
    {
        return view('pages.admin-seller.products.table', [
            'products' => $this->productService->search($request, new Product, ['name', 'stock', 'goods_price', 'sell_price', 'description', 'type'], ['productCategory']),
            'productCategories' => $this->productCategoryService->all(),
        ]);
    }

    public function toggleActive(Request $request, Product $product): RedirectResponse
    {
        $this->productService->toogleActive($product);

        Toaster::success('Product update status successfully');

        return redirect()->route($this->returnRedirectService->routeString($request, 'dashboard.products.index'));
    }

    public function indexFront(Request $request)
    {
        $products =
            $this->productService->searchFront($request, new Product, ['name', 'sell_price'], ['productCategory']);

        if ($request->ajax()) {
            $view = view('pages.product-data', compact('products'))->render();

            return response()->json(['html' => $view]);
        }

        return view('pages.product', [
            'products' => $products,
        ]);
    }

    public function detailFront(Product $product): View
    {
        visits(Visitor::TYPE_PRODUCT, $product)->increment();

        return view('pages.product-detail', [
            'product' => $product,
            'products' => $this->productService->all()->where('slug', '!=', $product->slug)
                ->where('stock', '>', 0)
                ->inRandomOrder()
                ->take(4)
                ->get(),
        ]);
    }

    public function categoriesOldest(Request $request): JsonResponse
    {
        $products = $this->productService->all()->orderByRaw('stock > 0 desc, created_at asc')->paginate(9);

        $view = view('pages.product-data', compact('products'))->render();

        return response()->json(['html' => $view]);
    }

    public function categoriesPopular(Request $request): JsonResponse
    {
        $products = Product::leftJoin(
            'visitor_metas',
            'products.id',
            '=',
            'visitor_metas.identity'
        )
            ->leftJoin('visitors', 'visitors.id', '=', 'visitor_metas.visitor_id')
            ->select('products.*')
            ->selectRaw('COUNT(CASE WHEN visitors.type = "product" THEN visitor_metas.identity ELSE NULL END) AS total')
            ->where('products.is_active', true)
            ->groupBy('products.id')
            ->orderByRaw('IF(products.stock > 0, 1, 2)') // Order by stock availability
            ->orderByDesc('total') // Then order by total visitors
            ->paginate(9);

        $view = view('pages.product-data', compact('products'))->render();

        return response()->json(['html' => $view]);
    }

    public function categoriesCheapest(Request $request): JsonResponse
    {
        $products = $this->productService->all()->orderByRaw('stock > 0 desc, sell_price asc')->paginate(9);

        $view = view('pages.product-data', compact('products'))->render();

        return response()->json(['html' => $view]);
    }

    public function categoriesExpensive(Request $request): JsonResponse
    {
        $products = $this->productService->all()->orderByRaw('stock > 0 desc, sell_price desc')->paginate(9);

        $view = view('pages.product-data', compact('products'))->render();

        return response()->json(['html' => $view]);
    }

    public function searchFront(Request $request): View
    {
        $model = Product::where('is_active', true);
        $products = $this->productService->searchFront($request, $model, ['name', 'sell_price'], ['productCategory']);

        return view('pages.product-data', compact('products'));
    }
}
