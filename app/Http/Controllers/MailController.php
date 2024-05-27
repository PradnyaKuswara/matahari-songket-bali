<?php

namespace App\Http\Controllers;

use App\Services\WhatsappService;

class MailController extends Controller
{
    protected $whatsappService;

    public function __construct(WhatsappService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function sendWhatsAppMessage()
    {

        $order = null;
        $response = $this->whatsappService->sendWhatsAppMessage($order);

        return response()->json($response);
    }
}
