<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerAsAloneHistoryAccount extends Model
{
    public function sender()
    {
        return $this->belongsTo(User::class);
    }
}
