<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    @yield('breadcrumbs')
    @include('layouts.partials.front.alert')
    @yield('content')
</main>
@include('layouts.partials.front.footer')

@include('layouts.partials.front.auth')
@include('layouts.partials.front.register')

@include('layouts.partials.js_footer__front')
</body>
</html>
