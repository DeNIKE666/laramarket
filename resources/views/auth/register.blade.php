@extends('layouts.admin')

@section('content')

    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <h4>{{ __('messages.register') }}</h4>

                        <form class="pt-3" method="POST" action="{{ route('register') }}">
                            @csrf

                            {{ Form::hidden('referral', $referral) }}

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
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
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

                                <input
                                    id="password"
                                    type="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
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
                                    class="form-control"
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
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                    {{ __('messages.register') }}
                                </button>
                            </div>
                            <div class="text-center mt-4 font-weight-light"> {{ __('messages.yes_account?') }} <a href="/login/"
                                                                                                         class="text-primary">{{ __('messages.login') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
