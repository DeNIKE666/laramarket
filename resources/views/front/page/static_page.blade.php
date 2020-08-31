@extends('layouts.app')
@section('breadcrumbs')
    {{ Breadcrumbs::render('page_static', $page) }}
@endsection
@section('content')
    <div class="wrapper">
        <div class="offer offer-margin">
            <div class="offer__wrap">
                <h1 class="offer__title">{{ $page->name }}</h1>
                <div class="offer__text">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection