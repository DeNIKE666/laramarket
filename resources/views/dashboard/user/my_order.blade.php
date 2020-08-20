@extends('layouts.admin')

@section('content')

    <div class="lcPageContentTable">
        <div class="lcPageContentRow">
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
        </div>

        @foreach($orders as $order)
            <div class="lcPageContentRow">
                <div class="lcPageContentCol">
                    {{ $order->id }}
                </div>

                <div class="lcPageContentCol">
                    {{ $order->created_at }}
                </div>

                <div class="lcPageContentCol">
                    {{ $order->cost }} руб.
                </div>

                <div class="lcPageContentCol">
                    @if ($order->status == 'pending')
                        Не оплачен
                    @elseif($order->status == 'PAID')
                        Принят в обработку
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection