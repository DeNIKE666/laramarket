<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalHistoryAccount extends Model
{
    public function receiver()
    {
        return $this->belongsTo(User::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class);
    }
}
