<?php


namespace App\Repositories;


use App\Models\Payment;

class PaymentsRepository
{
    /** @var Payment $model */
    private $model;

    public function __construct(Payment $model)
    {
        $this->model = $model;
    }

    /**
     * Добавить платеж
     *
     * @param array $payment
     *
     * @return Payment
     */
    public function store(array $payment): Payment
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
     * @return Payment
     */
    public function getById(int $id): Payment
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
     * @return Payment
     */
    public function changeStatus(int $id, string $status): Payment
    {
        /** @var Payment $item */
        $item = $this->getById($id);

        $item->status = $status;

        $item->save();

        return $item;
    }
}