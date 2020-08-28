<?php


namespace App\Services\Cashback;


use App\Models\Cashback;
use App\Models\Order;
use App\Repositories\CashbackRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CashbackService
{
    private $cashbackRepository;

    public function __construct()
    {
        $this->cashbackRepository = app(CashbackRepository::class);
    }

    /**
     * Добавить Кешбек
     *
     * @param Order $order
     *
     * @return Cashback
     */
    public function storeCashback(Order $order): Cashback
    {
        return $this->cashbackRepository->store(
            $order->id,
            $order->cost,
            Cashback::STATUS_WAIT_FOR_RECEIVE
        );
    }

    /**
     * Установить период выплат в кешбеке
     *
     * @param Request $request
     * @param Order   $order
     *
     * @return bool
     */
    public function setPayoutsPeriod(Order $order): bool
    {
        if (!$this->periodExist()) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, 'Не правильный период выплат');
        }

        return $this->cashbackRepository->setPayoutsPeriod(
            $order->id,
            request('period')
        );
    }

    /**
     * Существует ли период
     *
     * @return bool
     */
    private function periodExist(): bool
    {
        $periods = [
            Cashback::PERIOD_EVERY_MONTH,
            Cashback::PERIOD_EVERY_3_MONTHS,
            Cashback::PERIOD_EVERY_6_MONTHS,
            Cashback::PERIOD_SINGLE,
        ];

        return in_array(request('period'), $periods);
    }
}