<?php


namespace App\Repositories;


use App\Models\Cashback;

class CashbackRepository extends BaseRepository
{
    public function __construct(Cashback $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * Добавить кешбек
     *
     * @param int $user_id
     * @param int $order_id
     * @param     $cost
     * @param int $status
     *
     * @return Cashback
     */
    public function store(int $user_id, int $order_id, $cost, int $status): Cashback
    {
        return $this
            ->create(compact(
                'user_id',
                'order_id',
                'cost',
                'status'
            ));
    }

    /**
     * Установить статус выплат в кешбэке
     *
     * @param int $order_id
     * @param int $status
     *
     * @return bool
     */
    public function setPayoutsStatus(int $order_id, int $status): bool
    {
        return $this
            ->findOneBy(compact('order_id'))
            ->update(compact('status'));
    }

    /**
     * Установить период выплат в кешбэке
     *
     * @param int $order_id
     * @param int $period
     *
     * @return bool
     */
    public function setPayoutsPeriod(int $order_id, int $period): bool
    {
        return $this
            ->findOneBy(compact('order_id'))
            ->update(compact('period'));
    }
}