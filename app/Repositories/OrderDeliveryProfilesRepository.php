<?php


namespace App\Repositories;


use App\Models\OrdersDeliveryProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class OrderDeliveryProfilesRepository
{
    /** @var Model */
    private $model;

    public function __construct(OrdersDeliveryProfile $model)
    {
        $this->model = $model;
    }

    /**
     * Получить список профилей пользователя
     *
     * @param int $userId
     *
     * @return Collection
     */
    public function listByUser(int $userId): Collection
    {
        return $this->model
            ->query()
            ->find([$userId]);
    }

    /**
     * Есть ли профили у пользователя
     *
     * @param int $userId
     *
     * @return bool
     */
    public function existsByUser(int $userId): bool
    {
        return $this->model
            ->query()
            ->where('user_id', $userId)
            ->exists();
    }

    /**
     * Получить профиль по ид
     *
     * @param int $id
     * @param int $userId
     *
     * @return OrdersDeliveryProfile|null
     */
    public function getOwnById(int $id, int $userId): ?OrdersDeliveryProfile
    {
        return $this->model
            ->query()
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();
    }

    /**
     * Добавить профиль
     *
     * @param array $profile
     *
     * @return OrdersDeliveryProfile
     */
    public function store(array $profile): OrdersDeliveryProfile
    {
        return $this->model
            ->query()
            ->create($profile);
    }
}