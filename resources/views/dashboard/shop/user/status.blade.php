@extends('layouts.admin')

@section('content')

    <div class="userPanelContent">
        <div class="userPanelItem userPanelItem-blue">
            <div class="userPanelItem__top">
                Баланс
            </div>
            <div class="userPanelItem__left">
                1 000 000 руб.
                <span class="moneyBack-modal">Доступно</span>
            </div>
            <div class="userPanelItem__right">
                1 000 000 руб. <br>
                Заморожено
            </div>
        </div>
        <div class="userPanelItem">
            <div class="userPanelItem__top">
                Новые заказы
            </div>
            <div class="userPanelItem__left">
                3 000 шт. <br>
                Отправлено
            </div>
            <div class="userPanelItem__right">
                1 000 000 руб. <br>
                Заморожено
            </div>
        </div>
        <div class="userPanelItem">
            <div class="userPanelItem__top">
                Ожидают получения
            </div>
            <div class="userPanelItem__left">
                3 000 шт. <br>
                Отправлено
            </div>
            <div class="userPanelItem__right">
                1 000 000 руб. <br>
                Заморожено
            </div>
        </div>
        <div class="userPanelItem">
            <div class="userPanelItem__top">
                Ожидают получения
            </div>
            <div class="userPanelItem__left">
                3 000 шт. <br>
                Отправлено
            </div>
            <div class="userPanelItem__right">
                1 000 000 руб. <br>
                Заморожено
            </div>
        </div>
        <div class="userPanelInf">
            <div class="userPanelInf__item">
                <div class="userPanelInf__title">
                    <span>О1</span>  Как вывести доступные средства
                </div>
                <div class="userPanelInf__text">
                    И уже представитель компании будет решать с обеими сторонами, как уладить ситуацию (например, продлить срок холда вручную, пока покупателю не придет все, что он заказал надлежащего качества, или как вариант — разделить вручную заказ на несколько частей выделив некачественные/недошедшие покупателю товары в новый, с новым сроком холда, а первоначальный заказ закрыть и выплатить продавцу деньги только за фактически принятые покупателем товары). Поэтому в админке нужно предусмотреть возможность редактирования/разделения заказов.
                </div>
            </div>
            <div class="userPanelInf__item">
                <div class="userPanelInf__title">
                    <span>О2</span>  Когда станут доступны замороженные средства
                </div>
                <div class="userPanelInf__text">
                    И уже представитель компании будет решать с обеими сторонами, как уладить ситуацию (например, продлить срок холда вручную, пока покупателю не придет все, что он заказал надлежащего качества, или как вариант — разделить вручную заказ на несколько частей выделив некачественные/недошедшие покупателю товары в новый, с новым сроком холда, а первоначальный заказ закрыть и выплатить продавцу деньги только за фактически принятые покупателем товары). Поэтому в админке нужно предусмотреть возможность редактирования/разделения заказов.
                </div>
            </div>
            <div class="userPanelInf__item">
                <div class="userPanelInf__title">
                    <span>О3</span>  Перевод средств на основной счёт
                </div>
                <div class="userPanelInf__text">
                    И уже представитель компании будет решать с обеими сторонами, как уладить ситуацию (например, продлить срок холда вручную, пока покупателю не придет все, что он заказал надлежащего качества, или как вариант — разделить вручную заказ на несколько частей выделив некачественные/недошедшие покупателю товары в новый, с новым сроком холда, а первоначальный заказ закрыть и выплатить продавцу деньги только за фактически принятые покупателем товары). Поэтому в админке нужно предусмотреть возможность редактирования/разделения заказов.
                </div>
            </div>
        </div>
    </div>

    <div class="popUp-money">

        <div class="moneyBack">
            <div class="moneyBack__cross">
                <svg width="26px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M257,0C116.39,0,0,114.39,0,255s116.39,257,257,257s255-116.39,255-257S397.61,0,257,0z M383.22,338.79    c11.7,11.7,11.7,30.73,0,42.44c-11.61,11.6-30.64,11.79-42.44,0L257,297.42l-85.79,83.82c-11.7,11.7-30.73,11.7-42.44,0    c-11.7-11.7-11.7-30.73,0-42.44l83.8-83.8l-83.8-83.8c-11.7-11.71-11.7-30.74,0-42.44c11.71-11.7,30.74-11.7,42.44,0L257,212.58    l83.78-83.82c11.68-11.68,30.71-11.72,42.44,0c11.7,11.7,11.7,30.73,0,42.44l-83.8,83.8L383.22,338.79z"/>
                            </g>
                        </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                    <g>
                    </g>
                        </svg>
            </div>
            <div class="moneyBack__title">
                Выберите способ
                вывода средств
            </div>
            <div class="lcPageContentPayMiddle">
                <div class="lcPageContentPayMiddle__item lcPageContentPayMiddle__item-active">
                    <div class="lcPageContentPayMiddle__check">
                            <span>

                            </span>
                        <input name="choose" type="radio">
                    </div>
                    <div class="lcPageContentPayMiddle__inf">
                        Банковские карты
                        <span>
                                Комиссия 20%
                            </span>
                    </div>
                    <div class="lcPageContentPayMiddle__img">
                        <img src="{{ asset('img/pay/mastercard1.png') }}" alt="">
                    </div>
                </div>
                <div class="lcPageContentPayMiddle__item">
                    <div class="lcPageContentPayMiddle__check">
                            <span>

                            </span>
                        <input name="choose" type="radio">
                    </div>
                    <div class="lcPageContentPayMiddle__inf">
                        Яндекс деньги
                        <span>
                                Комиссия 20%
                            </span>
                    </div>
                    <div class="lcPageContentPayMiddle__img">
                        <img src="{{ asset('img/pay/yandex1.png') }}" alt="">
                    </div>
                </div>
                <div class="lcPageContentPayMiddle__item">
                    <div class="lcPageContentPayMiddle__check">
                            <span>

                            </span>
                        <input name="choose" type="radio">
                    </div>
                    <div class="lcPageContentPayMiddle__inf">
                        Qiwi
                        <span>
                                Комиссия 20%
                            </span>
                    </div>
                    <div class="lcPageContentPayMiddle__img">
                        <img src="{{ asset('img/pay/qiwi1.png') }}" alt="">
                    </div>
                </div>
                <div class="lcPageContentPayMiddle__item">
                    <div class="lcPageContentPayMiddle__check">
                            <span>

                            </span>
                        <input name="choose" type="radio">
                    </div>
                    <div class="lcPageContentPayMiddle__inf">
                        Криптовалюта:
                        <span>
                                Комиссия 20%
                            </span>
                    </div>
                    <div class="lcPageContentPayMiddle__img">
                        <img src="{{ asset('img/pay/crypto.png') }}" alt="">
                    </div>
                </div>
                <div class="lcPageContentPayMiddle__item">
                    <div class="lcPageContentPayMiddle__check">
                            <span>

                            </span>
                        <input name="choose" type="radio">
                    </div>
                    <div class="lcPageContentPayMiddle__inf">
                        Безналичный расчет:
                        <span>
                                Комиссия 20%
                            </span>
                    </div>
                </div>
                <div class="lcPageContentPayMiddle__item">
                    <div class="lcPageContentPayMiddle__check">
                            <span>

                            </span>
                        <input name="choose" type="radio">
                    </div>
                    <div class="lcPageContentPayMiddle__inf">
                        На основной счёт:
                        <span>
                                Без комиссии
                            </span>
                    </div>
                </div>
            </div>
            <button class="moneyBack__btn btn">
                Вывести средства
            </button>
        </div>

        <div class="popUp__layer">

        </div>
    </div>


@endsection