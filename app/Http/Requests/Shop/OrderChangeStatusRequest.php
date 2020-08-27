<?php

namespace App\Http\Requests\Shop;

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
        return [
            'order_id' => 'bail|required|integer',
            'status'   => 'bail|required|integer',
        ];
    }

    public function messages()
    {
        return [
            'order_id.required' => 'Не указан номер заказа',
            'order_id.integer'  => 'Не указан номер заказа',

            'status.required' => 'Не выбран статус заказа',
            'status.integer'  => 'Не выбран статус заказа',
        ];
    }
}
