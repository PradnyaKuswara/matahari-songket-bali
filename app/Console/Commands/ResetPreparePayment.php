<?php

namespace App\Console\Commands;

use App\Services\CheckOutService;
use Illuminate\Console\Command;

class ResetPreparePayment extends Command
{
    protected $checkOutService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:reset-prepare-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function __construct(CheckOutService $checkOutService)
    {
        parent::__construct();
        $this->checkOutService = $checkOutService;
    }

    public function handle()
    {
        $this->checkOutService->resetPreparePayment();

        return 0;
    }
}
