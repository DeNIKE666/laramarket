@extends('layouts.admin')

@section('content')
    <div class="lcPageContentData">
        <div class="lcPageContentData__title">
            Данные пользователя
        </div>
        <br>
        <br>
        @if($user->name != '')
            <p><b>ФИО </b>{{ $user->name }}</p>
        @endif
        <p><b>Email </b>{{ $user->email }}</p>
        <p><b>Роль </b>{{ $user->getNameRole() }}</p>
        <p><b>Партнер </b>
            @if($user->is_partner == 1)
                Да
            @else
                Нет
            @endif
        </p>

        @if($user->request_shop == 1 && $user->role == \App\Models\User::ROLE_USER && $user->property)
            <div class="lcPageContentData__title">
                Заявка для продавца
            </div>
            @switch($user->property->type_shop)
                @case(\App\Models\User::TYPE1)
                @include('dashboard.admin.block.seller_type1')
                @break
                @case(\App\Models\User::TYPE2)
                @include('dashboard.admin.block.seller_type2')
                @break
                @case(\App\Models\User::TYPE3)
                @include('dashboard.admin.block.seller_type3')
                @break
            @endswitch
            {{ Form::open(['route' => ['admin.approved_seller'], 'method' => 'put', 'class' => 'forms-sample']) }}
            {{ Form::hidden('user_id', $user->id) }}
            <button type="submit" class="btn btn-primary">Разрешить</button>
            {{ Form::close() }}

        @endif
    </div>


@endsection
