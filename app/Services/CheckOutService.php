<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class CheckOutService
{
    protected $orderService;

    protected $transactionService;

    protected $paymentService;

    protected $addressService;

    protected $cartService;

    protected $productService;

    protected $mailService;

    public function __construct(
        OrderService $orderService,
        TransactionService $transactionService,
        PaymentService $paymentService,
        AddressService $addressService,
        CartService $cartService,
        ProductService $productService,
        MailService $mailService
    ) {
        $this->orderService = $orderService;
        $this->transactionService = $transactionService;
        $this->paymentService = $paymentService;
        $this->addressService = $addressService;
        $this->cartService = $cartService;
        $this->productService = $productService;
        $this->mailService = $mailService;
    }

    public function getUserDetail($request)
    {
        $user = $this->addressService->addressCheckOut($request->user());
        $user = $this->cartService->getCartActiveByCustomer($user);

        $this->cartService->updateCartStatusBaseOnStock($request->user());

        return $user;
    }

    public function createOrder(array $data)
    {
        return $this->orderService->create($data);
    }

    public function createAttachedProduct(array $data, $order)
    {
        return $this->orderService->createAttachedProduct($data, $order);
    }

    public function createTransaction(array $data, $order)
    {
        return $this->transactionService->create($data, $order);
    }

    public function createCheckout(array $data, $request)
    {
        DB::beginTransaction();

        try {
            $user = $this->cartService->getCartActiveByCustomer($request->user());
            $order = $this->createOrder($data);
            $product = [];

            foreach ($user->carts as $cart) {
                $product[] = [
                    'product_id' => $cart->id,
                    'quantity' => $cart->pivot->quantity,
                    'price' => $cart->sell_price,
                    'total_price' => $cart->pivot->quantity * $cart->sell_price,
                ];
            }

            foreach ($product as $value) {
                $this->createAttachedProduct($value, $order);
            }

            $snapToken = $this->paymentService->paymentCharge($order);
            $expired_at = now()->addHours(24);

            $transaction = [
                'user_id' => $user->id,
                'order_id' => $order->id,
                'item_total_price' => $order->item_total_price,
                'shipping_price' => $order->shipping_price,
                'tax' => $order->tax,
                'total_price' => $order->total_price,
                'snap_token' => $snapToken,
                'expired_at' => $expired_at,
            ];

            $this->createTransaction($transaction, $order);
            $this->mailService->sendInvoice($order);

            DB::commit();

            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function callBack($request)
    {
        return $this->paymentService->callBack($request);
    }

    public function resetPreparePayment()
    {
        $orders = $this->orderService->getAll()->whereHas('transaction', function ($query) {
            $query->where('status', 'pending');
        })->get();

        return $this->paymentService->resetPreparePayment($orders);
    }

    public function checkStock($request)
    {
        $order = $this->orderService->find($request->order_id);

        return $this->orderService->checkStock($order);
    }
}
