<?php


namespace App\Repositories;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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
        $role = $user->isBuyer() ? $user::ROLE_BUYER_PARTNER : $user::ROLE_SELLER_PARTNER;

        //Уникальный токен для партнерской ссылки
        $partner_token = $user->getUniquePartnerToken();

        return $user->update(compact('role', 'partner_token'));
    }

    /**
     * Получить рефералов
     *
     * @param int $partner_id
     *
     * @return Collection
     */
    public function getReferrals(int $partner_id): Collection
    {
        return $this->model
            ->query()
            ->where(compact('partner_id'))
            ->get();
    }

    /**
     * Добавить на основной счет
     *
     * @param int $id
     * @param     $amount
     *
     * @return int
     */
    public function addToPersonalAccount(int $id, $amount): int
    {
        return $this->model->query()
            ->where(compact('id'))
            ->increment('personal_account', $amount);
    }

    /**
     * Отнять с основного счета
     *
     * @param int $id
     * @param     $amount
     *
     * @return int
     */
    public function takeOffPersonalBalance(int $id, $amount): int
    {
        return $this->model->query()
            ->where(compact('id'))
            ->decrement('personal_account', $amount);
    }

    /**
     * Добавить на счет кешбэка
     *
     * @param int $id
     * @param     $amount
     *
     * @return int
     */
    public function addToCashbackAccount(int $id, $amount): int
    {
        return $this->model->query()
            ->where(compact('id'))
            ->increment('cashback_account', $amount);
    }

    /**
     * Отнять со счета кешбэка
     *
     * @param int $id
     * @param     $amount
     *
     * @return int
     */
    public function takeOffCashbackBalance(int $id, $amount): int
    {
        return $this->model->query()
            ->where(compact('id'))
            ->decrement('cashback_account', $amount);
    }

    /**
     * Добавить на счет продавца
     *
     * @param int $id
     * @param     $amount
     *
     * @return int
     */
    public function addToShopAccount(int $id, $amount): int
    {
        return $this->model->query()
            ->where(compact('id'))
            ->increment('seller_account', $amount);
    }

    /**
     * Отнять со счета магазина
     *
     * @param int $id
     * @param     $amount
     *
     * @return int
     */
    public function takeOffShopBalance(int $id, $amount): int
    {
        return $this->model->query()
            ->where(compact('id'))
            ->decrement('seller_account', $amount);
    }

    /**
     * Добавить на партнерский счет
     *
     * @param int $id
     * @param     $amount
     *
     * @return int
     */
    public function addToPartnerAccount(int $id, $amount): int
    {
        return $this->model->query()
            ->where(compact('id'))
            ->increment('partner_account', $amount);
    }

    /**
     * Отнять с партнерского счета
     *
     * @param int $id
     * @param     $amount
     *
     * @return int
     */
    public function takeOffPartnerBalance(int $id, $amount): int
    {
        return $this->model->query()
            ->where(compact('id'))
            ->decrement('partner_account', $amount);
    }

    /**
     * Перенести сумму с партнерского на персональный счет
     *
     * @param int $id
     * @param     $amount
     *
     * @return bool
     */
    public function transferFromPartnerToPersonal(int $id, $amount): bool
    {
        $user = $this->model->query()
            ->where(compact('id'))
            ->firstOrFail();

        $user->personal_account += $amount;
        $user->partner_account -= $amount;

        return $user->save();
    }

}