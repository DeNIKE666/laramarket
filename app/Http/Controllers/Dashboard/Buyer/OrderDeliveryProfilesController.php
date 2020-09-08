<?php

namespace App\Http\Controllers\Dashboard\Buyer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\OrderDeliveryProfilesRepository;

class OrderDeliveryProfilesController extends Controller
{
    /** @var OrderDeliveryProfilesRepository */
    private $orderDeliveryProfilesRepository;

    public function __construct()
    {
        $this->orderDeliveryProfilesRepository = app(OrderDeliveryProfilesRepository::class);
    }

    public function list()
    {
        /** @var User $user */
        $user = auth()->user();

        return $this->orderDeliveryProfilesRepository->listByUser($user->id);
    }
}
