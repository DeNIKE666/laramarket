<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    @stack('styles')


</head>
<body>

@include('layouts.partials.front.header')

<main>
    <div class="block-lcPage">
        <div class="wrapper">
            <div class="lcPage">
                @include('dashboard.partials.cabinet_left_nav')
                <div class="lcPageContent">
                    @include('dashboard.partials.cabinet_top_nav')
                    @if($errors->any())
                        <div class="alert-danger alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts.partials.front.footer')


@include('layouts.partials.front.auth')
@include('layouts.partials.front.register')

@include('layouts.partials.js_footer__front')

@stack('scripts')
</body>
</html>
