<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Twilio\Rest\Client;

class WhatsappService
{
    public function sendWhatsAppMessage($order)
    {
        $twilioSid = config('twilio.twilio_sid');
        $twilioToken = config('twilio.twilio_auth_token');
        $twilioWhatsAppNumber = config('twilio.twilio_whatsapp_number');
        $recipientNumber = config('twilio.receiver_phone_number'); // Replace with the recipient's phone number in WhatsApp format (e.g., "whatsapp:+1234567890")
        //message to information shippinh to seller and direct link place order
        $message = 'Hello, you have a new order with order ID: ' . $order->generate_id . "\n\n";
        $message .= 'Please check your dashboard to process the order or click this link to view the order: ';
        $message .= route('seller.dashboard.shippings.show', $order->shipping) . "\n\n";
        $message .= 'Thank you!';

        $twilio = new Client($twilioSid, $twilioToken);

        try {
            $twilio->messages->create(
                $recipientNumber,
                [
                    'from' => $twilioWhatsAppNumber,
                    'body' => $message,
                ]
            );

            return $data = [
                'message' => 'WhatsApp message sent successfully!',
                'recipient_number' => $recipientNumber,
            ];
        } catch (\Exception $e) {
            return $data = [
                'message' => 'Failed to send WhatsApp message!',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function sendWhatsappMessage2($order)
    {
        $fonnteToken = config('fonnte.fonnte_token');
        $fonnteReceiverNumber = config('fonnte.fonnte_receiver_number');

        $message = 'Hello, you have a new order with order ID: ' . $order->generate_id . "\n\n";
        $message .= 'Please check your dashboard to process the order or click this link to view the order: ';
        $message .= route('seller.dashboard.shippings.show', $order->shipping) . "\n\n";
        $message .= 'Thank you!';

        try {
            $response = Http::withHeaders([
                'Authorization' => $fonnteToken // ganti TOKEN dengan token sebenarnya
            ])->post('https://api.fonnte.com/send', [
                'target' => $fonnteReceiverNumber,
                'message' => $message,
                'countryCode' => '62' // optional
            ]);

            return $data = [
                'message' => 'WhatsApp message sent successfully!',
                'response' => $response->json(),
            ];
        } catch (\Exception $e) {
            return $data = [
                'message' => 'Failed to send WhatsApp message!',
                'error' => $e->getMessage(),
            ];
        }
    }
}
