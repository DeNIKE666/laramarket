<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Message;

class Task extends Model
{
    /**
     * Список статусов
     */
    public const STATUS_TASK_ACTIVE = 'active';
    public const STATUS_TASK_CLOSE = 'close';

    protected $fillable = ['title', 'user_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
