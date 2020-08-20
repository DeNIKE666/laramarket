@extends('layouts.app')
@section('breadcrumbs')
    {{ Breadcrumbs::render('page', 'Авторизация') }}
@endsection
@section('content')

    <div class="wrapper">
        <form method="POST" class="form-center" action="{{ route('login') }}">
            @csrf
            <h1 class="form-center__title">Авторизация</h1>
            <div class="form-group">
                <input
                        id="email"
                        type="email"
                        class="popUp__inp @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        autofocus
                        placeholder="Email"
                >

                @error('email')
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                @enderror

            </div>
            <div class="form-group">

                <input id="password"
                       type="password"
                       class="popUp__inp @error('password') is-invalid @enderror"
                       name="password"
                       autocomplete="current-password"
                       placeholder="Пароль"
                >

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

            </div>
            <div class="mt-3">
                <button class="popUp__btn btn btn-center" type="submit">ВОЙТИ</button>
            </div>
            <div class="form-center__footer">
                <div class="form-check">

                    <label class="form-check-label text-muted" for="remember">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        {{ __('messages.Remember') }}
                    </label>

                </div>
                @if (Route::has('password.request'))
                    <a class="auth-link text-black" href="{{ route('password.request') }}">
                        {{ __('messages.Forgot_Password?') }}
                    </a>
                @endif

            </div>

            <div class="text-center mt-4 font-weight-light"> {{ __('messages.not_account?') }} <a href="/register" class="text-primary">{{ __('messages.create') }}</a>
            </div>
        </form>

    </div>



@endsection
