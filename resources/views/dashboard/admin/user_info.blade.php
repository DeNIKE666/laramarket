@php
    /** @var \App\Models\User $user */
@endphp

@extends('layouts.admin')

@section('content')
    <div class="lcPageContentData">
        <div class="lcPageContentData__title" style="margin-bottom: 2rem;">
            Данные пользователя
        </div>

        <div>
            <p>
                <strong style="font-weight: bold;">ФИО</strong>
                {{ getName($user) }}
            </p>
            <p>
                <strong style="font-weight: bold;">Email</strong>
                {{ $user->email }}
            </p>
            <p>
                <strong style="font-weight: bold;">Роль</strong>
                @lang('users/roles.' . $user->role)
            </p>
            <p>
                <strong style="font-weight: bold;">Партнер</strong>
                @if($user->isPartner())
                    @lang('users/partner.is_partner')
                @else
                    @lang('users/partner.is_not_partner')
                @endif
            </p>
        </div>


        @if($user->hasSellerRequest() && $user->isBuyer() && $user->property)
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
            {{ Form::open(['route' => ['admin.approve-as-seller'], 'method' => 'put', 'class' => 'forms-sample']) }}
            {{ Form::hidden('user_id', $user->id) }}
            <button type="submit" class="btn btn-primary">Разрешить</button>
            {{ Form::close() }}

        @endif
    </div>
@endsection
