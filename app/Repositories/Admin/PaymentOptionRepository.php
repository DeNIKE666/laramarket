<?php

namespace App\Repositories\Admin;

use App\Models\PaymentOption;

class PaymentOptionRepository
{
    public function listPayments()
    {
        return PaymentOption::all();
    }


}