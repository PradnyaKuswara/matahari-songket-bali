<?php

namespace App\Http\Controllers;

use App\Services\WhatsappService;
use Illuminate\Http\JsonResponse;

class MailController extends Controller
{
    protected $whatsappService;

    public function __construct(WhatsappService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function sendWhatsAppMessage(): JsonResponse
    {

        $order = null;
        $response = $this->whatsappService->sendWhatsAppMessage($order);

        return response()->json($response);
    }
}
