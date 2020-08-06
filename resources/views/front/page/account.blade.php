@extends('layouts.app')

@section('content')
    <div class="block-lcPage">
        <div class="wrapper">
            <div class="lcPage">
                <div class="lcPageMenu">
                    <div class="lcPageMenuTop">
                        <div class="lcPageMenuTop__img">
                            <img src="img/photos/21.png" alt="">
                        </div>
                        <div class="lcPageMenuTop__name">
                            Антон Кириенко
                        </div>
                    </div>
                    <div class="lcPageMenuNav">
                        <a href="">
                            Личные данные
                        </a>
                        <a href="">
                            Мои заказы
                        </a>
                        <a href="">
                            История заказов
                        </a>
                        <a href="">
                            Кэшбэк
                        </a>
                        <a class="active" href="">
                            Пополнение/снятие
                        </a>
                        <a href="">
                            Помощь
                        </a>
                    </div>
                    <div class="lcPageMenuCash">
                        Баланс:
                        <span>2 098 468 руб.</span>
                    </div>
                    <button class="btn lcPageMenu__btn">
                        Стать продавцом
                    </button>
                    <button class="btn lcPageMenu__btn">
                        Стать партнёром
                    </button>
                </div>
                <div class="lcPageContent">
                    <div class="lcPageContentTop">
                        <button class="lcPageContentTop__btn lcPageContentTop__btn-active btn-blue">
                            Кабинет покупателя
                        </button>
                        <button class="lcPageContentTop__btn">
                            Кабинет продавца
                        </button>
                        <button class="lcPageContentTop__btn">
                            Кабинет партнёра
                        </button>
                    </div>
                    <div class="lcPageContentTitle">
                        Пополнение / Снятие
                    </div>
                    <div class="lcPageContentPayChoose">
                        <div class="lcPageContentPayChoose__item lcPageContentPayChoose__item-active">
                            <div class="lcPageContentPayChoose__check">
                                    <span>

                                    </span>
                                <input name="choose" type="radio">
                            </div>
                            <span>
                                    Пополнение счёта:
                                </span>
                        </div>
                        <div class="lcPageContentPayChoose__item">
                            <div class="lcPageContentPayChoose__check">
                                    <span>

                                    </span>
                                <input name="choose" type="radio">
                            </div>
                            <span>
                                    Вывод средств:
                                </span>
                        </div>
                    </div>
                    <div class="lcPageContentPay lcPageContentPay-active">
                        <div class="lcPageContentPayTop">
                            <div class="lcPageContentPayTop__text">
                                Выберите способ пополнения:
                            </div>
                            <button class="lcPageContentPayTop__btn btn">
                                История транзакций
                            </button>
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
                                    <img src="img/pay/mastercard1.png" alt="">
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
                                    <img src="img/pay/yandex1.png" alt="">
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
                                    <img src="img/pay/qiwi1.png" alt="">
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
                                    <img src="img/pay/crypto.png" alt="">
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
                        </div>
                        <div class="lcPageContentPayBottom">
                            <div class="lcPageContentPayBottom__item">
                                    <span>
                                        Пополнить счёт на:
                                    </span>
                                <input type="text" placeholder="1 000 000 руб.">
                            </div>
                            <div class="lcPageContentPayBottom__item">
                                    <span>
                                        Будет списанно:
                                    </span>
                                <input type="text" placeholder="1 000 000 руб.">
                            </div>
                            <button class="lcPageContentPayBottom__btn btn">
                                Пополнить
                            </button>
                        </div>
                    </div>
                    <div class="lcPageContentPay">
                        <div class="lcPageContentPayTop">
                            <div class="lcPageContentPayTop__text">
                                Выберите способ вывода:
                            </div>
                            <button class="lcPageContentPayTop__btn btn">
                                История транзакций
                            </button>
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
                                    <img src="img/pay/mastercard1.png" alt="">
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
                                    <img src="img/pay/yandex1.png" alt="">
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
                                    <img src="img/pay/qiwi1.png" alt="">
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
                                    <img src="img/pay/crypto.png" alt="">
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
                        </div>
                        <div class="lcPageContentPayBottom">
                            <div class="lcPageContentPayBottom__item">
                                    <span>
                                        Вывести средства:
                                    </span>
                                <input type="text" placeholder="1 000 000 руб.">
                            </div>
                            <div class="lcPageContentPayBottom__item">
                                    <span>
                                        Коммисия:
                                    </span>
                                <input type="text" placeholder="1 000 000 руб.">
                            </div>
                            <button class="lcPageContentPayBottom__btn btn">
                                Вывести
                            </button>
                        </div>
                    </div>
                    <div class="lcPayWrap">
                        <div class="lcPageContentSort lcPagePayContentSort">
                            <div class="lcPageContentSort__item">
                                    <span>
                                        Вид транзакции:
                                    </span>
                                <div class="catalogTop__sort">
                                    <div class="catalogSort">
                                        <span>Пополнение</span>
                                        <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                width="12px" height="6px">
                                            <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
                                                  d="M-0.000,-0.000 L12.000,-0.000 L6.000,6.000 L-0.000,-0.000 Z"/>
                                        </svg>
                                        <div class="catalogSort__drop">
                                                <span>
                                                    Снятие
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lcPageContentSort__item">
                                    <span>
                                        Способ оплаты:
                                    </span>
                                <div class="catalogTop__sort">
                                    <div class="catalogSort">
                                        <span>Платежная система</span>
                                        <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                width="12px" height="6px">
                                            <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
                                                  d="M-0.000,-0.000 L12.000,-0.000 L6.000,6.000 L-0.000,-0.000 Z"/>
                                        </svg>
                                        <div class="catalogSort__drop">
                                                <span>
                                                    Платежная система
                                                </span>
                                            <span>
                                                    Платежная система
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lcPageContentSort__item">
                                    <span>
                                        Период:
                                    </span>
                                <input type="text" placeholder="с 18.07.2020">
                                <input type="text" placeholder="по 18.07.2020">
                            </div>
                            <button class="lcPageContentSort__btn btn">
                                Применить
                            </button>
                        </div>
                        <div class="lcPageContentTable lcPageContentTable-pay">
                            <div class="lcPageContentRow">
                                <div class="lcPageContentCol">
                                    Транзакция
                                </div>
                                <div class="lcPageContentCol">
                                    Дата
                                </div>
                                <div class="lcPageContentCol">
                                    Сумма руб.
                                </div>
                                <div class="lcPageContentCol">
                                    Комиссия
                                </div>
                                <div class="lcPageContentCol">
                                    Способ оплаты/ вывода
                                </div>
                            </div>
                            <div class="lcPageContentRow">
                                <div class="lcPageContentCol">
                                    Пополнение средств
                                </div>
                                <div class="lcPageContentCol">
                                    15.07.2020
                                </div>
                                <div class="lcPageContentCol">
                                    1 000 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    10 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    Безналичный расчёт
                                </div>
                            </div>
                            <div class="lcPageContentRow">
                                <div class="lcPageContentCol">
                                    Пополнение средств
                                </div>
                                <div class="lcPageContentCol">
                                    15.07.2020
                                </div>
                                <div class="lcPageContentCol">
                                    1 000 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    10 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    Безналичный расчёт
                                </div>
                            </div>
                            <div class="lcPageContentRow">
                                <div class="lcPageContentCol">
                                    Пополнение средств
                                </div>
                                <div class="lcPageContentCol">
                                    15.07.2020
                                </div>
                                <div class="lcPageContentCol">
                                    1 000 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    10 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    Безналичный расчёт
                                </div>
                            </div>
                            <div class="lcPageContentRow">
                                <div class="lcPageContentCol">
                                    Пополнение средств
                                </div>
                                <div class="lcPageContentCol">
                                    15.07.2020
                                </div>
                                <div class="lcPageContentCol">
                                    1 000 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    10 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    Безналичный расчёт
                                </div>
                            </div>
                            <div class="lcPageContentRow">
                                <div class="lcPageContentCol">
                                    Пополнение средств
                                </div>
                                <div class="lcPageContentCol">
                                    15.07.2020
                                </div>
                                <div class="lcPageContentCol">
                                    1 000 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    10 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    Безналичный расчёт
                                </div>
                            </div>
                            <div class="lcPageContentRow">
                                <div class="lcPageContentCol">
                                    Пополнение средств
                                </div>
                                <div class="lcPageContentCol">
                                    15.07.2020
                                </div>
                                <div class="lcPageContentCol">
                                    1 000 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    10 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    Безналичный расчёт
                                </div>
                            </div>
                            <div class="lcPageContentRow">
                                <div class="lcPageContentCol">
                                    Пополнение средств
                                </div>
                                <div class="lcPageContentCol">
                                    15.07.2020
                                </div>
                                <div class="lcPageContentCol">
                                    1 000 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    10 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    Безналичный расчёт
                                </div>
                            </div>
                            <div class="lcPageContentRow">
                                <div class="lcPageContentCol">
                                    Пополнение средств
                                </div>
                                <div class="lcPageContentCol">
                                    15.07.2020
                                </div>
                                <div class="lcPageContentCol">
                                    1 000 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    10 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    Безналичный расчёт
                                </div>
                            </div>
                            <div class="lcPageContentRow">
                                <div class="lcPageContentCol">
                                    Пополнение средств
                                </div>
                                <div class="lcPageContentCol">
                                    15.07.2020
                                </div>
                                <div class="lcPageContentCol">
                                    1 000 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    10 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    Безналичный расчёт
                                </div>
                            </div>
                            <div class="lcPageContentRow">
                                <div class="lcPageContentCol">
                                    Пополнение средств
                                </div>
                                <div class="lcPageContentCol">
                                    15.07.2020
                                </div>
                                <div class="lcPageContentCol">
                                    1 000 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    10 000 руб.
                                </div>
                                <div class="lcPageContentCol">
                                    Безналичный расчёт
                                </div>
                            </div>
                        </div>
                        <div class="lcPageContentPag">
                            <a href="" class="active">1</a>
                            <a href="">2</a>
                            <a href="">3</a>
                            <a href="">4</a>
                            <a href="">5</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection