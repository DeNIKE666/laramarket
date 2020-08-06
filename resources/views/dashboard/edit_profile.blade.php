@extends('layouts.admin')

@section('content')

    <div class="lcPageContentData">
        <div class="lcPageContentTitle">
            История заказов
        </div>
        <div class="lcPageContentData__title">
            Личные данные
        </div>
        @include('dashboard.user.profile')

        @can('role-shop', $user)
            @include('dashboard.user.shop_date')
        @endcan
    </div>

@endsection
