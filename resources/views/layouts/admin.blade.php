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
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
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
                    @include('layouts.partials.front.alert')
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
<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('/js/admin.js') }}"></script>
<script src="{{ asset('js/dashboard/partnerLink.js') }}"></script>
</body>
</html>
