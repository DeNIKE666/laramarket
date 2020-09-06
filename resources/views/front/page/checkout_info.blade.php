@extends('layouts.app')
@section('breadcrumbs')
    {{ Breadcrumbs::render('page', 'Заказ') }}
@endsection
@section('content')

    @include('front.partials.breadcrumbs')
    <div class="block-cart">
        <div class="wrapper">
            <h1 class="title">Заказ #{{ $orderItem->id }}</h1>

            @include('__shared.pay-method.' . $payment, [
               'order' => $orderItem
            ])

        </div>
    </div>



@endsection
