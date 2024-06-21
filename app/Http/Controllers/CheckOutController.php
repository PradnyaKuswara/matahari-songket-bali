<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOutRequest;
use App\Models\Order;
use App\Services\CartService;
use App\Services\CheckOutService;
use Illuminate\Contracts\View\View as View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;

class CheckOutController extends Controller
{
    protected $checkOutService;

    protected $cartService;

    public function __construct(CheckOutService $checkOutService, CartService $cartService)
    {
        $this->checkOutService = $checkOutService;
        $this->cartService = $cartService;
    }

    public function index(Request $request): View|RedirectResponse
    {
        $this->cartService->updateCartStatusBaseOnStock($request->user());
        $user = $this->cartService->getCartActiveByCustomer($request->user());

        if ($user->carts->count() == 0) {
            Toaster::error('Cart is empty or you not yet select product on cart');

            return redirect()->back();
        }

        return view('pages.checkout', [
            'user' => $this->checkOutService->getUserDetail($request),
        ]);
    }

    public function store(CheckOutRequest $request): RedirectResponse
    {
        if ($request->user()->addresses->where('is_active', 1)->count() == 0) {
            Toaster::error('Please add  your address first. Insert your detail account on dashboard');

            return redirect()->back();
        }

        $result = $this->checkOutService->createCheckout($request->validated(), $request);

        if ($result['status'] === 'error') {
            Toaster::error($result['message']);

            return redirect()->route('products.indexFront');
        }

        Toaster::success('Checkout Success');

        return redirect()->route('checkout.showPayment', $result['order']);
    }

    public function showPayment(Order $order): View
    {
        $this->authorize('customer-order', $order);

        return view('pages.payment', [
            'order' => $order,
        ]);
    }

    public function successView(): View
    {
        return view('pages.success-payment');
    }

    public function callBack(Request $request): JsonResponse
    {
        $message = $this->checkOutService->callBack($request);

        return response()->json(['message' => $message], 200);
    }

    public function checkStock(Request $request): JsonResponse
    {
        $status = $this->checkOutService->checkStock($request);

        if ($status) {
            return response()->json(['message' => 'Stock Available'], 200);
        }

        return response()->json(['message' => 'Stock Not Available'], 400);
    }
}
