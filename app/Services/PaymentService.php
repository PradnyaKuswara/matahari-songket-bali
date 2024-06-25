<?php

namespace App\Services;

use App\Models\Order;

class PaymentService
{
    protected $shippingService;

    protected $mailService;

    protected $whatsappService;

    public function __construct(ShippingService $shippingService, MailService $mailService, WhatsappService $whatsappService)
    {
        \Midtrans\Config::$serverKey = config('midtrans.server-key');
        \Midtrans\Config::$isProduction = config('midtrans.is-production');
        \Midtrans\Config::$isSanitized = config('midtrans.is-sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');

        $this->shippingService = $shippingService;
        $this->mailService = $mailService;
        $this->whatsappService = $whatsappService;
    }

    public function paymentCharge(object $order)
    {
        try {
            $params = $this->paymentDetail($order);

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return $snapToken;
        } catch (\Throwable $th) {
            dd('error');
        }
    }

    public function paymentDetail(object $order)
    {
        $transaction_details = [
            'order_id' => $order->generate_id,
            'gross_amount' => $order->total_price,
        ];

        $customer_details = [
            'first_name' => $order->user->name,
            'email' => $order->user->email,
        ];

        $data = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        ];

        return $data;
    }

    public function callBack($request)
    {
        try {
            $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.config('midtrans.server-key'));
            $order = Order::where('generate_id', $request->order_id)->first();

            if ($hashed == $request->signature_key) {
                if ($request->transaction_status == 'capture') {

                    $order->update([
                        'status' => true,
                    ]);
                    $order->transaction->update([
                        'status' => 'capture',
                    ]);
                }

                if ($request->transaction_status == 'settlement') {
                    $order->update([
                        'status' => true,
                    ]);
                    $order->transaction->update([
                        'type' => $request->payment_type,
                        'money' => $request->gross_amount,
                        'status' => 'settlement',
                    ]);
                    $order->shipping->update([
                        'status' => 'packing',
                    ]);

                    $this->mailService->sendThankPurchase($order);
                    $this->whatsappService->sendWhatsAppMessage2($order);
                }

                if ($request->transaction_status == 'cancel') {
                    $order->update([
                        'status' => false,
                    ]);
                    $order->transaction->update([
                        'status' => 'cancel',
                    ]);
                    $order->shipping->update([
                        'status' => 'cancel',
                    ]);

                    foreach ($order->products as $product) {
                        $quantity = $product->pivot->quantity ?? 0;
                        $product->update([
                            'stock' => $product->stock + $quantity,
                        ]);
                    }
                }

                if ($request->transaction_status == 'deny') {
                    $order->update([
                        'status' => false,
                    ]);
                    $order->transaction->update([
                        'status' => 'deny',
                    ]);
                    $order->shipping->update([
                        'status' => 'cancel',
                    ]);
                    foreach ($order->products as $product) {
                        $quantity = $product->pivot->quantity ?? 0;
                        $product->update([
                            'stock' => $product->stock + $quantity,
                        ]);
                    }
                }

                if ($request->transaction_status == 'expire') {
                    $order->update([
                        'status' => false,
                    ]);
                    $order->transaction->update([
                        'status' => 'expired',
                    ]);
                    $order->shipping->update([
                        'status' => 'cancel',
                    ]);
                    foreach ($order->products as $product) {
                        $quantity = $product->pivot->quantity ?? 0;
                        $product->update([
                            'stock' => $product->stock + $quantity,
                        ]);
                    }
                }

                if ($request->transaction_status == 'pending') {
                    $order->update([
                        'status' => false,
                    ]);
                    $order->transaction->update([
                        'status' => 'pending',
                    ]);
                    $order->shipping->update([
                        'status' => 'pending',
                    ]);
                }

                return $message = 'success';
            } else {
                return $message = 'failed';
            }
        } catch (\Throwable $th) {
            return $message = $th->getMessage();
        }
    }

    public function resetPreparePayment($orders)
    {
        foreach ($orders as $order) {
            try {
                \Midtrans\Transaction::status($order->generate_id);
            } catch (\Throwable $th) {
                if ($order->transaction->expired_at < now()) {
                    $order->update([
                        'status' => false,
                    ]);
                    $order->transaction->update([
                        'status' => 'expired',
                    ]);
                    $order->shipping->update([
                        'status' => 'cancel',
                    ]);

                    foreach ($order->products as $product) {
                        $quantity = $product->pivot->quantity ?? 0;
                        $product->update([
                            'stock' => $product->stock + $quantity,
                        ]);
                    }
                }
            }
        }

        return $orders;
    }
}