@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Данные пользователя</h4>
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

                </div>
            </div>
        </div>

        @if($user->request_shop == 1 && $user->role == \App\Models\User::ROLE_USER && $user->property)
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Заявка для продавца</h4>
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
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
