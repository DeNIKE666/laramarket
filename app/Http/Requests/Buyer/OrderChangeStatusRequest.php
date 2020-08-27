<?php

namespace App\Http\Requests\Buyer;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderChangeStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'order_id' => 'bail|required|integer|exists:orders,id',
            'status'   => 'bail|required|integer',
        ];

        if ($this->input('status') == Order::STATUS_ORDER_RECEIVED) {
            $rules['period'] = 'bail|required|integer';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'order_id.required' => 'Не указан номер заказа',
            'order_id.integer'  => 'Не указан номер заказа',

            'status.required' => 'Не выбран статус заказа',
            'status.integer'  => 'Не выбран статус заказа',

            'period.required' => 'Не выбран период выплат',
            'period.integer'  => 'Не выбран период выплат',
        ];
    }
}
