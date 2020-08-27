<?php


namespace App\Services\Cashback;


use App\Models\Cashback;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CashbackService
{
    /**
     * Добавить Кешбек
     *
     * @param Order $order
     *
     * @return Cashback
     */
    public function storeCashback(Order $order): Cashback
    {
        return Cashback::create([
            'order_id' => $order->id,
            'cost'     => $order->cost,
            'status'   => Cashback::STATUS_WAIT_FOR_RECEIVE,
        ]);
    }

    /**
     * Установить период выплат в кешбеке
     *
     * @param Request $request
     * @param Order   $order
     *
     * @return bool
     */
    public function updateCashback(Request $request, Order $order): bool
    {
        if (!$this->periodExist($request->input('period'))) {
            abort(Response::HTTP_UNPROCESSABLE_ENTITY, 'Не правильный период выплат');
        }

        $cashbackItem = Cashback::where('order_id', $order->id)->first();

        \Log::info(__METHOD__, $cashbackItem->toArray());

        return $cashbackItem->update([
            'period' => $request->input('period'),
        ]);
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