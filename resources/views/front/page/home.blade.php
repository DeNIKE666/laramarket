@extends('layouts.app')

@section('content')

    <div class="block-1">
        <div class="wrapper">
            <div class="offer">
                <div class="offer__left">
                    <div class="offer__title">
                        <span>
                            Совершайте любые покупки
                            и получайте 100% кэшбэка!
                        </span>
                        <span></span>
                    </div>
                    <div class="offer__text">
                        <p>
                            Первый и единственный сервис в мире
                        </p>
                        <p>
                            Кэшбэк реальными деньгами на вашу карту
                        </p>
                    </div>
                    <button class="offer__btn btn">
                        <span>Подробнее</span>
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="26px" height="9px">
                            <path fill-rule="evenodd" fill="rgb(51, 51, 51)"
                                  d="M21.871,3.499 L-0.000,3.499 L-0.000,5.499 L21.871,5.499 L19.742,7.500 L21.290,8.999 L26.000,4.499 L21.290,-0.001 L19.742,1.500 L21.871,3.499 Z"/>
                        </svg>
                    </button>
                </div>
                <div class="offer__right">
                    <picture>
                        <source media="(max-width:768px)" srcset="img/photos/1-xs.png">
                        <img src="img/photos/1.png" alt="">
                    </picture>
                </div>
            </div>
        </div>
    </div>
    <div class="block-2">
        <div class="wrapper">
            <div class="title">
                Популярные категорий
            </div>
            <div class="cats">
                <div class="cat">
                    <div class="cat__content">
                        <div class="cat__title">
                            Цифровые товары
                        </div>
                        <div class="cat__text">

                        </div>
                        <button class="cat__btn btn">
                            <span>Подробнее</span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="26px" height="9px">
                                <path fill-rule="evenodd" fill="rgb(51, 51, 51)"
                                      d="M21.871,3.499 L-0.000,3.499 L-0.000,5.499 L21.871,5.499 L19.742,7.500 L21.290,8.999 L26.000,4.499 L21.290,-0.001 L19.742,1.500 L21.871,3.499 Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="cat__img">
                        <img src="img/photos/2.png" alt="">
                    </div>
                </div>
                <div class="cat">
                    <div class="cat__content">
                        <div class="cat__title">
                            Инфо услуги
                        </div>
                        <div class="cat__text">

                        </div>
                        <button class="cat__btn btn">
                            <span>Подробнее</span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="26px" height="9px">
                                <path fill-rule="evenodd" fill="rgb(51, 51, 51)"
                                      d="M21.871,3.499 L-0.000,3.499 L-0.000,5.499 L21.871,5.499 L19.742,7.500 L21.290,8.999 L26.000,4.499 L21.290,-0.001 L19.742,1.500 L21.871,3.499 Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="cat__img">
                        <img src="img/photos/3.png" alt="">
                    </div>
                </div>
                <div class="cat">
                    <div class="cat__content">
                        <div class="cat__title">
                            Потребительские товары
                        </div>
                        <div class="cat__text">

                        </div>
                        <button class="cat__btn btn">
                            <span>Подробнее</span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="26px" height="9px">
                                <path fill-rule="evenodd" fill="rgb(51, 51, 51)"
                                      d="M21.871,3.499 L-0.000,3.499 L-0.000,5.499 L21.871,5.499 L19.742,7.500 L21.290,8.999 L26.000,4.499 L21.290,-0.001 L19.742,1.500 L21.871,3.499 Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="cat__img">
                        <img src="img/photos/4.png" alt="">
                    </div>
                </div>
                <div class="cat">
                    <div class="cat__content">
                        <div class="cat__title">
                            Торговые роботы
                        </div>
                        <div class="cat__text">

                        </div>
                        <button class="cat__btn btn">
                            <span>Подробнее</span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="26px" height="9px">
                                <path fill-rule="evenodd" fill="rgb(51, 51, 51)"
                                      d="M21.871,3.499 L-0.000,3.499 L-0.000,5.499 L21.871,5.499 L19.742,7.500 L21.290,8.999 L26.000,4.499 L21.290,-0.001 L19.742,1.500 L21.871,3.499 Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="cat__img">
                        <img src="img/photos/5.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block-3">
        <div class="wrapper">
            <div class="title">
                Что вы получаете?
            </div>
            <div class="taking">
                <div class="takingCard">
                    <div class="takingCard__img takingCard__img1">
                        <img src="img/photos/6.png" alt="">
                    </div>
                    <div class="takingCard__title">
                        Продавцы получают
                    </div>
                    <ul class="takingCard__list">
                        <li>
                            Уникальный оффер для продаж
                        </li>
                        <li>
                            Собственную партнерскую программу
                        </li>
                        <li>
                            Рекламу и траффик за счет компании
                        </li>
                    </ul>
                    <button class="takingCard__btn btn">
                        <span>Регистрация</span>
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="26px" height="9px">
                            <path fill-rule="evenodd" fill="rgb(51, 51, 51)"
                                  d="M21.871,3.499 L-0.000,3.499 L-0.000,5.499 L21.871,5.499 L19.742,7.500 L21.290,8.999 L26.000,4.499 L21.290,-0.001 L19.742,1.500 L21.871,3.499 Z"/>
                        </svg>
                    </button>
                </div>
                <div class="takingCard">
                    <div class="takingCard__img">
                        <img src="img/photos/7.png" alt="">
                    </div>
                    <div class="takingCard__title">
                        Покупатели получают
                    </div>
                    <ul class="takingCard__list">
                        <li>
                            100% кэшбэк на любую покупку
                        </li>
                        <li>
                            Большой ассортимент товаров в одном месте
                        </li>
                        <li>
                            Защиту прав покупателя в каждом заказе
                        </li>
                    </ul>
                    <button class="takingCard__btn btn">
                        <span>Регистрация</span>
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="26px" height="9px">
                            <path fill-rule="evenodd" fill="rgb(51, 51, 51)"
                                  d="M21.871,3.499 L-0.000,3.499 L-0.000,5.499 L21.871,5.499 L19.742,7.500 L21.290,8.999 L26.000,4.499 L21.290,-0.001 L19.742,1.500 L21.871,3.499 Z"/>
                        </svg>
                    </button>
                </div>
                <div class="takingCard">
                    <div class="takingCard__img takingCard__img3">
                        <img src="img/photos/8.png" alt="">
                    </div>
                    <div class="takingCard__title">
                        Партнёры получают
                    </div>
                    <ul class="takingCard__list">
                        <li>
                            Вознаграждение от компании за привлечение продавцов
                        </li>
                        <li>
                            Вознаграждение от продавцов за рекомендации
                        </li>
                        <li>
                            Индивидуальные условия сотрудничества
                        </li>
                    </ul>
                    <button class="takingCard__btn btn">
                        <span>Регистрация</span>
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="26px" height="9px">
                            <path fill-rule="evenodd" fill="rgb(51, 51, 51)"
                                  d="M21.871,3.499 L-0.000,3.499 L-0.000,5.499 L21.871,5.499 L19.742,7.500 L21.290,8.999 L26.000,4.499 L21.290,-0.001 L19.742,1.500 L21.871,3.499 Z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="block-1">
        <div class="wrapper">
            <div class="title">
                О компании
            </div>
            <div class="offer offer-margin">
                <div class="offer__left offer__left-width">
                    <div class="offer__title">
                        G-Market — это первая в мире площадка со 100% кэшбэком.
                    </div>
                    <div class="offer__text txt">
                        <p>
                            Совершая любые покупки в G-Market Вы получаете полную стоимость заказа на свой персональный счет и можете потратить эти деньги
                            на новую покупку или без проблем вывести на карту. Как такое возможно?
                        </p>
                        <p>
                            На самом деле, все очень просто! Заказывая товар через G-Market Вы тем самым помогаете компании зарабатывать и увеличивать оборот.
                            Чем чаще Вы это делаете — тем быстрее оборачиваемость капитала. В качестве благодарности за это компания &laquo;делится&raquo;
                            частью заработанной прибыли. Чтобы иметь возможность выплатить 100% стоимости покупки, деньги, уплаченные за товар должны обернуться
                            много раз — поэтому выплата кэшбэка растянута во времени.
                        </p>
                    </div>
                    <a href="" class="offer__btn offer__btn-center btn">
                        <span>Подробнее</span>
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="26px" height="9px">
                            <path fill-rule="evenodd" fill="rgb(51, 51, 51)"
                                  d="M21.871,3.499 L-0.000,3.499 L-0.000,5.499 L21.871,5.499 L19.742,7.500 L21.290,8.999 L26.000,4.499 L21.290,-0.001 L19.742,1.500 L21.871,3.499 Z"/>
                        </svg>
                    </a>
                </div>
                <div class="offer__right offer__right-none">
                    <img src="img/photos/9.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="block-4">
        <div class="wrapper">
            <div class="title">
                О нас в цифрах
            </div>
            <div class="numbers counter">
                <div class="number">
                    <div class="number__num">
                        <span class="count__num">100</span>%
                    </div>
                    <div class="number__text">
                        кэшбэк
                    </div>
                </div>
                <div class="number">
                    <div class="number__num">
                        <span class="count__num">100</span>%
                    </div>
                    <div class="number__text">
                        кэшбэк
                    </div>
                </div>
                <div class="number">
                    <div class="number__num">
                        <span class="count__num">100</span>%
                    </div>
                    <div class="number__text">
                        кэшбэк
                    </div>
                </div>
                <div class="number">
                    <div class="number__num">
                        <span class="count__num">100</span>%
                    </div>
                    <div class="number__text">
                        кэшбэк
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($products_popular)
        <div class="block-5">
            <div class="wrapper">
                <div class="title">
                    Популярные товары
                </div>
                <div class="populars">
                    @foreach($products_popular as $product)
                        @include('front.partials.item_product', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if($products_views)
        <div class="block-5">
            <div class="wrapper">
                <div class="title">
                    Ранее вы смотрели
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

@push('scripts')
    <script src="{{ asset('js/numbers.js') }}"></script>
@endpush