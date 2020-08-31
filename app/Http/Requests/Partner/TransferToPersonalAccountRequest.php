<?php

namespace App\Http\Requests\Partner;

use Illuminate\Foundation\Http\FormRequest;

class TransferToPersonalAccountRequest extends FormRequest
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
            'amount' => 'bail|required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => __('partner/validation.amount.required'),
            'amount.numeric'  => __('partner/validation.amount.numeric'),
            'amount.min'      => __('partner/validation.amount.min')
        ];
    }
}
