<?php


namespace App\Repositories;


use App\Models\Cashback;
use App\Models\CashbackSchedule;

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
        return $this->model->insert($schedules);
    }
}