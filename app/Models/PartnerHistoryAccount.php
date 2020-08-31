<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerHistoryAccount extends Model
{
    public function sender()
    {
        return $this->belongsTo(User::class);
    }
}
