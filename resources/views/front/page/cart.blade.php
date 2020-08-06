@extends('layouts.app')

@section('content')
    @include('front.partials.breadcrumbs')
    <div class="block-cart">
        <div class="wrapper">
            <div class="title">
                Ваша корзина
            </div>
            <div class="cartBlock cartContent">
                @if(count($cartCollection) > 0)
                <div class="cartContentWrap">
                    @foreach(\Cart::getContent() as $item)
                    <div class="cartContent__item">
                        <div class="cartContent__img">
                            <img src="{{ $item->attributes->image }}" alt="">
                        </div>
                        <div class="cartContent__inf">
                            <div class="cartContent__name">
                                Видеокарта
                            </div>
                            <div class="cartContent__title">
                                {{$item->name}}
                            </div>
                        </div>
                        <div class="cartContent__nums">
                            <button>
                                -
                            </button>
                            <span>
                                    {{$item->quantity}}
                                </span>
                            <button>
                                +
                            </button>
                        </div>
                        <div class="cartContent__price">
                            {{ \Cart::get($item->id)->getPriceSum() }} рублей
                        </div>
                        <div class="cartContent__delete">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="30px" height="30px">
                                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
                                      d="M25.607,25.606 C19.759,31.454 10.242,31.455 4.393,25.606 C-1.455,19.757 -1.455,10.242 4.393,4.393 C10.242,-1.456 19.758,-1.456 25.607,4.393 C31.455,10.242 31.455,19.758 25.607,25.606 ZM23.963,6.036 C19.022,1.094 10.979,1.093 6.037,6.036 C1.094,10.979 1.095,19.021 6.037,23.963 C10.979,28.905 19.021,28.905 23.963,23.963 C28.906,19.020 28.905,10.978 23.963,6.036 ZM16.717,14.925 L20.003,18.212 C20.458,18.666 20.457,19.402 20.003,19.855 C19.550,20.309 18.815,20.309 18.360,19.855 L15.074,16.569 L11.788,19.855 C11.334,20.309 10.599,20.309 10.144,19.855 C9.690,19.401 9.691,18.665 10.144,18.212 L13.431,14.925 L10.144,11.639 C9.690,11.185 9.691,10.450 10.144,9.996 C10.598,9.542 11.333,9.542 11.788,9.996 L15.074,13.283 L18.360,9.996 C18.814,9.542 19.549,9.542 20.004,9.996 C20.458,10.450 20.457,11.186 20.003,11.639 L16.717,14.925 Z"/>
                            </svg>
                            <span>
                                    Удалить
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="cartSum">
                    <div class="cartPay__text">
                        Сумма итого:
                    </div>
                    <div class="cartPay__price">
                        {{ \Cart::getTotal() }} рублей
                    </div>
                    <div class="cartSum__inf">
                        Для оформления заказа необходимо
                        вторизоваться или зарегистрироваться
                    </div>
                    <a class="cartPay__btn btn">
                        <span>Оформить заказ</span>
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="26px" height="9px">
                            <path fill-rule="evenodd"  fill="rgb(51, 51, 51)"
                                  d="M21.871,3.499 L-0.000,3.499 L-0.000,5.499 L21.871,5.499 L19.742,7.500 L21.290,8.999 L26.000,4.499 L21.290,-0.001 L19.742,1.500 L21.871,3.499 Z"/>
                        </svg>
                    </a>
                </div>
                @else
                    Your Cart is Empty
                @endif
            </div>

        </div>
    </div>

@endsection