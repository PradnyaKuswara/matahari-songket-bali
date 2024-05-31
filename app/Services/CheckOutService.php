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

    protected $shippingService;

    public function __construct(
        OrderService $orderService,
        TransactionService $transactionService,
        PaymentService $paymentService,
        AddressService $addressService,
        CartService $cartService,
        ProductService $productService,
        MailService $mailService,
        ShippingService $shippingService
    ) {
        $this->orderService = $orderService;
        $this->transactionService = $transactionService;
        $this->paymentService = $paymentService;
        $this->addressService = $addressService;
        $this->cartService = $cartService;
        $this->productService = $productService;
        $this->mailService = $mailService;
        $this->shippingService = $shippingService;
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

    public function createShipping(array $data, $order)
    {
        return $this->shippingService->create($data, $order);
    }

    public function createCheckout(array $data, $request)
    {
        DB::beginTransaction();

        try {
            $user = $this->cartService->getCartActiveByCustomer($request->user());
            $order = $this->createOrder($data);
            $product = [];

            foreach ($user->carts as $cart) {
                if ($cart->pivot->quantity > $cart->stock) {
                    DB::rollBack();

                    return $result = [
                        'status' => 'error',
                        'message' => 'This product stock is unavaliable',
                        'order' => null,
                    ];
                }
                $product[] = [
                    'product_id' => $cart->id,
                    'quantity' => $cart->pivot->quantity,
                    'price' => $cart->sell_price,
                    'total_price' => $cart->pivot->quantity * $cart->sell_price,
                ];

                //detach cart
                $user->carts()->detach($cart->id);
            }

            foreach ($product as $value) {
                $this->createAttachedProduct($value, $order);
            }

            foreach ($order->products as $product) {
                $quantity = $product->pivot->quantity ?? 0;
                $product->update([
                    'stock' => $product->stock - $quantity,
                ]);
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

            $dataShipping = [
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'name' => 'Shipping '.$order->generate_id,
                'address' => $user->addresses->first()->address,
                'city' => $user->addresses->first()->city,
                'province' => $user->addresses->first()->province,
                'country' => $user->addresses->first()->country,
                'postal_code' => $user->addresses->first()->postal_code,
                'additional_information' => $user->addresses->first()->additional_information,
                'phone_number' => $user->phone_number,
                'status' => 'pending',
            ];

            $this->createShipping($dataShipping, $order);
            $this->mailService->sendInvoice($order);
            $this->mailService->sendThankPurchase($order);

            DB::commit();

            return $result = [
                'status' => 'success',
                'message' => 'Checkout succesfully',
                'order' => $order,
            ];
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
