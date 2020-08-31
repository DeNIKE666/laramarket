<?php

namespace App\Repositories\Admin;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRepository
 *
 * @package App\Repositories\Admin
 * @author  Anton Reviakin
 */
class UserRepository
{
    /** @var Model */
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Список пользователей
     *
     * @return LengthAwarePaginator
     */
    public function listUsers(): LengthAwarePaginator
    {
        return $this->model->paginate(30);
//        return User::where('role', '!=', User::ROLE_ADMIN)->paginate(30);
    }

    /**
     * Назначить продавцом
     *
     * @param int $id
     *
     * @return bool
     * @author Anton Reviakin
     */
    public function setAsSeller(int $id): bool
    {
        $user = $this->model
            ->where(compact('id'))
            ->firstOrFail();

        //Если уже является партнером - сохранить статус партнера
        $role = $user->isPartner() ? $user::ROLE_SHOP_PARTNER : $user::ROLE_SHOP;

        $update = [
            'role'         => $role,
            'request_shop' => false,
        ];

        return $user->update($update);
    }
}
