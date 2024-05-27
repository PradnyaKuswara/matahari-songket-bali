<?php

namespace App\Http\Controllers;

use App\Mail\ReceivedProductMail;
use App\Mail\ShippedMail;
use Exception;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
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
