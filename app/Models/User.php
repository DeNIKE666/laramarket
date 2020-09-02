<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

/**
 * Class User
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * Список ролей
     */
    const ROLE_USER = 'user';
    const ROLE_USER_PARTNER = 'user_partner';
    const ROLE_SHOP = 'shop';
    const ROLE_SHOP_PARTNER = 'shop_partner';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_ADMIN = 'admin';

    /**
     * Тип продавцов
     */
    const TYPE1 = 'persona';
    const TYPE2 = 'individual';
    const TYPE3 = 'company';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'partner_token',
        'partner_id',
        'role',
        'request_shop',
        'personal_account',
        'cashback_account',
        'shop_account',
        'partner_account',
        'phone',
        'address',
        'postal_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Является ли пользователь администратором
     *
     * @return bool
     * @author Anton Reviakin
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Является ли пользователь модератором
     *
     * @return bool
     * @author Anton Reviakin
     */
    public function isModerator(): bool
    {
        return $this->role === self::ROLE_MODERATOR;
    }

    /**
     * Является ли пользователь партнером
     *
     * @return bool
     * @author Anton Reviakin
     */
    public function isPartner(): bool
    {
        $roles = [
            self::ROLE_USER_PARTNER,
            self::ROLE_SHOP_PARTNER,
        ];

        return in_array($this->role, $roles);
    }

    /**
     * Является ли пользователь покупателем
     *
     * @return bool
     * @author Anton Reviakin
     */
    public function isBuyer(): bool
    {
        $roles = [
            self::ROLE_USER,
            self::ROLE_USER_PARTNER,
        ];

        return in_array($this->role, $roles);
    }

    /**
     * Является ли пользователь продавцом
     *
     * @return bool
     * @author Anton Reviakin
     */
    public function isSeller(): bool
    {
        $roles = [
            self::ROLE_SHOP,
            self::ROLE_SHOP_PARTNER,
        ];

        return in_array($this->role, $roles);
    }

    /**
     * Получить уникальный токен для партнерской ссылки
     *
     * @return string
     * @author Anton Reviakin
     */
    public function getUniquePartnerToken(): string
    {
        $tokenLn = mt_rand(7, 9);

        $partner_token = Str::lower(Str::random($tokenLn));

        $tokenExists = $this->query()
            ->where(compact('partner_token'))
            ->exists();

        return $tokenExists ? $this->getUniquePartnerToken() : $partner_token;
    }

    /**
     * Хватает ли средств на Партнерском счете
     *
     * @param int $amount
     *
     * @return bool
     * @author Anton Reviakin
     */
    public function checkPartnerAccount($amount = 0): bool
    {
        $user = $this
            ->query()
            ->where('id', $this->id)
            ->firstOrFail();

        return $user->partner_account >= $amount;
    }

    public function property()
    {
        return $this->hasOne(\App\Models\Property::class, 'user_id');
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function hasPropery(int $id)
    {
        return Property::where('user_id', '=', $id)->first();
    }

    public function isPropery(int $id)
    {
        if ($userProp = $this->hasPropery($id)) {
            return $userProp;
        } else {
            $userProp = new Property();
            $userProp->user_id = $id;
            return $userProp;
        }
    }
}
