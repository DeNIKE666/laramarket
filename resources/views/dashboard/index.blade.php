@extends('layouts.admin')

@section('content')

    <div class="lcPageContentData">
        <div class="lcPageContentData__title">
            Личные данные
        </div>
        @include('dashboard.user.profile')
    </div>

@endsection
