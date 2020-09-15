@php

/** @var \App\Models\Order $order */

/** @var \App\Models\PaymentOption $paySystem */

@endphp

@extends('layouts.app')
@section('breadcrumbs')
    {{ Breadcrumbs::render('page', 'Заказ') }}
@endsection
@section('content')

    @include('front.partials.breadcrumbs')
    <div class="block-cart">
        <div class="wrapper">
            <h1 class="title">Заказ #{{ $order->id }}</h1>

            @include(
                '__shared.pay-systems.' . $paySystem->slug,
                compact('order')
            )
        </div>
    </div>
@endsection
