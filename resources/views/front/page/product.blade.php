@extends('layouts.app')
@section('breadcrumbs')
    {{ Breadcrumbs::render('front_product', $product) }}
@endsection
@section('content')

    <div class="block-8">
        <div class="wrapper">
            <div class="product">
                <div class="productSliderWrap">
                    <div class="productSlider owl-carousel owl-theme">
                        <div class="productSlide">
                            {!! $product->getImage() !!}
                        </div>
                    </div>
                </div>
                <div class="product__left">
                    <div class="productImg">
                        @if($product->group_product === \App\Models\Product::TYPE_PRODUCT_INFO)
                            <span>
                                Цифровой товар
                            </span>
                        @endif
                        {!! $product->getImage() !!}
                    </div>
                    <div class="productNav">
                        <div class="productNav__item productNav__item-active">
                            {!! $product->getImage('thumb') !!}
                        </div>

                    </div>
                </div>
                <div class="product__right">
                    <div class="product__user">
                        <img src="{{ asset('img/photos/18.png') }}" alt="">
                        <span>{{ getName($product->author)  }}</span>
                    </div>
                    <h1 class="product__title">
                        {{ $product->title }}
                    </h1>
                    <div class="product__infs">
                        @foreach ($arDataProductAttr as $attr)
                            @if ($loop->index > 5)
                                @break
                            @endif
                                <div class="product__inf">
                                    <span>{{ $attr['name'] }}</span>
                                    <span></span>
                                    <span>{{ $attr['value'] }}</span>
                                </div>
                        @endforeach

                    </div>
                    <div class="product__btns">
                        <div class="product__set">
                            <div class="product__icon">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="18px" height="16px">
                                    <path fill-rule="evenodd"  fill="rgb(151, 151, 151)"
                                          d="M4.061,2.178 L4.061,0.492 L2.689,0.492 L2.689,2.204 C1.531,2.524 0.680,3.578 0.680,4.832 C0.680,6.085 1.531,7.139 2.689,7.460 L2.689,15.053 L4.061,15.053 L4.061,7.485 C5.270,7.199 6.170,6.121 6.170,4.832 C6.170,3.542 5.270,2.464 4.061,2.178 ZM3.425,6.197 C2.668,6.197 2.053,5.585 2.053,4.832 C2.053,4.079 2.668,3.467 3.425,3.467 C4.182,3.467 4.798,4.079 4.798,4.832 C4.798,5.585 4.182,6.197 3.425,6.197 ZM9.909,7.926 L9.909,0.492 L8.536,0.492 L8.536,7.902 C7.329,8.189 6.430,9.266 6.430,10.555 C6.430,11.844 7.329,12.921 8.536,13.208 L8.536,15.053 L9.909,15.053 L9.909,13.184 C11.068,12.864 11.920,11.810 11.920,10.555 C11.920,9.301 11.068,8.246 9.909,7.926 ZM9.175,11.920 C8.418,11.920 7.803,11.308 7.803,10.555 C7.803,9.802 8.418,9.190 9.175,9.190 C9.932,9.190 10.547,9.802 10.547,10.555 C10.547,11.308 9.932,11.920 9.175,11.920 ZM15.756,4.870 L15.756,0.492 L14.384,0.492 L14.384,4.799 C13.131,5.052 12.187,6.154 12.187,7.474 C12.187,8.796 13.131,9.897 14.384,10.150 L14.384,15.053 L15.756,15.053 L15.756,10.079 C16.870,9.731 17.678,8.697 17.678,7.474 C17.678,6.252 16.870,5.218 15.756,4.870 ZM14.932,8.840 C14.176,8.840 13.560,8.227 13.560,7.474 C13.560,6.722 14.176,6.110 14.932,6.110 C15.689,6.110 16.305,6.722 16.305,7.474 C16.305,8.227 15.689,8.840 14.932,8.840 Z"/>
                                </svg>
                            </div>
                            <span>
                                    К сравнению
                                </span>
                        </div>
                        <div class="product__set">
                            <div class="product__icon">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="19px" height="15px">
                                    <path fill-rule="evenodd"  fill="rgb(157, 157, 157)"
                                          d="M14.160,1.786 C14.777,1.786 15.396,2.005 15.815,2.371 L15.828,2.383 L15.841,2.393 C16.764,3.164 17.121,4.217 16.902,5.523 C16.698,6.744 14.639,8.489 12.648,10.178 C11.649,11.025 10.625,11.892 9.652,12.825 C8.678,11.892 7.654,11.025 6.655,10.178 C4.664,8.489 2.605,6.744 2.401,5.523 C2.183,4.217 2.540,3.164 3.462,2.393 L3.475,2.383 L3.488,2.371 C3.907,2.005 4.526,1.786 5.143,1.786 C6.319,1.786 7.460,2.547 8.442,3.986 L9.652,5.760 L10.862,3.986 C11.843,2.547 12.984,1.786 14.160,1.786 M14.160,0.329 C12.746,0.329 11.096,1.049 9.652,3.168 C8.207,1.049 6.557,0.329 5.143,0.329 C4.070,0.329 3.132,0.744 2.523,1.277 C1.206,2.376 0.652,3.931 0.958,5.763 C1.414,8.486 6.267,11.291 9.652,14.895 C13.036,11.291 17.889,8.486 18.345,5.763 C18.651,3.931 18.097,2.376 16.780,1.277 C16.171,0.744 15.233,0.329 14.160,0.329 L14.160,0.329 Z"/>
                                </svg>
                            </div>
                            <span>
                                    В избранное
                                </span>
                        </div>
                    </div>
                    <div class="product__content">
                        <div class="product__price">
                            {{ $product->getCost() }}
                        </div>
                        @if($product->old_price != '')
                            <div class="product__old">
                                {{ $product->old_price }} руб
                            </div>
                        @endif
                        <form action="{{ route('cart.store') }}" method="POST" class="js_add_product">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $product->id }}"  name="id">
                            <input type="hidden" value="{{ $product->title }}"  name="name">
                            <input type="hidden" value="{{ $product->price }}"  name="price">
                            <input type="hidden" value="{{ $product->getImageSrc() }}"  name="img">
                            <input type="hidden" value="{{ $product->getUrl() }}"  name="slug">
                            <input type="hidden" value="1"  name="quantity">
                            <button class="product__btn btn" type="submit">
                                Добавить в корзину
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block-7">
        <div class="wrapper">
            <div class="productChar">
                <div class="productChar__menu">
                    <div class="productChar__item productChar__item-active">
                        <span>Описание товара</span>
                        <span>Описание</span>
                    </div>
                    <div class="productChar__item">
                        <span>Технические характеристики</span>
                        <span>Характеристики</span>
                    </div>
                </div>
                <div class="productChar__line">
                    <span></span>
                </div>
                <div class="productChar__text productChar__text-show">
                    {!! $product->content !!}
                </div>
                <div class="productChar__text">
                    @foreach ($arDataProductAttr as $attr)
                        <div class="product__inf">
                            <span>{{ $attr['name'] }}</span>
                            <span></span>
                            <span>{{ $attr['value'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if($products_views)
        <div class="block-5">
            <div class="wrapper">
                <div class="title">
                    Вы недавно смотрели
                </div>
                <div class="populars">
                    @foreach($products_views as $product)
                        @include('front.partials.item_product', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </div>
    @endif

@endsection
