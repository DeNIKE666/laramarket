<?php
namespace App\Repositories\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\PaymentOption;

class PaymentOptionRepository
{
    public function listPayments()
    {
        return PaymentOption::all();
    }
}