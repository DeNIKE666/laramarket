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
     * @param int $order_id
     * @param     $cost
     * @param int $status
     *
     * @return Cashback
     */
    public function store(int $order_id, $cost, int $status): Cashback
    {
        return Cashback::create(compact('order_id', 'cost', 'status'));
    }

    /**
     * Установить период выплат в кешбеке
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