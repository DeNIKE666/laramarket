<?php

namespace App\Console\Commands;

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
    protected $description = 'Выплата кешбека';

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
        return 0;
    }
}
