@php
    /** @var Illuminate\Pagination\LengthAwarePaginator $orders */
    /** @var \App\Models\Order $order */

    /** @var array $ordersStatus */
    $ordersStatus = __('orders/status');

@endphp

@extends('layouts.admin')

@push('styles')
    <link type="text/css" href="{{ asset('css/common.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script>
        const ordersStatus = @json(__('orders/status'));
    </script>

    <script src="{{ asset('js/helpers.js') }}"></script>
    <script src="{{ asset('js/dashboard/seller/orders/changeStatus.js') }}"></script>
@endpush

@section('content')
    <div id="popup-changeOrderStatus" class="popUp popUp-pay">
        <div class="popUp__content" style="justify-content: start; height: fit-content;">
            <div class="popUp__title">
                Статус заказа
            </div>
            <div class="popUp__body" style="width: 100%;"></div>
        </div>
        <div class="popUp__layer"></div>
    </div>

    <div class="lcPageContentTitle" style="display: block;">
        Мои продажи
    </div>

    @include('dashboard.seller.orders.__partials.top_links_types_history')

    <div class="row">
        <div class="lcPageContentTable lcPageContentTable-products">
            <div class="lcPageContentRow">
                <div class="lcPageContentCol">
                    Заказ
                </div>
                <div class="lcPageContentCol" style="width: 150px;">
                    Дата заказа
                </div>
                <div class="lcPageContentCol" style="width: 150px;">
                    Сумма
                </div>
                <div class="lcPageContentCol">
                    Статус
                </div>
                <div class="lcPageContentCol" style="width: 150px;">
                    Дата окончания холда
                </div>
                <div class="lcPageContentCol">
                    Действие
                </div>
            </div>

            @foreach($orders as $order)
                <div class="lcPageContentRow">
                    <div class="lcPageContentCol">
                        {{ $order->id }}
                    </div>
                    <div class="lcPageContentCol" style="width: 150px;">
                        {{ \Illuminate\Support\Carbon::parse($order->created_at)->format('d.m.Y H:i') }}
                    </div>
                    <div class="lcPageContentCol" style="width: 150px;">
                        {!! formatByCurrency($order->cost, 2) !!}
                    </div>
                    <div class="lcPageContentCol">
                        {{ $ordersStatus[$order->status] }}
                    </div>
                    <div class="lcPageContentCol" style="width: 150px;">
                        @if($order->orderHold)
                            {{ \Illuminate\Support\Carbon::parse($order->orderHold->expired_at)->format('d.m.Y H:i') }}
                        @endif
                    </div>
                    <div class="lcPageContentCol">
                        <div class="lcPageContentCol__more">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17px" height="5px">
                                <path fill-rule="evenodd" fill="rgb(255, 255, 255)"
                                      d="M14.250,4.219 C13.232,4.219 12.406,3.393 12.406,2.375 C12.406,1.357 13.232,0.531 14.250,0.531 C15.268,0.531 16.094,1.357 16.094,2.375 C16.094,3.393 15.268,4.219 14.250,4.219 ZM8.375,4.219 C7.357,4.219 6.531,3.393 6.531,2.375 C6.531,1.357 7.357,0.531 8.375,0.531 C9.393,0.531 10.219,1.357 10.219,2.375 C10.219,3.393 9.393,4.219 8.375,4.219 ZM2.469,4.219 C1.450,4.219 0.625,3.393 0.625,2.375 C0.625,1.357 1.450,0.531 2.469,0.531 C3.487,0.531 4.312,1.357 4.312,2.375 C4.312,3.393 3.487,4.219 2.469,4.219 Z"
                                />
                            </svg>
                            <div class="lcPageContentCol__drop">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px">
                                        <path fill-rule="evenodd" fill="rgb(174, 174, 180)"
                                              d="M15.013,3.923 L14.346,4.590 L11.233,1.478 L11.900,0.810 C12.196,0.514 12.641,0.514 12.938,0.810 L15.013,2.886 C15.309,3.182 15.309,3.627 15.013,3.923 ZM6.080,12.896 L2.935,9.751 L10.168,2.519 L13.312,5.663 L6.080,12.896 ZM0.412,15.412 L1.894,10.816 L5.007,13.929 L0.412,15.412 Z"
                                        />
                                   </svg>
                                   <a class="order-changeDetails" data-id="{{ $order->id }}" href="#">
                                        Детали заказа
                                   </a>
                                </span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px">
                                        <path fill-rule="evenodd" fill="rgb(174, 174, 180)"
                                              d="M15.013,3.923 L14.346,4.590 L11.233,1.478 L11.900,0.810 C12.196,0.514 12.641,0.514 12.938,0.810 L15.013,2.886 C15.309,3.182 15.309,3.627 15.013,3.923 ZM6.080,12.896 L2.935,9.751 L10.168,2.519 L13.312,5.663 L6.080,12.896 ZM0.412,15.412 L1.894,10.816 L5.007,13.929 L0.412,15.412 Z"
                                        />
                                   </svg>
                                   <a class="order-changeStatus" data-id="{{ $order->id }}" data-status="{{ $order->status }}" href="#">
                                        Изменить статус
                                   </a>
                                </span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px">
                                        <path fill-rule="evenodd" fill="rgb(174, 174, 180)"
                                              d="M15.013,3.923 L14.346,4.590 L11.233,1.478 L11.900,0.810 C12.196,0.514 12.641,0.514 12.938,0.810 L15.013,2.886 C15.309,3.182 15.309,3.627 15.013,3.923 ZM6.080,12.896 L2.935,9.751 L10.168,2.519 L13.312,5.663 L6.080,12.896 ZM0.412,15.412 L1.894,10.816 L5.007,13.929 L0.412,15.412 Z"
                                        />
                                   </svg>
                                   <a class="order-statusHistory" data-id="{{ $order->id }}" href="#">
                                        История заказа
                                   </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection