<?php


namespace App\Repositories;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRepository
 *
 * @package App\Repositories
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
     * Найти партнера по токену
     *
     * @param string $partner_token
     *
     * @return User|null
     */
    public function getPartnerByToken(string $partner_token): ?User
    {
        return $this->model
            ->query()
            ->where(compact('partner_token'))
            ->first();
    }

    /**
     * Сделать пользователя партнером
     *
     * @param int $id
     *
     * @return bool
     */
    public function setAsPartner(int $id): bool
    {
        $user = $this->model
            ->query()
            ->where(compact('id'))
            ->firstOrFail();

        //Статус (покупатель/продавец)-партнер
        $role = $user->role === $user::ROLE_USER ? $user::ROLE_USER_PARTNER : $user::ROLE_SHOP_PARTNER;

        //Уникальный токен для партнерской ссылки
        $partner_token = $user->getUniquePartnerToken();

        return $user->update(compact('role', 'partner_token'));
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
            ->increment('cashback_account', $amount);
    }
}