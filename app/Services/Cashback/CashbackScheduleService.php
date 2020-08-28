<?php


namespace App\Services\Cashback;


use App\Models\Cashback;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\CashbackScheduleRepository;
use App\Repositories\PaymentsScheduleRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Class CashbackScheduleService
 *
 * @package App\Services\Cashback
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
     * Заполнить таблицу заданиями выплат для заказа
     *
     * @param Request $request
     * @param Order   $order
     */
    public function fill(Order $order)
    {
        //Товары в заказе
        /** @var Collection $productsInOrder */
        $productsInOrder = $order->items;

        //Id кешбека
        $cashbackId = $order->cashback->id;

        $productsInOrder->each(function (OrderItem $orderItem) use ($cashbackId) {
            $payouts = $this->calcPayoutPeriods($orderItem);

            $schedules = [];

            foreach ($payouts as $payout) {
                $schedules[] = [
                    'cashback_id'   => $cashbackId,
                    'order_item_id' => $orderItem->id,
                    'payout_amount' => $payout['amount'],
                    'payout_at'     => $payout['date'],
                ];
            }

            $this->cashbackScheduleRepository->fill($schedules);
        });
    }

    /**
     * Расчитать даты и суммы выплат
     *
     * @param Request   $request
     * @param OrderItem $orderItem
     *
     * @return array
     */
    private function calcPayoutPeriods(OrderItem $orderItem): array
    {
        $periods = $this->getPayoutPeriod($orderItem);

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
     *
     * @return array
     */
    private function getPayoutPeriod(OrderItem $orderItem): array
    {
        //Периоды выплат по размеру комиссии
        $periods = app(PaymentsScheduleRepository::class)->getPeriodsByPercentFee($orderItem->product_percent_fee);

        if (!$periods) {
            abort(Response::HTTP_NOT_FOUND, 'Не найдены периоды выплат кешбэка с заданным процентом комиссии товара/услуги');
        }

        switch (request('period')) {
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