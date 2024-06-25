<?php

namespace App\Services;

use App\Mail\FaqMail;
use App\Mail\InvoiceMail;
use App\Mail\PurchaseMail;
use App\Mail\ReceivedProductMail;
use App\Mail\ShippedMail;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Facades\Invoice;

class MailService
{
    public function templatePdf($order)
    {
        $customer = new Party([
            'name' => $order->shipping->user->name,
            'custom_fields' => [
                'email' => $order->shipping->user->email,
                'phone' => $order->shipping->user->phone_number,
                'address' => $order->shipping->address.', '.$order->shipping->city.', '.$order->shipping->province.', '.$order->shipping->postal_code.', '.$order->shipping->country,
            ],
        ]);

        $seller = new Party([
            'name' => 'Matahari Songket Bali',
            'custom_fields' => [
                'email' => 'mataharisongketbali@gmail.com',
                'phone' => '08123456789',
                'address' => 'Jalan Matahari Lingkungan Kemoning Klod, Klungkung, Bali, Indonesia',
            ],
        ]);

        $items = [];

        foreach ($order->products as $product) {
            $items[] = InvoiceItem::make($product->name)->quantity($product->pivot->quantity)->pricePerUnit($product->pivot->price);
        }

        $filename = $order->transaction->generate_id;

        $invoice = Invoice::make()
            ->buyer($customer)
            ->seller($seller)
            ->taxRate(5)
            ->shipping($order->transaction->shipping_price)
            ->status('unpaid')
            ->name('Invoice #')
            ->serialNumberFormat($order->transaction->generate_id)
            ->addItems($items)
            ->template('invoice')
            ->logo(public_path('assets/images/logo.png'))
            ->filename('invoices/'.$filename)
            ->save('public');

        return [
            'invoice' => $invoice,
            'filename' => $filename,
        ];
    }

    public function sendInvoice($order)
    {
        try {
            // $invoice = $this->templatePdf($order);

            $content = $order;

            $mail = new InvoiceMail($content);

            // $mail->attach(storage_path('app/public/invoices/'.$invoice['filename'].'.pdf'), [
            //     'as' => $invoice['filename'].'.pdf',
            //     'mime' => 'application/pdf',
            // ]);

            Mail::to($order->user->email)->send($mail);

            // Storage::delete('invoices/'.$invoice['filename'].'.pdf');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function sendThankPurchase($order)
    {
        try {
            $content = $order;

            $mail = new PurchaseMail($content);

            Mail::to($order->user->email)->send($mail);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function sendShipped($shipping)
    {
        try {
            $content = $shipping;

            $mail = new ShippedMail($content);

            Mail::to($shipping->user->email)->send($mail);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function sendReceived($shipping)
    {
        try {
            $content = $shipping;

            $mail = new ReceivedProductMail($content);
            Mail::to($shipping->user->email)->send($mail);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function faq($content)
    {
        try {
            $mail = new FaqMail($content);
            Mail::to(config('mail.from.address'))->send($mail);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
