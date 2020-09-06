<?php


namespace App\Services\Buyer\Order;


use App\Models\OrdersDeliveryProfile;
use App\Repositories\OrderDeliveryProfilesRepository;

class DeliveryProfilesService
{
    /** @var OrderDeliveryProfilesRepository $orderDeliveryProfilesRepository */
    private $orderDeliveryProfilesRepository;

    public function __construct(OrderDeliveryProfilesRepository $orderDeliveryProfilesRepository)
    {
        $this->orderDeliveryProfilesRepository = $orderDeliveryProfilesRepository;
    }

    /**
     * Добавить профиль, если не передан или не найден по id профиля
     *
     * @param array $request
     *
     * @return OrdersDeliveryProfile
     */
    public function storeIfNotExists(array $request): OrdersDeliveryProfile
    {
        $deliveryProfileId = $request['delivery_profile_id'];

        $profile = null;

        if ($deliveryProfileId) {
            $profile = $this->orderDeliveryProfilesRepository->getOwnById(
                $deliveryProfileId,
                auth()->user()->id
            );
        }

        if (!$profile) {
            $profile = $this->store($request);
        }

        return $profile;
    }

    /**
     * Добавить профиль
     *
     * @param array $request
     *
     * @return OrdersDeliveryProfile
     */
    public function store(array $request): OrdersDeliveryProfile
    {
        $profile = [
            'user_id' => auth()->user()->id,
            'name'    => $request['name'],
            'phone'   => $request['phone'],
            'address' => $request['address'],
        ];

        return $this->orderDeliveryProfilesRepository->store($profile);
    }
}