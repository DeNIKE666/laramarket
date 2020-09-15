<?php


namespace App\Services\Payments;


use App\Models\PaymentOption;
use App\Repositories\PaySystemsRepository;

class CommissionsService
{
    /** @var PaymentOption $paySystem */
    private $paySystem;

    /** @var PaySystemsRepository */
    private $paySystemsRepository;

    public function __construct()
    {
        $this->paySystemsRepository = app(PaySystemsRepository::class);
    }

    /**
     * Платежная система
     *
     * @param int $paySystem
     *
     * @return CommissionsService
     */
    public function paySystem(int $paySystem): CommissionsService
    {
        $this->paySystem = $this
            ->paySystemsRepository
            ->getById($paySystem);

        return $this;
    }

    /**
     * Сумма оплаты с комиссией
     *
     * @param float $amount
     *
     * @return float
     */
    public function purchaseWithComission(float $amount): float
    {
        return round($amount + ($amount * $this->paySystem->purchasing_fee), 2);
    }

    /**
     * Сумма оплаты без комиссии
     *
     * @param float $amount
     *
     * @return float
     */
    public function purchaseWithoutComission(float $amount): float
    {
        return round($amount / (1 + $this->paySystem->purchasing_fee), 2);
    }

    /**
     * Сумма пополнения с комиссией
     *
     * @param float $amount
     *
     * @return float
     */
    public function depositWithCommission(float $amount): float
    {
        return round($amount + ($amount * $this->paySystem->depositeMoney), 2);
    }

    /**
     * Сумма пополнения без комиссии
     *
     * @param float $amount
     *
     * @return float
     */
    public function depositWithoutCommission(float $amount): float
    {
        return round($amount / (1 + $this->paySystem->depositeMoney), 2);
    }

    /**
     * Сумма пополнения с комиссией
     *
     * @param float $amount
     *
     * @return float
     */
    public function withdrawWithCommission(float $amount): float
    {
        return round($amount + ($amount * $this->paySystem->withdrawMoney), 2);
    }

    /**
     * Сумма пополнения без комиссии
     *
     * @param float $amount
     *
     * @return float
     */
    public function withdrawWithoutCommission(float $amount): float
    {
        return round($amount / (1 + $this->paySystem->withdrawMoney), 2);
    }
}