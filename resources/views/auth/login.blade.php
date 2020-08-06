@extends('layouts.admin')

@section('content')
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <h4>{{ __('messages.hello_login') }}</h4>
                        <h6 class="font-weight-light">{{ __('messages.desc_login') }}</h6>

                        <form method="POST" class="pt-3" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
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
                                       class="form-control form-control-lg @error('password') is-invalid @enderror"
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
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">ВОЙТИ</button>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
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
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
@endsection
