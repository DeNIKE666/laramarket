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
     * Сумма с комиссией снятия
     *
     * @param bool $isTotalAmount
     *
     * @return int
     */
    public function payoutComission(bool $isTotalAmount = false): int
    {
        $payment = PaymentOption::find($this->payMethod);

        if (!$isTotalAmount) {
            $comission = floor($this->amount + $this->amount * $payment->withdrawMoney);
        } else {
            $comission = floor($this->amount / (1 + $payment->withdrawMoney));
        }

        return $comission;


//        $payment = PaymentOption::query()->where('title', $payMethod)->first();
//
//        $comission = $this->amount * $payment->withdrawMoney;
//
//        return $this->amount - $comission;

    }
}