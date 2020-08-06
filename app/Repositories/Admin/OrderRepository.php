<?php
namespace App\Repositories\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Order;

class OrderRepository
{
    public function getAllOrders()
    {
        return Order::orderBy('id', 'desc')->paginate(10);
    }
}
