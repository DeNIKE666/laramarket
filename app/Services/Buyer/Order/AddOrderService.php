<?php


namespace App\Services\Buyer\Order;


use App\Models\Order;
use App\Models\Product;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use Cart;
use Illuminate\Support\Carbon;

/**
 * Class AddOrderService
 *
 * @package App\Services\Buyer\Order
 *
 * @author  Anton Reviakin
 */
class AddOrderService
{
    /** @var OrderRepository $orderRepository */
    private $orderRepository;

    /** @var OrderItemRepository $orderItemRepository */
    private $orderItemRepository;

    public function __construct()
    {
        $this->orderRepository = app(OrderRepository::class);
        $this->orderItemRepository = app(OrderItemRepository::class);
    }

    /**
     * Добавить заказ
     *
     * @param int   $deliveryProfileId
     * @param int   $paymentId
     *
     * @return Order
     */
    public function storeOrder(int $deliveryProfileId, int $paymentId): Order
    {
        $order = [
            'user_id'             => auth()->user()->id,
            'delivery_profile_id' => $deliveryProfileId,
            'payment_id'          => $paymentId,
            'cost'                => Cart::getSubTotal(false),
            'status'              => Order::ORDER_STATUS_NEW,
        ];

        $order = $this
            ->orderRepository
            ->store($order);

        $this->storeOrderItems($order);

        return $order;
    }

    /**
     * Массовая вставка продуктов заказа
     *
     * @param Order $order
     *
     * @return bool
     * @author Anton Reviakin
     */
    private function storeOrderItems(Order $order): bool
    {
        $products = Cart::getContent();

        $orderItems = [];

        foreach ($products as $product) {
            //ПЕРЕПИСАТЬ!!!
            $percentFee = Product::where('id', $product->attributes['product_id'])->first('part_cashback');

            $orderItems[] = [
                'order_id'            => $order->id,
                'product_id'          => $product->attributes['product_id'],
                'quantity'            => $product->quantity,
                'price'               => Order::formatCost($product->getPriceSum()),
                'product_percent_fee' => $percentFee['part_cashback'],
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ];
        }

        return $this
            ->orderItemRepository
            ->batchStore($orderItems);
    }
}