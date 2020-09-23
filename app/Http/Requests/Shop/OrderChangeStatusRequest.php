<?php

namespace App\Http\Requests\Shop;

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
            'order_id' => 'bail|required|integer',
            'status'   => 'bail|required|integer',
        ];

        $cancel = [
            Order::ORDER_STATUS_CANCELED_BY_BUYER,
            Order::ORDER_STATUS_CANCELED_BY_SELLER,
        ];

        if (in_array($this->input('status'), $cancel)) {
            $rules['notes'] = 'required|string|between:10,1000';
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

            'notes.required' => 'Введите причину отмены',
            'notes.between'  => 'Описание должно быть от :min до :max символов',
        ];
    }
}
