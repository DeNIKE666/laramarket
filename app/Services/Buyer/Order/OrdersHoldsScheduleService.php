<?php


namespace App\Services\Buyer\Order;


use App\Models\OrdersHoldsSchedule;
use App\Models\Product;
use App\Repositories\Admin\SettingsRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrdersHoldsScheduleRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class OrdersHoldsScheduleService
{
    /** @var SettingsRepository $settingsRepository */
    private $settingsRepository;

    /** @var OrderItemRepository $orderItemRepository */
    private $orderItemRepository;

    /** @var OrdersHoldsScheduleRepository $ordersHoldsScheduleRepository */
    private $ordersHoldsScheduleRepository;

    public function __construct()
    {
        $this->settingsRepository = app(SettingsRepository::class);
        $this->orderItemRepository = app(OrderItemRepository::class);
        $this->ordersHoldsScheduleRepository = app(OrdersHoldsScheduleRepository::class);
    }

    /**
     * Добавить расписание холда
     *
     * @param int $orderId
     *
     * @return OrdersHoldsSchedule
     */
    public function store(int $orderId): OrdersHoldsSchedule
    {
        $schedule = [
            'order_id'   => $orderId,
            'expired_at' => $this->calcHoldPeriod($orderId),
        ];

        return $this
            ->ordersHoldsScheduleRepository
            ->store($schedule);
    }

    /**
     * Рассчитать дату истечения холда
     *
     * @param int $orderId
     *
     * @return Carbon
     */
    private function calcHoldPeriod(int $orderId): Carbon
    {
        $product = $this->getProductByOrder($orderId);

        $holdDays = $this->getHoldPeriodByProductType($product->group_product);
        $holdDays = Carbon::now()->addDays($holdDays);

        return $holdDays;
    }

    /**
     * Получить период холда по типу товара. Если не найден - то 1 день
     *
     * @param string $productGroup
     *
     * @return int
     */
    private function getHoldPeriodByProductType(string $productGroup): int
    {
        $setting = $this
            ->settingsRepository
            ->getSingleItem('orders_hold_period');

        if (!$setting) {
            abort(Response::HTTP_NOT_FOUND, 'Не найден параметр холда...');
        }

        //Если нет группы товара в настройках, то 1 день холда
        return (int)Arr::get($setting->value, $productGroup, 1);
    }

    /**
     * Получить продукт по номеру заказа
     *
     * @param int $orderId
     *
     * @return Product|null
     */
    private function getProductByOrder(int $orderId): ?Product
    {
        $product = $this
            ->orderItemRepository
            ->getProductsByOrder($orderId)
            ->first();

        if (!$product) {
            abort(Response::HTTP_NOT_FOUND, 'Не найдены товары по заказу №' . $orderId);
        }

        return $product->product;
    }
}