<?php


namespace App\Repositories;


use App\Models\ExternalPayment;

class ExternalPaymentsRepository
{
    /** @var ExternalPayment $model */
    private $model;

    public function __construct(ExternalPayment $model)
    {
        $this->model = $model;
    }

    /**
     * Добавить платеж
     *
     * @param array $payment
     *
     * @return ExternalPayment
     */
    public function store(array $payment): ExternalPayment
    {
        return $this
            ->model
            ->query()
            ->create($payment);
    }

    /**
     * Платеж по id
     *
     * @param int $id
     *
     * @return ExternalPayment
     */
    public function getById(int $id): ExternalPayment
    {
        return $this
            ->model
            ->query()
            ->where(compact('id'))
            ->firstOrFail();
    }

    /**
     * Изменить статус
     *
     * @param int    $id
     * @param string $status
     *
     * @return ExternalPayment
     */
    public function changeStatus(int $id, string $status): ExternalPayment
    {
        /** @var ExternalPayment $item */
        $item = $this->getById($id);

        $item->status = $status;

        $item->save();

        return $item;
    }
}