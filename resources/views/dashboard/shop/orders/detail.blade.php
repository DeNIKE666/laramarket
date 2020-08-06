@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Заказ №{{ $order->id }}</h2>

                    <p><b>ФИО</b> {{ $order->name }}</p>
                    <p><b>Адрес доставки</b> {{ $order->address }}</p>
                    <p><b>Телефон</b> {{ $order->phones }}</p>
                    <p><b>Доставка</b> {{ $order->delivery }}</p>
                    <p><b>Статус</b> {{ $order->status }}</p>
                    @if($order->notes != '')
                        <p><b>Примечание</b> {{ $order->notes }}</p>
                    @endif
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Название</th>
                            <th>Количество</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                            <th>Дата доставки</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order_items as $item)
                            <tr>
                                <td>
                                    {{ $item->product->id }}
                                </td>
                                <td>
                                    {{ $item->product->title }}
                                </td>
                                <td>
                                    {{ $item->quantity }}
                                </td>
                                <td>
                                    {{ $item->getCost() }}
                                </td>
                                <td>
                                    {{ $item->status }}
                                </td>
                                <td>
                                    {{ $item->delivery_date }}
                                </td>
                                <td>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
