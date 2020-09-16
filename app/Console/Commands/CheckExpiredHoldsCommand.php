<?php

namespace App\Console\Commands;

use App\Models\Cashback;
use App\Models\Order;
use App\Repositories\OrdersHoldsScheduleRepository;
use App\Services\Buyer\Order\OrderChangeStatusService;
use App\Services\Buyer\Order\OrdersHoldsScheduleService;
use App\Services\Buyer\Order\ProductReceivedService;
use Illuminate\Console\Command;

class CheckExpiredHoldsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'holds:finish-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Завершение заказов по истекшим холдам';

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
        //Получить холд
        $hold = app(OrdersHoldsScheduleRepository::class)->getSingleExpired();

        if ($hold) {
            //Статус заказа "Получен"
            app(OrderChangeStatusService::class)->changeStatus(
                $hold->order->id,
                $hold->order->user_id,
                Order::ORDER_STATUS_RECEIVED
            );

            //Начислить средства продавцам и партнерам
            app(ProductReceivedService::class)->productHasBeenReceived(
                $hold->order,
                Cashback::PERIOD_SINGLE, //Получить кэшбэк единоразово
                true                     //Холд истек
            );
        }

        return 0;
    }
}
