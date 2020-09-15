<?php

namespace App\Http\Requests\Buyer;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class OrderStoreRequest extends FormRequest
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
        $Order = new Order();

        $deliveryServices = implode(",", $Order->getDeliveryServices());

        return [
            'delivery_profile_id' => 'bail|required|integer',
            'name'                => 'bail|required|string|regex:/^[а-яa-z\- ]+$/iu|regex:/(.+ ){2,}/|max:255',
            'phone'               => 'bail|required|string|regex:/' . $this->input('phone_mask') . '/',
            'email'               => 'bail|required|email:filter|unique:users,email,' . auth()->user()->id . ',id',
            'address'             => 'bail|required|string|max:255',
            'delivery_service'    => 'bail|required|string|in:' . $deliveryServices,
            'pay_system'          => 'bail|required|integer|exists:payment_options,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('buyer/checkout/validation.name.required'),
            'name.regex'    => __('buyer/checkout/validation.name.regex'),
            'name.max'      => __('buyer/checkout/validation.name.max'),

            'phone.required' => __('buyer/checkout/validation.phone.required'),
            'phone.regex'    => __('buyer/checkout/validation.phone.regex'),

            'email.required' => __('buyer/checkout/validation.email.required'),
            'email.email'    => __('buyer/checkout/validation.email.filter'),
            'email.unique'   => __('buyer/checkout/validation.email.unique'),

            'address.required' => __('buyer/checkout/validation.address.required'),
            'address.max'      => __('buyer/checkout/validation.address.max'),

            'delivery_service.required' => __('buyer/checkout/validation.delivery_service.required'),
            'delivery_service.in'       => __('buyer/checkout/validation.delivery_service.in'),

            'pay_system.required' => __('buyer/checkout/validation.payment_method.required'),
            'pay_system.integer'  => __('buyer/checkout/validation.payment_method.required'),
            'pay_system.exists'   => __('buyer/checkout/validation.payment_method.exists'),
        ];
    }

    protected function prepareForValidation()
    {
        $delivery_profile_id = $this->input('delivery_profile_id', 0);

        //Capitalize
        $name = Str::title($this->input('name'));

        //Сгенерировать regex маски телефона для последующей валидации
        $phone_mask = '^' . preg_replace(['/\#/', '/([^\d])/'], ['d', '\\\$1'], $this->input('phone_mask')) . '$';

        $this->merge(compact('delivery_profile_id', 'name', 'phone_mask'));
    }
}
