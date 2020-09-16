<?php


namespace App\Repositories;


use App\Models\OrdersHoldsSchedule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * Class OrdersHoldsScheduleRepository
 *
 * @package App\Repositories
 *
 * @author  Anton Reviakin
 */
class OrdersHoldsScheduleRepository
{
    /** @var OrdersHoldsSchedule $model */
    private $model;

    public function __construct(OrdersHoldsSchedule $model)
    {
        $this->model = $model;
    }

    /**
     * Добавить расписание холда
     *
     * @param array $schedule
     *
     * @return OrdersHoldsSchedule
     */
    public function store(array $schedule): OrdersHoldsSchedule
    {
        return $this
            ->model
            ->query()
            ->create($schedule);
    }

    /**
     * Получить холд
     *
     * @param int  $orderId
     * @param bool $withOrder
     *
     * @return Builder
     */
    public function getSingleScheduleByOrder(int $orderId): Builder
    {
        return $this
            ->model
            ->query()
            ->where('order_id', $orderId);
    }

    /**
     * Получить незавершенный истекший холд
     *
     * @return OrdersHoldsSchedule|null
     */
    public function getSingleExpired(): ?OrdersHoldsSchedule
    {
        return $this
            ->model
            ->query()
            ->with('order')
            ->where('is_complete', false)
            ->where('expired_at', '<=', Carbon::now())
            ->orderBy('id')
            ->first();
    }

    /**
     * Отметить как выполненный
     *
     * @param int  $orderId
     * @param bool $isExpired
     *
     * @return bool
     */
    public function markAsCompleteByOrder(int $orderId, bool $isExpired = false): bool
    {
        return $this
            ->model
            ->query()
            ->where('order_id', $orderId)
            ->update([
                'is_complete' => true,
                'is_expired'  => $isExpired,
            ]);
    }
}