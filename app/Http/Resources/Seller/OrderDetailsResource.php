<?php

namespace App\Http\Resources\Seller;

use App\Models\OrderHistoryStatuses;
use App\Models\OrdersDeliveryProfile;
use App\Models\Payment;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Class OrderDetailsResource
 *
 * @package App\Http\Resources\Seller
 *
 * @property int                   $id
 * @property string                $created_at
 * @property OrderHistoryStatuses  $currentStatus
 * @property Collection            $itemsWithProducts
 * @property OrdersDeliveryProfile $deliveryProfile
 * @property Payment               $payment
 */
class OrderDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $orderStatuses = __('orders/status');
        $deliveryServices = __('orders/delivery.services');
        $paymentStatuses = __('payments/status');

        $products = ProductsOfOrderResource::collection($this->itemsWithProducts);

        return [
            'orderId'             => $this->id,
            'orderCreated'        => [
                'raw'       => $this->created_at,
                'formatted' => Carbon::parse($this->created_at)->format('d.m.Y H:i'),
            ],

            //Текущий статус заказа
            'orderStatus'         => [
                'raw'       => $this->currentStatus->status,
                'formatted' => $orderStatuses[$this->currentStatus->status],
            ],
            'orderStatusDate'     => [
                'raw'       => $this->currentStatus->created_at,
                'formatted' => Carbon::parse($this->currentStatus->created_at)->format('d.m.Y H:i'),
            ],

            //Продукты в заказе
            'products'            => $products,
            'productsTotalPrices' => $this->getTotalProductsPrices($products),

            //Доставка
            'deliveryName'        => $this->deliveryProfile->name,
            'deliveryPhone'       => $this->deliveryProfile->phone,
            'deliveryAddress'     => $this->deliveryProfile->address,
            'deliveryService'     => [
                'raw'       => $this->deliveryProfile->delivery_service,
                'formatted' => $deliveryServices[$this->deliveryProfile->delivery_service],
            ],

            //Оплата
            'payMethod'           => $this->payment->paySystem->title,
            'payStatus'           => [
                'raw'       => $this->payment->status,
                'formatted' => $paymentStatuses[$this->payment->status],
            ],
            'payDate'             => [
                'raw'       => $this->payment->updated_at,
                'formatted' => Carbon::parse($this->payment->updated_at)->format('d.m.Y H:i'),
            ],
        ];
    }

    private function getTotalProductsPrices($products)
    {
        $products = collect(json_decode($products->toJson(), true));

        //Сумма цен за единицу товара без учета комиссий
        $priceWithoutFee = $products->sum('price.without_fee.raw');
        //Сумма цен за единицу товара с учетом комиссий
        $priceWithFee = $products->sum('price.with_fee.raw');
        //Сумма комиссий цен за единицу товара
        $priceFee = $products->sum('price_fee.raw');

        //Сумма сумм заказа без учета комиссий
        $sumWithoutFee = $products->sum('sum.without_fee.raw');
        //Сумма сумм заказа с учетом комиссий
        $sumWithFee = $products->sum('sum.with_fee.raw');
        //Сумма комиссий сумм заказа
        $sumFee = $products->sum('sum_fee.raw');

        $total = [
            'price'     => [
                'without_fee' => [
                    'raw'       => $priceWithoutFee,
                    'formatted' => formatByCurrency($priceWithoutFee, 2),
                ],
                'with_fee'    => [
                    'raw'       => $priceWithFee,
                    'formatted' => formatByCurrency($priceWithFee, 2),
                ],
            ],
            'price_fee' => [
                'raw'       => $priceFee,
                'formatted' => formatByCurrency($priceFee, 2),
            ],

            'sum'     => [
                'without_fee' => [
                    'raw'       => $sumWithoutFee,
                    'formatted' => formatByCurrency($sumWithoutFee, 2),
                ],
                'with_fee'    => [
                    'raw'       => $sumWithFee,
                    'formatted' => formatByCurrency($sumWithFee, 2),
                ],
            ],
            'sum_fee' => [
                'raw'       => $sumFee,
                'formatted' => formatByCurrency($sumFee, 2),
            ],
        ];

        return $total;
    }
}
