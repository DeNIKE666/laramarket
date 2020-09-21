@extends('layouts.admin')

@section('content')
    <div class="userReg">
        @if($user->property)
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
        @endif
    </div>
@endsection