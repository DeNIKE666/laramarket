<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $partner_token
 * @property string $referral
 * @property string $phone
 * @property string $address
 * @property string $postal_code
 * @property int|null $is_partner
 * @property int|null $request_partner
 * @property int|null $request_shop
 *
 */

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Список ролей
     */
    public const ROLE_USER = 'user';
    public const ROLE_SHOP = 'shop';
    public const ROLE_ADMIN = 'admin';

    public const NAME_ROLE_USER = 'Пользователь';
    public const NAME_ROLE_SHOP = 'Продавец';


    /**
     * тип подовцов
     */
    public const TYPE1 = 'persona';
    public const TYPE2 = 'individual';
    public const TYPE3 = 'company';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',             //роли по умолчанию user
        'partner_token',    //токен парнера для реферной ссылки
        'is_partner',       //статус партнера [0, 1]
        'personal_account', //счёт
        'referral',         //если пользователь зарегестрировался по реферной ссылке, она связанна с partner_token
        'phone',
        'address',
        'postal_code',
        'request_partner',  //запрос на партнера
        'request_shop',     //запрос на продавца
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

    public function property()
    {
        return $this->hasOne(\App\Models\Property::class, 'user_id');
    }

    public function getName() {
        return ($this->name) ? $this->name : $this->email;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function getType1() {
        return self::TYPE1;
    }
    public function getType2() {
        return self::TYPE2;
    }
    public function getType3() {
        return self::TYPE3;
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

    public function getNameRole() {
        switch ($this->role) {
            case self::ROLE_USER:
                return self::NAME_ROLE_USER;
                break;
            case self::ROLE_SHOP:
                return self::NAME_ROLE_SHOP;
                break;
        }
    }
}
