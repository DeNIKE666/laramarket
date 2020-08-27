@php
    /** @var \App\Models\Order $order */

    $Order = new \App\Models\Order();
    $Cashback = new \App\Models\Cashback();
@endphp

@extends('layouts.admin')

@push('styles')
    <link type="text/css" href="{{ asset('css/common.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/dashboard/buyer/orders/changeStatus.js') }}"></script>
@endpush

@section('content')
    <div id="popup-changeOrderStatus" class="popUp popUp-pay">
        <div class="popUp__content" style="justify-content: start; height: fit-content;">
            <div class="popUp__title"></div>
            <div class="popUp__body" style="width: 100%;">
                <div class="error" id="order_commonError" style="display: none; padding: 0 0 1rem 0; text-align: center;"></div>

                <div id="statusConfirm">
                    <div class="cardform__row">
                        <div class="cardform__row__col1">
                            <p style="text-align: center;"></p>
                        </div>
                    </div>
                    <div class="cardform__row" style="margin-top: 20px;">
                        <button type="button" class="btn lcPageMenu__btn" id="statusConfirm_button">
                            @lang('orders/actions.confirm')
                        </button>
                    </div>
                </div>

                <div id="selectPayoutPeriod" style="display: none;">
                    {{-- ПЕРЕДЕЛАТЬ --}}
                    <div class="cardform__row">
                        <button type="button" class="selectPayoutPeriod btn lcPageMenu__btn" data-period="{{ $Cashback::PERIOD_EVERY_MONTH }}">
                            @lang('cashback/periods.' . $Cashback::PERIOD_EVERY_MONTH)
                        </button>
                    </div>
                    <div class="cardform__row" style="margin-top: 20px;">
                        <button type="button" class="selectPayoutPeriod btn lcPageMenu__btn" data-period="{{ $Cashback::PERIOD_EVERY_3_MONTHS }}">
                            @lang('cashback/periods.' . $Cashback::PERIOD_EVERY_3_MONTHS)
                        </button>
                    </div>
                    <div class="cardform__row" style="margin-top: 20px;">
                        <button type="button" class="selectPayoutPeriod btn lcPageMenu__btn" data-period="{{ $Cashback::PERIOD_EVERY_6_MONTHS }}">
                            @lang('cashback/periods.' . $Cashback::PERIOD_EVERY_6_MONTHS)
                        </button>
                    </div>
                    <div class="cardform__row" style="margin-top: 20px;">
                        <button type="button" class="selectPayoutPeriod btn lcPageMenu__btn" data-period="{{ $Cashback::PERIOD_SINGLE }}">
                            @lang('cashback/periods.' . $Cashback::PERIOD_SINGLE)
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="popUp__layer"></div>
    </div>

    <div class="lcPageContentTable">
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                №
            </div>
            <div class="lcPageContentCol">
                № Заказа
            </div>
            <div class="lcPageContentCol">
                Дата заказа
            </div>
            <div class="lcPageContentCol">
                Сумма заказа
            </div>
            <div class="lcPageContentCol">
                Статус заказа
            </div>
            <div class="lcPageContentCol">
                Действия
            </div>
        </div>

        @foreach($orders as $order)
            <div class="lcPageContentRow">
                <div class="lcPageContentCol">
                    {{ $loop->iteration }}
                </div>

                <div class="lcPageContentCol">
                    {{ $order->id }}
                </div>

                <div class="lcPageContentCol">
                    {{ \Illuminate\Support\Carbon::parse($order->created_at)->format('d.m.Y H:i') }}
                </div>

                <div class="lcPageContentCol">
                    {{ $order->cost }} &#8381;
                </div>

                <div class="lcPageContentCol">
                    @lang('orders/status.' . $order->status)
                </div>

                <div class="lcPageContentCol">
                    {{-- ПЕРЕДЕЛАТЬ --}}
                    @switch($order->status)
                        {{-- Новый --}}
                        @case($Order::STATUS_ORDER_NEW)
                        <button type="button" data-id="{{ $order->id }}" data-status="{{ $Order::STATUS_ORDER_CANCELED_BY_BUYER }}" class="order-changeStatus btn lcPageMenu__btn" style="margin-bottom: 0;">
                            @lang('orders/actions.cancel')
                        </button>
                        @break

                        {{-- Оплачен --}}
                        @case($Order::STATUS_ORDER_PAYED)
                        <button type="button" data-id="{{ $order->id }}" data-status="{{ $Order::STATUS_ORDER_CANCELED_BY_BUYER }}" class="order-changeStatus btn lcPageMenu__btn" style="margin-bottom: 0;">
                            @lang('orders/actions.cancel')
                        </button>
                        @break

                        {{-- Отправлен --}}
                        @case($Order::STATUS_ORDER_SENT)
                        <button type="button" data-id="{{ $order->id }}" data-status="{{ $Order::STATUS_ORDER_RECEIVED }}" class="order-changeStatus btn lcPageMenu__btn" style="margin-bottom: 0;">
                            @lang('orders/actions.received')
                        </button>
                        @break
                    @endswitch
                </div>
            </div>
        @endforeach
    </div>
@endsection