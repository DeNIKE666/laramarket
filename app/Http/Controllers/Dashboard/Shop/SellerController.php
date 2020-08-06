<?php
namespace App\Http\Controllers\Dashboard\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function seller_status()
    {
        return view(
            'dashboard.shop.user.status'

        );
    }
}