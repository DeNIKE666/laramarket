@extends('layouts.app')

@section('content')

    @include('front.partials.breadcrumbs')
    <div class="block-cart">
        <div class="wrapper">
            <h1 class="title">Заказ #{{ $order->id }}</h1>

            @include('__shared.pay-method.' . $payment, [
               'order' => $order
            ])

        </div>
    </div>



@endsection
