<?php


namespace App\Repositories;


use App\Models\PaymentSchedule;

class PaymentsScheduleRepository
{
    /**
     * Получить периоды выплат по размеру комиссии
     *
     * @param int $percent
     *
     * @return PaymentSchedule|null
     */
    public function getPeriodsByPercentFee(int $percent): ?PaymentSchedule
    {
        return PaymentSchedule::where('percent', '<=', $percent)
            ->orderByDesc('percent')
            ->first();
    }
}