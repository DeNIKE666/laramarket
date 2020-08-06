<?php

namespace App\Repositories\Admin;

use App\Models\PaymentSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SettingPaymentScheduleRepository
{
    public function listSettings()
    {
        return PaymentSchedule::all();
    }
}
