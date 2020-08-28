<?php


namespace App\Services;

use App\Models\PaymentOption;

class Comission
{
    /**
     * @var $amount ;
     */
    protected $amount;

    /**
     * @param int $amount
     *
     * @return $this
     */
    public function amount(int $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Узнаем комиссию по платежной системе на ввод
     *
     * @param string $payMethod
     */

    /**
     * @param string $payMethod
     *
     * @return float|int
     */
    public function payComission(string $payMethod)
    {
        $payment = PaymentOption::query()
            ->where('title', $payMethod)
            ->first();

        $comission = $this->amount * $payment->depositeMoney;

        return $this->amount + $comission;
    }

    /**
     * @param string $payMethod
     *
     * @return float|int
     * Комиссия на вывод
     */
    public function withdrawComission(string $payMethod)
    {
        $payment = PaymentOption::query()->where('title', $payMethod)->first();

        $comission = $this->amount * $payment->withdrawMoney;

        return $this->amount - $comission;

    }
}