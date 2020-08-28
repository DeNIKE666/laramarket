@extends('layouts.admin')

@section('content')

    <div class="lcPageContentTable">
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                № Заявки
            </div>
            <div class="lcPageContentCol">
                Дата заказа
            </div>
            <div class="lcPageContentCol">
                Сумма вывода
            </div>
            <div class="lcPageContentCol">
                Платёжная система
            </div>
            <div class="lcPageContentCol">
                Статус
            </div>
        </div>

        @foreach($withdraws as $withdraw)
            <div class="lcPageContentRow">
                <div class="lcPageContentCol">
                    {{ $withdraw->id }}
                </div>

                <div class="lcPageContentCol">
                    {{ $withdraw->created_at }}
                </div>

                <div class="lcPageContentCol">
                    {{ $withdraw->amount }} руб.
                </div>

                <div class="lcPageContentCol">
                    {{ $withdraw->paymentOption->title }}
                </div>

                <div class="lcPageContentCol">
                    @if ($withdraw->status == 0)
                        В процессе
                    @elseif($order->status == 1)
                        Средства отправлены
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection