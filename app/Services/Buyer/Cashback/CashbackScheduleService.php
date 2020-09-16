<?php


namespace App\Services\Buyer\Cashback;


use App\Models\Cashback;
use App\Models\CashbackSchedule;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\CashbackScheduleRepository;
use App\Repositories\PaymentsScheduleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Class CashbackScheduleService
 *
 * @package App\Services\Buyer\Cashback
 * @author  Anton Reviakin
 */
class CashbackScheduleService
{
    private $cashbackScheduleRepository;

    public function __construct()
    {
        $this->cashbackScheduleRepository = app(CashbackScheduleRepository::class);
    }

    /**
     * Заполнить таблицу расписанием выплат
     *
     * @param Order $order
     * @param int   $period
     */
    public function fill(Order $order, int $period)
    {
        //Товары в заказе
        /** @var Collection $productsInOrder */
        $productsInOrder = $order->items;

        //Id кэшбэка
        $cashbackId = $order->cashback->id;

        $productsInOrder->each(function (OrderItem $orderItem) use ($cashbackId, $period) {
            $payouts = $this->calcPayoutPeriods($orderItem, $period);

            $schedules = [];

            foreach ($payouts as $payout) {
                $schedules[] = [
                    'cashback_id'   => $cashbackId,
                    'order_item_id' => $orderItem->id,
                    'payout_amount' => $payout['amount'],
                    'payout_at'     => $payout['date'],
                ];
            }

            $this
                ->cashbackScheduleRepository
                ->fill($schedules);
        });
    }

    /**
     * Начислить кэшбэк по периодам выплат (Command)
     */
    public function addPeriodicBalance(): void
    {
        //Получить список для начисления кэшбэка
        $payouts = $this
            ->cashbackScheduleRepository
            ->getSchedulesForPayout();

        if ($payouts->isEmpty()) {
            return;
        }

        $UserRepository = app(UserRepository::class);

        $payouts->each(function (CashbackSchedule $payout) use ($UserRepository) {
            //Добавить на баланс кэшбэка пользователю
            $UserRepository->addToCashbackAccount(
                $payout->cashback->user_id,
                $payout->payout_amount
            );

            $this
                ->cashbackScheduleRepository
                ->setAsCompletePayout($payout->id);
        });
    }

    /**
     * Расчитать даты и суммы выплат
     *
     * @param OrderItem $orderItem
     * @param int       $period
     *
     * @return array
     */
    private function calcPayoutPeriods(OrderItem $orderItem, int $period): array
    {
        $periods = $this->getPayoutPeriod($orderItem, $period);

        $payouts = [];

        //Полные периоды
        $integer = intdiv($periods['divident'], $periods['divisor']);

        //Остаточные месяцы
        $remains = $periods['divident'] % $periods['divisor'];

        //Сумма выплат в месяц
        $amountPerMonth = round($orderItem->price / $periods['divident'], 2);

        //Проход по количеству полных периодов
        for ($i = 1; $i <= $integer; $i++) {
            $payouts[] = [
                'amount' => round($amountPerMonth * $periods['divisor'], 2),
                'date'   => Carbon::now()->addMonths($periods['divisor'] * $i),
            ];
        }

        //Если есть остаточные месяцы
        if ($remains > 0) {
            $payouts[] = [
                'amount' => round($amountPerMonth * $remains, 2),
                'date'   => Carbon::now()->addMonths($periods['divident']),
            ];
        }

        return $payouts;
    }

    /**
     * Получить период выплат по размеру комиссии и выбранной периодичности выплат
     *
     * @param OrderItem $orderItem
     * @param int       $period
     *
     * @return array
     */
    private function getPayoutPeriod(OrderItem $orderItem, int $period): array
    {
        //Периоды выплат по размеру комиссии
        $periods = app(PaymentsScheduleRepository::class)->getPeriodsByPercentFee($orderItem->product_percent_fee);

        if (!$periods) {
            abort(Response::HTTP_NOT_FOUND, 'Не найдены периоды выплат кэшбэка с заданным процентом комиссии товара/услуги');
        }

        switch ($period) {
            case Cashback::PERIOD_EVERY_MONTH:
            {
                return [
                    'divident' => $periods->quantity_pay_every_month,
                    'divisor'  => 1,
                ];
            }
            case Cashback::PERIOD_EVERY_3_MONTHS:
            {
                return [
                    'divident' => $periods->quantity_pay_each_quarter,
                    'divisor'  => 3,
                ];
            }
            case Cashback::PERIOD_EVERY_6_MONTHS:
            {
                return [
                    'divident' => $periods->quantity_pay_every_six_months,
                    'divisor'  => 6,
                ];
            }
            case Cashback::PERIOD_SINGLE:
            {
                return [
                    'divident' => $periods->quantity_pay_single,
                    'divisor'  => $periods->quantity_pay_single,
                ];
            }
        }
    }
}