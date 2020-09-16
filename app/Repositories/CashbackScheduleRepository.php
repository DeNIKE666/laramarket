<?php


namespace App\Repositories;


use App\Models\CashbackSchedule;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class CashbackScheduleRepository extends BaseRepository
{
    public function __construct(CashbackSchedule $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * Заполнить расписание выплат
     *
     * @param array $schedules
     *
     * @return bool
     */
    public function fill(array $schedules): bool
    {
        $schedules = array_map(function ($item) {
            $item['created_at'] = Carbon::now();
            $item['updated_at'] = Carbon::now();

            return $item;
        }, $schedules);

        return $this
            ->model
            ->insert($schedules);
    }

    /**
     * Получить список для начисления кэшбэка
     *
     * @return Collection
     */
    public function getSchedulesForPayout(): Collection
    {
        return $this
            ->model
            ->query()
            ->with('cashback')
            ->where('payout_complete', false)
            ->where('payout_at', '<=', Carbon::now())
            ->orderBy('id')
            ->get();
    }

    /**
     * Отметить как выплаченное
     *
     * @param int $id
     *
     * @return bool
     */
    public function setAsCompletePayout(int $id): bool
    {
        $payout_complete = true;

        return $this->model::query()
            ->where(compact('id'))
            ->update(compact('payout_complete'));
    }

    /**
     * История начислений
     *
     * @param int            $userId
     * @param array|string[] $sort
     *
     * @return LengthAwarePaginator
     */
    public function historyCompletedByUser(int $userId, array $sort = ['id', 'asc']): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->with('paySystem')
            ->where('user_id', $userId)
            ->where('payout_complete', true)
            ->orderBy($sort)
            ->paginate(10);
    }
}