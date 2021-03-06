<?php


namespace App\Repositories;


use App\Models\Cashback;
use Illuminate\Database\Eloquent\Builder;

class CashbackRepository
{
    /** @var Cashback $model */
    private $model;

    public function __construct(Cashback $model)
    {
        $this->model = $model;
    }

    /**
     * Получить кэшбэк по номеру заказа
     *
     * @param int $orderId
     *
     * @return Cashback
     */
    public function getByOrder(int $orderId): Cashback
    {
        return $this
            ->model
            ->query()
            ->where('order_id', $orderId)
            ->firstOrFail();
    }

    /**
     * Добавить кэшбэк
     *
     * @param int $userId
     * @param int $orderId
     * @param     $cost
     * @param int $status
     *
     * @return Cashback
     */
    public function store(int $userId, int $orderId, $cost, int $status): Cashback
    {
        return $this
            ->model
            ->query()
            ->create([
                'user_id'  => $userId,
                'order_id' => $orderId,
                'cost'     => $cost,
                'status'   => $status,
            ]);
    }

    /**
     * Установить статус выплат в кэшбэке
     *
     * @param int $orderId
     * @param int $status
     *
     * @return bool
     */
    public function setPayoutsStatus(int $orderId, int $status): bool
    {
        return $this
            ->getByOrder($orderId)
            ->update([
                'status' => $status,
            ]);
    }

    /**
     * Установить период выплат в кэшбэке
     *
     * @param int $orderId
     * @param int $period
     *
     * @return bool
     */
    public function setPayoutsPeriod(int $orderId, int $period): bool
    {
        return $this
            ->getByOrder($orderId)
            ->update([
                'period' => $period,
            ]);
    }

    /**
     * История начислений
     *
     * @param int            $userId
     * @param array|string[] $sort
     *
     * @return Builder
     */
    public function listInProgress(int $userId, array $sort = ['id', 'desc']): Builder
    {
        return $this
            ->model
            ->query()
            ->with('nextCashbackPayout')
            ->with('schedules')
            ->where('user_id', $userId)
            ->where('status', 2)
            ->orderBy($sort[0], $sort[1]);
    }
}