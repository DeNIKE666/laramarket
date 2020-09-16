<?php


namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Collection;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 * @author  Anton Reviakin
 */
class UserRepository
{
    /** @var User */
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Найти партнера пользователя
     *
     * @param int $userId
     *
     * @return User|null
     */
    public function getPartnerByUser(int $userId): ?User
    {
        $item = $this
            ->model
            ->query()
            ->where('id', $userId)
            ->first();

        return $item ? $item->partner : $item;
    }

    /**
     * Получить партнеров по кол-ву уровней
     *
     * @param int $userId
     * @param int $levels
     *
     * @return array
     */
    public function getPartnerByUserWithLevels(int $userId, int $levels = 1): array
    {
        $list = [];

        //Массив пригласителей начинается с 1 (для удобства уровней)
        for ($i = 1; $i <= $levels; $i++) {
            $list[$i] = $userId
                ? $this->getPartnerByUser($userId) //Если есть userId - выбрать
                : null;

            $userId = $list[$i]
                ? $list[$i]->partner_id //Сменить userId на пригласителя для следующей итерации
                : null;
        }

        return $list;
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
    public function getReferrals(int $partnerId): Collection
    {
        return $this
            ->model
            ->query()
            ->where('partner_id', $partnerId)
            ->get();
    }

    /**
     * Добавить на основной счет
     *
     * @param int   $id
     * @param float $amount
     *
     * @return int
     */
    public function addToPersonalAccount(int $id, float $amount): int
    {
        return $this
            ->model
            ->query()
            ->where(compact('id'))
            ->increment('personal_account', $amount);
    }

    /**
     * Отнять с основного счета
     *
     * @param int   $id
     * @param float $amount
     *
     * @return int
     */
    public function takeOffPersonalBalance(int $id, float $amount): int
    {
        return $this
            ->model
            ->query()
            ->where(compact('id'))
            ->decrement('personal_account', $amount);
    }

    /**
     * Добавить на счет кэшбэка
     *
     * @param int   $id
     * @param float $amount
     *
     * @return int
     */
    public function addToCashbackAccount(int $id, float $amount): int
    {
        return $this
            ->model
            ->query()
            ->where(compact('id'))
            ->increment('cashback_account', $amount);
    }

    /**
     * Отнять со счета кэшбэка
     *
     * @param int   $id
     * @param float $amount
     *
     * @return int
     */
    public function takeOffCashbackBalance(int $id, float $amount): int
    {
        return $this
            ->model
            ->query()
            ->where(compact('id'))
            ->decrement('cashback_account', $amount);
    }

    /**
     * Добавить на счет продавца
     *
     * @param int   $id
     * @param float $amount
     *
     * @return int
     */
    public function addToSellerAccount(int $id, float $amount): int
    {
        return $this
            ->model
            ->query()
            ->where(compact('id'))
            ->increment('seller_account', $amount);
    }

    /**
     * Отнять со счета продавца
     *
     * @param int   $id
     * @param float $amount
     *
     * @return int
     */
    public function takeOffSellerBalance(int $id, float $amount): int
    {
        return $this
            ->model
            ->query()
            ->where(compact('id'))
            ->decrement('seller_account', $amount);
    }

    /**
     * Добавить на партнерский счет
     *
     * @param int   $id
     * @param float $amount
     *
     * @return int
     */
    public function addToPartnerAccount(int $id, float $amount): int
    {
        return $this
            ->model
            ->query()
            ->where(compact('id'))
            ->increment('partner_account', $amount);
    }

    /**
     * Отнять с партнерского счета
     *
     * @param int   $id
     * @param float $amount
     *
     * @return int
     */
    public function takeOffPartnerBalance(int $id, float $amount): int
    {
        return $this
            ->model
            ->query()
            ->where(compact('id'))
            ->decrement('partner_account', $amount);
    }

    /**
     * Перенести сумму с партнерского на персональный счет
     *
     * @param int   $id
     * @param float $amount
     *
     * @return bool
     */
    public function transferFromPartnerToPersonal(int $id, float $amount): bool
    {
        $user = $this
            ->model
            ->query()
            ->where(compact('id'))
            ->firstOrFail();

        $user->personal_account += $amount;
        $user->partner_account -= $amount;

        return $user->save();
    }

}