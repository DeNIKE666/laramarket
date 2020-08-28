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
            'method.required' => 'Выберите платежную систему!',
            'method.integer'  => 'Выберите платежную систему!',
            'method.exists'   => 'Выберите платежную систему!',

            'amount.required' => 'Введите корректно сумму!',
            'amount.integer'  => 'Введите корректно сумму!',
            'amount.min'      => 'Минимальная сумма :min руб.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_total_amount' => $this->boolean('is_total_amount')
        ]);
    }
}
