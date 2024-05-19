<?php

namespace App\Services;

use App\Mail\InvoiceMail;
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
            'name' => $order->user->name,
            'custom_fields' => [
                'email' => $order->user->email,
                'phone' => $order->user->phone,
                'address' => $order->address->address.', '.$order->address->city.', '.$order->address->province.', '.$order->address->postal_code.', '.$order->address->country,
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

        $item = InvoiceItem::make('Service 1')->description('Your product or service description')->pricePerUnit(800000)->quantity(2)->units('item');

        $notes = [
            'your multiline',
            'additional notes',
            'in regards of delivery or something else',
        ];
        $notes = implode('<br>', $notes);

        $filename = 'invoice-unpaid';

        $invoice = Invoice::make()
            ->buyer($customer)
            ->seller($seller)
            ->discountByPercent(10)
            ->taxRate(15)
            ->shipping(20000)
            ->status('unpaid')
            ->name('Invoice # ')
            ->serialNumberFormat('240511001')
            ->addItem($item)
            ->notes($notes)
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
            $invoice = $this->templatePdf($order);

            $content = $order;

            $mail = new InvoiceMail($content);

            $mail->attach(storage_path('app/public/invoices/'.$invoice['filename'].'.pdf'), [
                'as' => $invoice['filename'].'.pdf',
                'mime' => 'application/pdf',
            ]);

            Mail::to('pradnyakuswara24@gmail.com')->send($mail);

            Storage::delete('invoices/'.$invoice['filename'].'.pdf');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
