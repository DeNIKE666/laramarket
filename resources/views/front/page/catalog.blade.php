@php
    /** @var array $catalog */

    /** @var \App\Models\Category $category */
    $category = $catalog['category'];

    /** @var \App\Models\Product $products */
    $products = $catalog['products'];

    $minPrice = $catalog['minPrice'];
    $maxPrice = $catalog['maxPrice'];

    /** @var \Illuminate\Support\Collection $catFilter */
    $catFilter = $catalog['catFilter'];
@endphp

@extends('layouts.app')
@section('breadcrumbs')
    {{ Breadcrumbs::render('front_catalog', $category) }}
@endsection
@section('content')

    <div class="block-catalog">
        <div class="wrapper">
            <div class="catalogTop">
                <h1 class="catalogTop__title">
                    {{ $category->title }}
                </h1>

                @include('front.partials.catalog_sort')

                <div class="catalogTop__sum">
                    {{ $products->total() }} товаров
                </div>
            </div>

            <div class="catalog">
                @include('front.partials.catalog_filter')

                <div class="catalogContentWrap">
                    <div class="catalogContent">
                        @each('front.partials.item_product', $products, 'product')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pagination.default', ['paginator' => $products->withQueryString()])

@endsection
