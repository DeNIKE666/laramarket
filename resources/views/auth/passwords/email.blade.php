@extends('layouts.app')

@section('content')

    <div class="wrapper">


        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-center" method="POST" action="{{ route('password.email') }}">
                @csrf
                <h1 class="form-center__title">Востановление пароля</h1>
                <div class="form-group row">
                    <input placeholder="email" id="email" type="email" class="popUp__inp @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>

                <button type="submit" class="popUp__btn btn btn-center">
                    Отправить
                </button>

            </form>

        </div>
@endsection
