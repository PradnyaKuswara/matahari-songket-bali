<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Services\CartService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function indexFront(Request $request): View
    {
        $this->cartService->updateCartStatusBaseOnStock($request->user());

        return view('pages.cart', [
            'products' => [],
        ]);
    }

    public function getCartByCustomer(Request $request): JsonResponse
    {
        $this->cartService->updateCartStatusBaseOnStock($request->user());

        $products = $this->cartService->getCartByCustomer($request->user());
        $view = view('pages.cart-data', compact('products'))->render();

        return response()->json([
            'status' => 'success',
            'html' => $view,
            'products' => $products,
        ], 200);
    }

    public function storeCartByCustomer(CartRequest $request): JsonResponse
    {
        $response = $this->cartService->storeCartByCustomer($request->validated(), $request->user());

        if ($response['status'] === 'error') {
            return response()->json($response, 400);
        }

        return response()->json($response, 200);
    }

    public function updateCartByCustomer(CartRequest $request): JsonResponse
    {
        $response = $this->cartService->updateCartByCustomer($request->validated(), $request->user());

        if ($response['status'] === 'error') {
            return response()->json($response, 400);
        }

        return response()->json($response, 200);
    }

    public function deleteCartByCustomer(CartRequest $request): JsonResponse
    {
        $response = $this->cartService->deleteCartByCustomer($request->validated(), $request->user());

        if ($response['status'] === 'error') {
            return response()->json($response, 400);
        }

        return response()->json($response, 200);
    }

    public function toggleCartByCustomer(CartRequest $request): JsonResponse
    {
        $response = $this->cartService->toggleCartByCustomer($request->validated(), $request->user());

        if ($response['status'] === 'error') {
            return response()->json($response, 400);
        }

        return response()->json($response, 200);
    }

    public function toggleCartByCustomerAll(Request $request): JsonResponse
    {
        $request->validate([
            'checkAll' => 'required|boolean',
        ]);

        $response = $this->cartService->toggleCartByCustomerAll($request->checkAll, $request->user());

        if ($response['status'] === 'error') {
            return response()->json($response, 400);
        }

        return response()->json($response, 200);
    }
}
