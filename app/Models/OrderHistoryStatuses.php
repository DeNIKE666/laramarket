<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderHistoryStatuses
 *
 * @author Anton Reviakin
 *
 * @package App\Models
 */
class OrderHistoryStatuses extends Model
{
    protected $fillable = [
        'order_id',
        'status',
        'notes'
    ];
}
