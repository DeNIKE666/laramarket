@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Оформление заказа</h1>
                {{ Form::open(['route' =>  'placeOrder', 'method' => 'post', 'class' => 'forms-sample']) }}
                <div class="form-group">
                    <label>Имя</label>
                    {{ Form::text('name', Auth::user()->name, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <label>Телефон</label>
                    {{ Form::text('phones', Auth::user()->phone, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <label>Email</label>
                    {{ Form::email('email', Auth::user()->email, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <label>Адрес</label>
                    {{ Form::text('address', Auth::user()->address, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <label>Комментарийс</label>
                    {{ Form::textarea('notes', '', ['class' => 'form-control']) }}
                </div>

                <h3>Способ оплаты</h3>
                <div><label>{{ Form::radio('payment_method', '1') }} Viza</label></div>
                <div><label>{{ Form::radio('payment_method', '2') }} Masterkart</label></div>
                <div><label>{{ Form::radio('payment_method', '3') }} Webmoney</label></div>

                <h3>Способ доставки</h3>
                <div><label>{{ Form::radio('delivery', '1') }} Cdek</label></div>
                <div><label>{{ Form::radio('delivery', '2') }} Почта</label></div>
                <div class="form-group">
                    <h3>Итого стоимость: {{ \Cart::getSubTotal() }}</h3>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
