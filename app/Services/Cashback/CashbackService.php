<?php


namespace App\Services\Cashback;


use App\Models\Cashback;
use App\Models\Order;
use App\Repositories\CashbackRepository;
use Illuminate\Http\Response;

class CashbackService
{
    private $cashbackRepository;

    public function __construct()
    {
        $this->cashbackRepository = app(CashbackRepository::class);
    }

    /**
     * Добавить Кэшбэк
     *
     * @param Order $order
     *
     * @return Cashback
     */
    public function storeCashback(Order $order): Cashback
    {
        return $this
            ->cashbackRepository
            ->store(
                $order->user_id,
                $order->id,
                $order->cost,
                Cashback::STATUS_WAIT_FOR_RECEIVE
            );
    }

    /**
     * Установить период выплат в кэшбэке
     *
     * @param Order $order
     * @param int   $period
     *
     * @return bool
     */
    public function setPayoutsPeriod(Order $order, int $period): bool
    {
        if (!$this->periodExist($period)) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, 'Не правильный период выплат');
        }

        return $this
            ->cashbackRepository
            ->setPayoutsPeriod(
                $order->id,
                $period
            );
    }

    /**
     * Статус "Идут выплаты"
     *
     * @param Order $order
     *
     * @return bool
     */
    public function setInProgressStatus(Order $order): bool
    {
        return $this
            ->cashbackRepository
            ->setPayoutsStatus(
                $order->id,
                Cashback::STATUS_PAYOUTS_IN_PROGRESS
            );
    }

    /**
     * Существует ли период
     *
     * @param int $period
     *
     * @return bool
     */
    private function periodExist(int $period): bool
    {
        $periods = [
            Cashback::PERIOD_EVERY_MONTH,
            Cashback::PERIOD_EVERY_3_MONTHS,
            Cashback::PERIOD_EVERY_6_MONTHS,
            Cashback::PERIOD_SINGLE,
        ];

        return in_array($period, $periods);
    }
}