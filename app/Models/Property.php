<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Property extends Model
{
    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'properties';

    /**
     * поля данных заявки продовца
     * @var array
     */
    protected $fillable = [
        'phone',
        'address',
        'citizenship',
        'type_shop',
        'inn',
        'ogrnip',
        'ur_address',
        'form_of_taxation',
        'bank',
        'bik',
        'rs',
        'ks',
        'fio_director',
        'kpp',
        'ogrn',
        'name_company',
        'passport_number',
        'passport_issued'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public static function add($fields)
    {
        $post = new static;
        $post->fill($fields);
        $post->save();
        return $post;
    }
}
