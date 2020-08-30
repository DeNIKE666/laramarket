@extends('layouts.app')
@section('breadcrumbs')
    {{ Breadcrumbs::render('page', 'Регистрация') }}
@endsection
@section('content')

    <div class="wrapper">


        <form class="form-center" method="POST" action="{{ route('register') }}">
            @csrf
            <h1 class="form-center__title">{{ __('messages.register') }}</h1>

        <!--div class="form-group">

                                <input id="name"
                                       type="text"
                                       class="form-control form-control-lg @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}"
                                       required
                                       autocomplete="name"
                                       autofocus
                                       placeholder="{{ __('Name') }}"
                                >

                                @error('name')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div-->

            <div class="form-group">

                <input
                        id="email"
                        type="email"
                        class="popUp__inp @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        placeholder="Email"
                >

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>
            <div class="form-group">

                <input type="tel"
                   class="popUp__inp"
                   placeholder="Телефон"
                   name="phone"
                   value="{{ old('phone') }}"
                   required

                >
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">

                <input
                        id="password"
                        type="password"
                        class="popUp__inp @error('password') is-invalid @enderror"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="{{ __('messages.password') }}"
                >

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>

            <div class="form-group">
                <input
                        id="password-confirm"
                        type="password"
                        class="popUp__inp"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="{{ __('messages.confirm_password') }}"
                >
            </div>

            <!--div class="mb-4">
                <div class="form-check">
                    <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> I agree to all Terms &
                        Conditions </label>
                </div>
            </div-->
            <div class="mt-3">
                <button type="submit"
                        class="popUp__btn btn btn-center">
                    {{ __('messages.register') }}
                </button>
            </div>
            <div class="form-center__footer">
                {{ __('messages.yes_account?') }}
                <a href="/login/" class="text-primary">{{ __('messages.login') }}</a>
            </div>
        </form>
    </div>

@endsection
