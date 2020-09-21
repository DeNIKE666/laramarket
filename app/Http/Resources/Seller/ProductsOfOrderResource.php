<?php

namespace App\Http\Resources\Seller;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProductsOfOrderResource
 *
 * @package App\Http\Resources\Seller
 *
 * @property string  $title
 * @property float   $price
 * @property int     $quantity
 * @property float   $product_percent_fee
 * @property Product $product
 */
class ProductsOfOrderResource extends JsonResource
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
        //Процент комиссии за товар
        $productPercentFee = (float)$this->product_percent_fee;

        //Цена за товар расчитывается так, а не из таблицы товаров
        //из-за изменения продавцом цены самого товара
        $pricePerProduct = round((float)$this->price / $this->quantity, 2);
        //Цена за товар с комиссией
        $pricePerProductWithFee = round($pricePerProduct - ($pricePerProduct * $productPercentFee / 100), 2);

        //Сумма заказа
        $price = (float)$this->price;
        $priceWithFee = round($price - ($price * $productPercentFee / 100), 2);

        return [
            'title'     => $this->product->title,

            //Цена за товар с комиссией и без
            'price'     => [
                'without_fee' => [
                    'raw'       => $pricePerProduct,
                    'formatted' => formatByCurrency($pricePerProduct, 2),
                ],
                'with_fee'    => [
                    'raw'       => $pricePerProductWithFee,
                    'formatted' => formatByCurrency($pricePerProductWithFee, 2),
                ],
            ],
            //Комиссия
            'price_fee' => [
                'raw'       => round($pricePerProduct - $pricePerProductWithFee, 2),
                'formatted' => formatByCurrency($pricePerProduct - $pricePerProductWithFee, 2),
            ],

            //Сумма заказа с комиссией и без
            'sum'       => [
                'without_fee' => [
                    'raw'       => $price,
                    'formatted' => formatByCurrency($price, 2),
                ],
                'with_fee'    => [
                    'raw'       => $priceWithFee,
                    'formatted' => formatByCurrency($priceWithFee, 2),
                ],
            ],
            //Комиссия
            'sum_fee'   => [
                'raw'       => round($price - $priceWithFee, 2),
                'formatted' => formatByCurrency($price - $priceWithFee, 2),
            ],

            'quantity'    => $this->quantity,
            'percent_fee' => [
                'raw'       => $productPercentFee,
                'formatted' => $productPercentFee . '%',
            ],
        ];
    }
}
