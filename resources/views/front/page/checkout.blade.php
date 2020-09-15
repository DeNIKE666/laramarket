@php
    /** @var \App\Models\User $user */
    $user = auth()->user();

    /** @var \App\Repositories\PaySystemsRepository $paySystems */
    /** @var \App\Models\PaymentOption $paySystem */

    /** @var \App\Models\Order $order */
    $order = new \App\Models\Order();
@endphp

@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('vendors/Inputmask-5.x/dist/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('vendors/inputmask.phone-master/dist/phone-codes/phone.js') }}"></script>
    <script src="{{ asset('vendors/inputmask.phone-master/dist/inputmask.phone.extensions.js') }}"></script>
    <script src="{{ asset('js/masked-phone.js') }}"></script>
    <script src="{{ asset('js/dashboard/buyer/checkout.js') }}"></script>
    <script>
        const getProfilesUrl = "";
    </script>
@endpush

@section('breadcrumbs')
    {{ Breadcrumbs::render('page', 'Оформление заказа') }}
@endsection
@section('content')
    <div class="block-cart">
        <div class="wrapper">
            {{ Form::open(['route' => 'buyer.order.store', 'method' => 'post', 'id' => 'form-checkout']) }}
            <div class="cartBlock cartData">
                <div class="title" style="margin-bottom: 1rem;">
                    Личные данные
                </div>
                <div class="cartAddress__row cartData__row">
                    <div style="height: 75px;">
                        <div class="cartData__inp" style="width: 100%;">
                            <div class="cartAddress__icon">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="36px" height="36px">
                                    <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                                          d="M18.002,0.005 C8.104,0.005 0.005,8.104 0.005,18.002 C0.005,27.900 8.104,35.999 18.002,35.999 C27.900,35.999 35.999,27.900 35.999,18.002 C35.999,8.104 27.900,0.005 18.002,0.005 ZM18.002,5.404 C21.061,5.404 23.401,7.744 23.401,10.803 C23.401,13.863 21.061,16.202 18.002,16.202 C14.942,16.202 12.603,13.863 12.603,10.803 C12.603,7.744 14.942,5.404 18.002,5.404 ZM18.002,30.960 C13.503,30.960 9.543,28.620 7.204,25.201 C7.204,21.601 14.402,19.622 18.002,19.622 C21.601,19.622 28.800,21.601 28.800,25.201 C26.460,28.620 22.501,30.960 18.002,30.960 Z"/>
                                </svg>
                            </div>
                            {{ Form::text('name', $user->name, ['placeholder' => 'Ф.И.О.', 'class' => 'cartAddress__inp']) }}
                        </div>
                    </div>

                    <div style="height: 75px;">
                        <div class="cartData__inp" style="width: 100%;">
                            <div class="cartAddress__icon">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="36px" height="36px">
                                    <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                                          d="M18.000,35.999 C8.059,35.999 -0.000,27.940 -0.000,17.999 C-0.000,8.058 8.059,-0.001 18.000,-0.001 C27.941,-0.001 36.000,8.058 36.000,17.999 C36.000,27.940 27.941,35.999 18.000,35.999 ZM15.198,15.636 C15.314,15.520 15.430,15.400 15.546,15.284 C16.415,14.415 16.415,13.289 15.546,12.420 L14.415,11.291 C14.287,11.162 14.154,11.030 14.030,10.898 C13.782,10.641 13.521,10.376 13.252,10.128 C12.850,9.731 12.370,9.519 11.864,9.519 C11.359,9.519 10.870,9.731 10.456,10.128 C10.452,10.132 10.452,10.132 10.448,10.136 L9.040,11.556 C8.510,12.085 8.208,12.731 8.141,13.480 C8.042,14.688 8.398,15.813 8.671,16.550 C9.342,18.359 10.345,20.034 11.840,21.831 C13.653,23.995 15.836,25.704 18.329,26.908 C19.281,27.359 20.553,27.893 21.973,27.984 C22.060,27.988 22.151,27.992 22.234,27.992 C23.191,27.992 23.994,27.649 24.623,26.966 C24.628,26.958 24.636,26.954 24.640,26.945 C24.855,26.685 25.104,26.449 25.365,26.196 C25.543,26.026 25.725,25.849 25.903,25.663 C26.313,25.236 26.528,24.740 26.528,24.230 C26.528,23.718 26.309,23.225 25.891,22.811 L23.617,20.531 C23.215,20.113 22.731,19.890 22.217,19.890 C21.708,19.890 21.219,20.109 20.801,20.527 L19.492,21.831 C19.385,21.772 19.277,21.719 19.174,21.665 C19.024,21.590 18.884,21.520 18.764,21.446 C17.538,20.668 16.424,19.654 15.355,18.342 C14.838,17.688 14.490,17.138 14.237,16.579 C14.577,16.269 14.892,15.946 15.198,15.636 ZM18.714,13.050 C19.799,13.231 20.784,13.745 21.571,14.531 C22.358,15.317 22.868,16.302 23.054,17.386 C23.099,17.659 23.335,17.849 23.605,17.849 C23.638,17.849 23.667,17.845 23.700,17.841 C24.006,17.792 24.209,17.502 24.160,17.196 C23.936,15.884 23.315,14.688 22.366,13.740 C21.418,12.793 20.221,12.172 18.909,11.949 C18.602,11.899 18.316,12.102 18.262,12.404 C18.209,12.706 18.407,13.000 18.714,13.050 ZM24.756,11.344 C23.191,9.780 21.223,8.762 19.062,8.394 C18.759,8.340 18.474,8.547 18.420,8.849 C18.370,9.155 18.573,9.441 18.880,9.495 C20.809,9.822 22.569,10.736 23.969,12.131 C25.369,13.529 26.280,15.288 26.607,17.217 C26.653,17.490 26.889,17.680 27.158,17.680 C27.191,17.680 27.220,17.676 27.253,17.672 C27.555,17.626 27.762,17.336 27.709,17.034 C27.340,14.874 26.321,12.909 24.756,11.344 Z"/>
                                </svg>
                            </div>
                            {{ Form::text('phone', $user->phone, ['placeholder' => 'Телефон', 'class' => 'cartAddress__inp', 'id' => 'phone']) }}
                            {{ Form::hidden('phone_mask', "", ['id' => 'phone_mask']) }}
                        </div>
                        <div id="helper-text-phone" style="color: #777; padding-top: 5px; text-align: center;"></div>
                    </div>

                    <div style="height: 75px;">
                        <div class="cartData__inp" style="width: 100%;">
                            <div class="cartAddress__icon">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="36px" height="36px">
                                    <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                                          d="M18.000,35.999 C8.059,35.999 -0.000,27.940 -0.000,17.999 C-0.000,8.058 8.059,-0.001 18.000,-0.001 C27.941,-0.001 36.000,8.058 36.000,17.999 C36.000,27.940 27.941,35.999 18.000,35.999 ZM27.475,13.172 C27.479,11.896 26.393,10.854 25.057,10.854 L10.092,10.854 C8.756,10.854 7.670,11.892 7.670,13.168 L7.670,22.938 C7.670,24.215 8.756,25.252 10.092,25.252 L25.053,25.252 C26.389,25.252 27.475,24.215 27.475,22.938 L27.475,13.172 ZM25.045,23.091 C24.934,23.201 24.791,23.255 24.644,23.255 C24.508,23.255 24.369,23.208 24.262,23.111 L19.337,18.640 L17.956,19.822 C17.853,19.912 17.718,19.960 17.587,19.960 C17.456,19.960 17.325,19.916 17.218,19.826 L15.874,18.679 L10.920,23.107 C10.813,23.201 10.678,23.248 10.543,23.248 C10.395,23.248 10.248,23.189 10.137,23.079 C9.928,22.864 9.940,22.531 10.162,22.332 L15.042,17.967 L10.141,13.782 C9.912,13.587 9.891,13.254 10.096,13.034 C10.301,12.815 10.649,12.796 10.879,12.991 L16.181,17.524 C16.214,17.548 16.243,17.572 16.272,17.599 C16.272,17.603 16.276,17.607 16.280,17.611 L17.583,18.722 L24.262,12.995 C24.492,12.800 24.840,12.820 25.045,13.034 C25.250,13.254 25.229,13.587 25.004,13.782 L20.160,17.932 L25.025,22.343 C25.246,22.543 25.254,22.879 25.045,23.091 Z"/>
                                </svg>
                            </div>
                            {{ Form::text('email', $user->email, ['placeholder' => 'Email', 'class' => 'cartAddress__inp']) }}
                        </div>
                    </div>
                </div>

                <div class="title" style="margin-bottom: 1rem;">
                    Адрес
                </div>
                <div class="cartAddress__row">
                    <div class="cartAddress__icon">
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="36px" height="36px">
                            <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                                  d="M18.000,35.999 C8.059,35.999 -0.000,27.941 -0.000,17.999 C-0.000,8.058 8.059,-0.001 18.000,-0.001 C27.941,-0.001 36.000,8.058 36.000,17.999 C36.000,27.941 27.941,35.999 18.000,35.999 ZM18.221,9.019 C13.839,9.019 10.272,12.541 10.272,16.869 C10.272,17.361 10.317,17.858 10.413,18.343 C10.417,18.371 10.434,18.458 10.467,18.605 C10.588,19.135 10.766,19.657 10.999,20.153 C11.856,22.144 13.739,25.203 17.872,28.479 C17.976,28.561 18.101,28.603 18.225,28.603 C18.350,28.603 18.475,28.561 18.579,28.479 C22.707,25.203 24.595,22.144 25.451,20.153 C25.684,19.657 25.863,19.139 25.984,18.605 C26.017,18.458 26.033,18.371 26.038,18.343 C26.129,17.858 26.179,17.361 26.179,16.869 C26.171,12.541 22.603,9.019 18.221,9.019 ZM18.221,20.831 C16.055,20.831 14.296,19.090 14.296,16.955 C14.296,14.820 16.059,13.079 18.221,13.079 C20.383,13.079 22.146,14.820 22.146,16.955 C22.146,19.090 20.387,20.831 18.221,20.831 Z"/>
                        </svg>
                    </div>
                    {{ Form::text('address', $user->address, ['placeholder' => 'Адрес', 'class' => 'cartAddress__inp', 'style' => 'max-width: 100%!important;']) }}

                </div>

                <div class="title" style="margin-bottom: 1rem;">
                    Способ доставки
                </div>
                <div class="cartAddress__row">
                    <div>
                        <div style="margin: 1rem 0;">
                            <label>
                                {{ Form::radio('delivery_service', $order::DELIVERY_WITH_CDEK) }} @lang('orders/delivery.services.' . $order::DELIVERY_WITH_CDEK)
                            </label>
                        </div>
                        <div style="margin: 1rem 0;">
                            <label>
                                {{ Form::radio('delivery_service', $order::DELIVERY_WITH_ENERGY) }} @lang('orders/delivery.services.' . $order::DELIVERY_WITH_ENERGY)
                            </label>
                        </div>
                        <div style="margin: 1rem 0;">
                            <label>
                                {{ Form::radio('delivery_service', $order::DELIVERY_WITH_COURIER) }} @lang('orders/delivery.services.' . $order::DELIVERY_WITH_COURIER)
                            </label>
                        </div>
                    </div>
                </div>

                <div class="title" style="margin-bottom: 1rem;">
                    Способ оплаты
                </div>
                <div class="cartAddress__row">
                    <div>
                        @foreach($paySystems as $paySystem)
                            <div style="margin: 1rem 0;">
                                <label>
                                    {{ Form::radio('pay_system', $paySystem->id) }} {{ $paySystem->title }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="cartBlock cartPay">
                <div class="cartPay__text">
                    Сумма итого:
                </div>
                <div class="cartPay__price">
                    {!! formatByCurrency(\Cart::getSubTotal(false), 2) !!}
                </div>
                <button class="cartPay__btn btn" type="submit">
                    <span>Оформить заказ</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="26px" height="9px">
                        <path fill-rule="evenodd" fill="rgb(51, 51, 51)" d="M21.871,3.499 L-0.000,3.499 L-0.000,5.499 L21.871,5.499 L19.742,7.500 L21.290,8.999 L26.000,4.499 L21.290,-0.001 L19.742,1.500 L21.871,3.499 Z"></path>
                    </svg>
                </button>
            </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection
