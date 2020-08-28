<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * Добавить на баланс кешбэка
     *
     * @param int $id
     * @param     $amount
     *
     * @return int
     */
    public function addCashback(int $id, $amount): int
    {
        return $this->model->query()
            ->where(compact('id'))
            ->increment('cashback_balance', $amount);
    }
}