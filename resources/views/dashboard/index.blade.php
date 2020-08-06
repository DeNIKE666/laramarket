@extends('layouts.admin')

@section('content')

        <div class="row">
            @include('dashboard.user.profile')
            @can('role-user', $user)
            @include('dashboard.user.edit_form')
            @endcan
        </div>

@endsection
