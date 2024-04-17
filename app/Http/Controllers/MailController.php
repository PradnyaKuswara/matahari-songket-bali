<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceUnpaidMail;
use Exception;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendUnpaidInvoice()
    {
        try {
            $content = [
                'name' => 'John Doe',
                'invoice' => 'INV/2021/01',
                'amount' => 'Rp 1.000.000',
                'due_date' => '2021-12-31',
            ];

            $mail = new InvoiceUnpaidMail($content);
            Mail::to('mataharisongketbali@gmail.com')->send($mail);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
