<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Task;
use Auth;

class Message extends Model
{
    protected $fillable = ['content', 'user_id', 'task_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function getTypeMessage()
    {
        if ($this->user->role !== User::ROLE_ADMIN) {
            return 'vopros';
        } else {
            return 'otvet ml-auto';
        }
    }


}
