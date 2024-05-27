<?php

namespace App\Services;

use Twilio\Rest\Client;

class WhatsappService
{
    public function sendWhatsAppMessage($order)
    {
        $twilioSid = config('twilio.twilio_sid');
        $twilioToken = config('twilio.twilio_auth_token');
        $twilioWhatsAppNumber = config('twilio.twilio_whatsapp_number');
        $recipientNumber = config('twilio.receiver_phone_number'); // Replace with the recipient's phone number in WhatsApp format (e.g., "whatsapp:+1234567890")
        $message = 'Hi, this is a test message from Twilio WhatsApp API.';

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
}
