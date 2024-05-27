<?php

namespace App\Console\Commands;

use App\Models\Shipping;
use App\Services\MailService;
use Illuminate\Console\Command;

class ConfirmShipped extends Command
{
    protected $mailService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:confirm-shipped';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(MailService $mailService)
    {
        parent::__construct();
        $this->mailService = $mailService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $shippings = Shipping::where('status', 'shipping')->get();

        foreach ($shippings as $shipping) {
            if ($shipping->delivered_at < now() && $shipping->max_confirm >= now()) {
                $this->mailService->sendReceived($shipping);
            }
            if ($shipping->max_confirm < now()) {
                $shipping->update(['status' => 'delivered']);
            }
        }

        return 0;
    }
}
