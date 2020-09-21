<?php

namespace App\Http\Resources\Buyer;

use App\Http\Resources\PaySystemsResource;
use App\Models\PaymentOption;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/**
 * Class FinanceResource
 *
 * @package App\Http\Resources\Buyer
 *
 * @property int           $id
 * @property bool          $trans_direction
 * @property string        $trans_type
 * @property float         $amount
 * @property string        $created_at
 * @property PaymentOption $paySystem
 */
class FinanceResource extends JsonResource
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
        return [
            'id'         => $this->id,
            'direction'  => $this->trans_direction,
            'type'       => $this->trans_type,
            'amount'     => [
                'raw'       => $this->amount,
                'formatted' => formatByCurrency($this->amount, 2),
            ],
            'date'       => [
                'raw'       => $this->created_at,
                'formatted' => Carbon::parse($this->created_at)->format('d.m.Y H:i'),
            ],
            'test'       => PaySystemsResource::collection($this->paySystem->all()),
            'pay_system' => [
                'slug'  => $this->paySystem->slug,
                'title' => $this->paySystem->title,
            ],
        ];
    }
}
