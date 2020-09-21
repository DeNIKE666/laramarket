@extends('layouts.admin')

@section('content')

    @include('dashboard.seller.product.block.content_top')
    @include('dashboard.seller.product.block.filter')

    <div class="lcPageContentTable lcPageContentTable-products">
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                <img src="{{ asset('img/icons/check.png') }}" alt="">
            </div>
            <div class="lcPageContentCol">
                Изображение
            </div>
            <div class="lcPageContentCol">
                Название товара
            </div>
            <div class="lcPageContentCol">
                Цена товара
            </div>
            <div class="lcPageContentCol">
                Комиссия
            </div>
            <div class="lcPageContentCol">
                Статус товара
            </div>
            <div class="lcPageContentCol">
                Действие
            </div>
        </div>
        @each('dashboard.seller.product.block.item_product', $products, 'product')
    </div>

@endsection
