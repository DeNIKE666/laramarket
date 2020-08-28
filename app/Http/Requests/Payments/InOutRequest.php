<?php

namespace App\Http\Requests\Payments;

use Illuminate\Foundation\Http\FormRequest;

class InOutRequest extends FormRequest
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
            'method' => 'bail|required|integer|exists:payment_options,id',
            'amount' => 'bail|required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'method.required' => 'Выберите способ пополнения!',
            'method.integer'  => 'Выберите способ пополнения!',
            'method.exists'   => 'Выберите способ пополнения!',

            'amount.required' => 'Введите сумму пополнения',
            'amount.integer'  => 'Введите сумму пополнения',
            'amount.min'      => 'Минимальная сумма пополнения :min руб.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_total_amount' => $this->boolean('is_total_amount')
        ]);
    }
}
