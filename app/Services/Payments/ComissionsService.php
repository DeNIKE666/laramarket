<?php


namespace App\Services\Payments;


use App\Models\PaymentOption;

class ComissionsService
{
    /** @var int $amount */
    private $amount;

    /** @var int $payMethod */
    private $payMethod;

    /**
     * @param int $amount
     *
     * @return ComissionsService
     */
    public function amount(int $amount): ComissionsService
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param int $payMethod
     *
     * @return ComissionsService
     */
    public function method(int $payMethod): ComissionsService
    {
        $this->payMethod = $payMethod;
        return $this;
    }

    /**
     * Узнаем комиссию по платежной системе на ввод
     *
     * @param string $payMethod
     */

    /**
     * Сумма с комиссией пополнения
     *
     * @param bool $isTotalAmount
     *
     * @return int
     */
    public function payinComission(bool $isTotalAmount = false): int
    {
        $payment = PaymentOption::find($this->payMethod);

        if (!$isTotalAmount) {
            $comission = floor($this->amount + $this->amount * $payment->depositeMoney);
        } else {
            $comission = floor($this->amount / (1 + $payment->depositeMoney));
        }

        return $comission;
    }

    /**
     * @param string $payMethod
     *
     * @return float|int
     * Комиссия на вывод
     */
    public function payoutComission(string $payMethod)
    {
        $payment = PaymentOption::query()->where('title', $payMethod)->first();

        $comission = $this->amount * $payment->withdrawMoney;

        return $this->amount - $comission;

    }
}