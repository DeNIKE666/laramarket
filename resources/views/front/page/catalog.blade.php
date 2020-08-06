@extends('layouts.app')

@section('content')
    @include('front.partials.breadcrumbs')

    <div class="block-catalog">
        <div class="wrapper">
            <div class="catalogTop">
                <h1 class="catalogTop__title">
                    {{ $category->title }}
                </h1>
                @include('front.partials.catalog_sort')

                <div class="catalogTop__sum">
                    1946 товаров
                </div>
            </div>
            <div class="catalog">
                @include('front.partials.catalog_filter')
                <div class="catalogContentWrap">
                    <div class="catalogContent">
                        @if (count($products))

                                @foreach($products as $product)
                                    @include('front.partials.item_product', ['product' => $product])
                                @endforeach

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
