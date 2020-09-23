@php
    /** @var \Illuminate\Pagination\LengthAwarePaginator $cashbacks */
    /** @var \App\Models\Cashback $cashback */

    $periods = __('cashback/periods')
@endphp

@extends('layouts.admin')

@section('content')
    <div class="lcPageContentTitle">
        Кэшбэк
    </div>
    <div class="lcPageContentSort lcPageContentSort-cash">
        <div class="lcPageContentSort__item">
{{--            <span>--}}
{{--                Совершенно покупок на: <span>1 000 000 руб.</span>--}}
{{--            </span>--}}
        </div>
        <div class="lcPageContentSort__item">
{{--            <span>--}}
{{--                Выплачено кэшбэка: <span>1 000 000 руб.</span>--}}
{{--            </span>--}}
        </div>
        <button class="lcPageContentSort__btn btn">
            Архив выплат
        </button>
    </div>
    <div class="lcPageContentTable lcPageContentTable-cash">
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                № Заказа
            </div>
            <div class="lcPageContentCol">
                Начало
                начислений
            </div>
            <div class="lcPageContentCol">
                Сумма кэшбэка
            </div>
            <div class="lcPageContentCol">
                Период выплат
            </div>
            <div class="lcPageContentCol">
                Следующая
                выплата
            </div>
            <div class="lcPageContentCol">
                Остаток
            </div>
        </div>

        @foreach($cashbacks as $cashback)
            <div class="lcPageContentRow">
                <div class="lcPageContentCol">
                    {{ $cashback->order_id }}
                </div>
                <div class="lcPageContentCol">
                    {{ \Illuminate\Support\Carbon::parse($cashback->created_at)->format('d.m.Y H:i') }}
                </div>
                <div class="lcPageContentCol">
                    {!! formatByCurrency($cashback->cost, 2) !!}
                </div>
                <div class="lcPageContentCol">
                    {{ $periods[$cashback->period] }}
                </div>
                <div class="lcPageContentCol">
                    {{ \Illuminate\Support\Carbon::parse($cashback->nextCashbackPayout->payout_at)->format('d.m.Y H:i') }}
                </div>
                <div class="lcPageContentCol">
                    {!! formatByCurrency($cashback->cost - $cashback->was_paid, 2) !!}
                </div>
            </div>
        @endforeach
    </div>
@endsection