@extends('layouts.app')

@section('content')
    @include('front.partials.breadcrumbs')
    <div class="wrapper">

        <form method="POST" class="form-center" action="{{ route('password.update') }}">
            @csrf
            <h1 class="form-center__title">Востановление пароля</h1>
            <input type="hidden" name="token" value="{{ $token }}">

            <
            <input placeholder="уьфшд" id="email" type="email" class="popUp__inp @error('email') is-invalid @enderror"
                   name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm"
                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                           required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="popUp__btn btn btn-center">
                        Отправить
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
