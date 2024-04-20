<?php

namespace App\Http\Controllers;

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

class MailController extends Controller
{
    public function templatePdf()
    {
        $customer = new Party([
            'name' => 'John Doe',
            'custom_fields' => [
                'email' => 'test@example.com',
                'phone' => '08123456789',
                'address' => 'Jalan Matahari Lingkungan Kemoning Klod, Klungkung, Bali, Indonesia',
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

    public function sendInvoice()
    {
        try {
            $content = [
                'name' => 'John Doe',
                'invoice' => 'INV/2021/01',
                'amount' => 'Rp 1.000.000',
                'due_date' => '2021-12-31',
            ];

            $invoice = $this->templatePdf();

            $mail = new InvoiceMail($content);

            $mail->attach(storage_path('app/public/invoices/'.$invoice['filename'].'.pdf'), [
                'as' => $invoice['filename'].'.pdf',
                'mime' => 'application/pdf',
            ]);

            Mail::to('pradnyakuswara24@gmail.com')->send($mail);

            Storage::delete('invoices/'.$invoice['filename'].'.pdf');

            return response()->json([
                'message' => 'Email sent successfully',
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function sendThankPurchase()
    {
        try {
            $content = [
                'name' => 'John Doe',
                'invoice' => 'INV/2021/01',
                'amount' => 'Rp 1.000.000',
                'due_date' => '2021-12-31',
            ];

            $mail = new PurchaseMail($content);

            Mail::to('pradnyakuswara24@gmail.com')->send($mail);

            return response()->json([
                'message' => 'Email sent successfully',
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function sendShipped()
    {
        try {
            $content = [
                'name' => 'John Doe',
                'invoice' => 'INV/2021/01',
                'amount' => 'Rp 1.000.000',
                'due_date' => '2021-12-31',
            ];

            $mail = new ShippedMail($content);

            Mail::to('pradnyakuswara24@gmail.com')->send($mail);

            return response()->json([
                'message' => 'Email sent successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function sendReceived()
    {
        try {
            $content = [
                'name' => 'John Doe',
                'invoice' => 'INV/2021/01',
                'amount' => 'Rp 1.000.000',
                'due_date' => '2021-12-31',
            ];

            $mail = new ReceivedProductMail($content);
            Mail::to('pradnyakuswara24@gmail.com')->send($mail);

            return response()->json([
                'message' => 'Email sent successfully',
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
