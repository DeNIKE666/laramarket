<?php

namespace App\Console\Commands;

use App\Services\Buyer\Cashback\CashbackScheduleService;
use Illuminate\Console\Command;

class CashbackPayoutsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cashback:payout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Начислить кэшбэк пользователям';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        app(CashbackScheduleService::class)->addPeriodicBalance();

        return 0;
    }
}
