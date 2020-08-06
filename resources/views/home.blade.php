@extends('layouts.app')

@section('content')

    <div class="block-1">
        <div class="wrapper">
            <div class="offer">
                <div class="offer__left">
                    <div class="offer__title">
                            <span>
                                Совершайте любые покупки
                                и получайте 100% кешбека
                            </span>
                        <span>
                                Любые покупки
                                со 100% кешбеком
                            </span>
                    </div>
                    <div class="offer__text">
                            <p>
                                Вопреки распространенному мнению, Lorem Ipsum - это не просто случайный текст. Он имеет корни в произведении классической латинской литературы 45 года до нашей эры, что делает его более 2000 лет. Ричард МакКлинток, профессор латыни в Хэмпден-Сиднейском колледже в Вирджинии, отыскал одно из самых непонятных латинских слов, concectetur, из отрывка из Lorem Ipsum и, пройдя по ссылкам на слова в классической литературе
                            </p>
                        <p>
                                Вопреки распространенному мнению, Lorem Ipsum - это не просто случайный текст.
                            </p>
                    </div>
                    <button class="offer__btn btn">
                        <span>Подробнее</span>
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
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
                            Вопреки распространенному мнению, Lorem Ipsum - это не просто случайный текст.
                        </div>
                        <button class="cat__btn btn">
                            <span>Подробнее</span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
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
                            Вопреки распространенному мнению, Lorem Ipsum - это не просто случайный текст.
                        </div>
                        <button class="cat__btn btn">
                            <span>Подробнее</span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
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
                            Вопреки распространенному мнению, Lorem Ipsum - это не просто случайный текст.
                        </div>
                        <button class="cat__btn btn">
                            <span>Подробнее</span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
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
                            Вопреки распространенному мнению, Lorem Ipsum - это не просто случайный текст.
                        </div>
                        <button class="cat__btn btn">
                            <span>Подробнее</span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
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
                            100% кэшбэк в течении года
                        </li>
                        <li>
                            100% кэшбэк в течении года
                        </li>
                        <li>
                            100% кэшбэк в течении года
                        </li>
                    </ul>
                    <button class="takingCard__btn btn">
                        <span>Регистрация</span>
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
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
                            100% кэшбэк в течении года
                        </li>
                        <li>
                            100% кэшбэк в течении года
                        </li>
                        <li>
                            100% кэшбэк в течении года
                        </li>
                    </ul>
                    <button class="takingCard__btn btn">
                        <span>Регистрация</span>
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
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
                            100% кэшбэк в течении года
                        </li>
                        <li>
                            100% кэшбэк в течении года
                        </li>
                        <li>
                            100% кэшбэк в течении года
                        </li>
                    </ul>
                    <button class="takingCard__btn btn">
                        <span>Регистрация</span>
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
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
                        Glodal e-commerce discount
                        площадка со 100% кешбеком
                    </div>
                    <div class="offer__text">
                        Вопреки распространенному мнению, Lorem Ipsum - это не просто случайный текст. Он имеет корни в
                        произведении классической латинской литературы 45 года до нашей эры, что делает его более 2000
                        лет. Ричард МакКлинток, профессор латыни в Хэмпден-Сиднейском колледже в Вирджинии, отыскал одно
                        из самых непонятных латинских слов, concectetur, из отрывка из Lorem Ipsum и, пройдя по ссылкам
                        на слова в классической литературе
                    </div>
                    <button class="offer__btn offer__btn-center btn">
                        <span>Подробнее</span>
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="26px" height="9px">
                            <path fill-rule="evenodd" fill="rgb(51, 51, 51)"
                                  d="M21.871,3.499 L-0.000,3.499 L-0.000,5.499 L21.871,5.499 L19.742,7.500 L21.290,8.999 L26.000,4.499 L21.290,-0.001 L19.742,1.500 L21.871,3.499 Z"/>
                        </svg>
                    </button>
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
                        Успешной cдачи
                        у наших учеников
                    </div>
                </div>
                <div class="number">
                    <div class="number__num">
                        <span class="count__num">100</span>%
                    </div>
                    <div class="number__text">
                        Успешной cдачи
                        у наших учеников
                    </div>
                </div>
                <div class="number">
                    <div class="number__num">
                        <span class="count__num">100</span>%
                    </div>
                    <div class="number__text">
                        Успешной cдачи
                        у наших учеников
                    </div>
                </div>
                <div class="number">
                    <div class="number__num">
                        <span class="count__num">100</span>%
                    </div>
                    <div class="number__text">
                        Успешной cдачи
                        у наших учеников
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block-5">
        <div class="wrapper">
            <div class="title">
                Популярные товары
            </div>
            <div class="populars">
                <div class="popular">
                    <div class="popular__img">
                        <img src="img/photos/11.png" alt="">
                    </div>
                    <div class="popular__name">
                        Видеокарта
                    </div>
                    <div class="popular__title">
                        Palit GTX 1660 Super
                        Jet Strim
                    </div>
                    <div class="popular__inf">
                        <div class="popular__price">
                            7 378 ₽
                        </div>
                        <div class="popular__old">
                            7 378 ₽
                        </div>
                        <button class="popular__cart btn">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="21px" height="17px">
                                <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                                      d="M17.949,10.719 L21.004,2.583 L6.110,2.583 L4.913,-0.007 L-0.000,-0.007 L-0.000,1.473 L3.819,1.473 L8.019,10.719 L17.949,10.719 ZM18.712,4.062 L16.803,9.240 L9.165,9.240 L6.492,4.062 L18.712,4.062 ZM9.924,12.207 C8.553,12.207 7.442,13.281 7.442,14.607 C7.442,15.932 8.553,17.006 9.924,17.006 C11.295,17.006 12.406,15.932 12.406,14.607 C12.406,13.281 11.295,12.207 9.924,12.207 ZM9.924,15.530 C9.398,15.530 8.969,15.116 8.969,14.607 C8.969,14.098 9.398,13.684 9.924,13.684 C10.450,13.684 10.879,14.098 10.879,14.607 C10.879,15.116 10.450,15.530 9.924,15.530 ZM16.416,12.207 C15.045,12.207 13.934,13.281 13.934,14.607 C13.934,15.932 15.045,17.006 16.416,17.006 C17.787,17.006 18.899,15.932 18.899,14.607 C18.899,13.281 17.787,12.207 16.416,12.207 ZM16.416,15.530 C15.890,15.530 15.461,15.116 15.461,14.607 C15.461,14.098 15.890,13.684 16.416,13.684 C16.943,13.684 17.371,14.098 17.371,14.607 C17.371,15.116 16.943,15.530 16.416,15.530 Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="popular">
                    <div class="popular__img">
                        <img src="img/photos/12.png" alt="">
                    </div>
                    <div class="popular__name">
                        Видеокарта
                    </div>
                    <div class="popular__title">
                        Palit GTX 1660 Super
                        Jet Strim
                    </div>
                    <div class="popular__inf">
                        <div class="popular__price">
                            7 378 ₽
                        </div>
                        <div class="popular__old">
                            7 378 ₽
                        </div>
                        <button class="popular__cart btn">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="21px" height="17px">
                                <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                                      d="M17.949,10.719 L21.004,2.583 L6.110,2.583 L4.913,-0.007 L-0.000,-0.007 L-0.000,1.473 L3.819,1.473 L8.019,10.719 L17.949,10.719 ZM18.712,4.062 L16.803,9.240 L9.165,9.240 L6.492,4.062 L18.712,4.062 ZM9.924,12.207 C8.553,12.207 7.442,13.281 7.442,14.607 C7.442,15.932 8.553,17.006 9.924,17.006 C11.295,17.006 12.406,15.932 12.406,14.607 C12.406,13.281 11.295,12.207 9.924,12.207 ZM9.924,15.530 C9.398,15.530 8.969,15.116 8.969,14.607 C8.969,14.098 9.398,13.684 9.924,13.684 C10.450,13.684 10.879,14.098 10.879,14.607 C10.879,15.116 10.450,15.530 9.924,15.530 ZM16.416,12.207 C15.045,12.207 13.934,13.281 13.934,14.607 C13.934,15.932 15.045,17.006 16.416,17.006 C17.787,17.006 18.899,15.932 18.899,14.607 C18.899,13.281 17.787,12.207 16.416,12.207 ZM16.416,15.530 C15.890,15.530 15.461,15.116 15.461,14.607 C15.461,14.098 15.890,13.684 16.416,13.684 C16.943,13.684 17.371,14.098 17.371,14.607 C17.371,15.116 16.943,15.530 16.416,15.530 Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="popular">
                    <div class="popular__img">
                        <img src="img/photos/11.png" alt="">
                    </div>
                    <div class="popular__name">
                        Видеокарта
                    </div>
                    <div class="popular__title">
                        Palit GTX 1660 Super
                        Jet Strim
                    </div>
                    <div class="popular__inf">
                        <div class="popular__price">
                            7 378 ₽
                        </div>
                        <div class="popular__old">
                            7 378 ₽
                        </div>
                        <button class="popular__cart btn">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="21px" height="17px">
                                <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                                      d="M17.949,10.719 L21.004,2.583 L6.110,2.583 L4.913,-0.007 L-0.000,-0.007 L-0.000,1.473 L3.819,1.473 L8.019,10.719 L17.949,10.719 ZM18.712,4.062 L16.803,9.240 L9.165,9.240 L6.492,4.062 L18.712,4.062 ZM9.924,12.207 C8.553,12.207 7.442,13.281 7.442,14.607 C7.442,15.932 8.553,17.006 9.924,17.006 C11.295,17.006 12.406,15.932 12.406,14.607 C12.406,13.281 11.295,12.207 9.924,12.207 ZM9.924,15.530 C9.398,15.530 8.969,15.116 8.969,14.607 C8.969,14.098 9.398,13.684 9.924,13.684 C10.450,13.684 10.879,14.098 10.879,14.607 C10.879,15.116 10.450,15.530 9.924,15.530 ZM16.416,12.207 C15.045,12.207 13.934,13.281 13.934,14.607 C13.934,15.932 15.045,17.006 16.416,17.006 C17.787,17.006 18.899,15.932 18.899,14.607 C18.899,13.281 17.787,12.207 16.416,12.207 ZM16.416,15.530 C15.890,15.530 15.461,15.116 15.461,14.607 C15.461,14.098 15.890,13.684 16.416,13.684 C16.943,13.684 17.371,14.098 17.371,14.607 C17.371,15.116 16.943,15.530 16.416,15.530 Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="popular">
                    <div class="popular__img">
                        <img src="img/photos/11.png" alt="">
                    </div>
                    <div class="popular__name">
                        Видеокарта
                    </div>
                    <div class="popular__title">
                        Palit GTX 1660 Super
                        Jet Strim
                    </div>
                    <div class="popular__inf">
                        <div class="popular__price">
                            7 378 ₽
                        </div>
                        <div class="popular__old">
                            7 378 ₽
                        </div>
                        <button class="popular__cart btn">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="21px" height="17px">
                                <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                                      d="M17.949,10.719 L21.004,2.583 L6.110,2.583 L4.913,-0.007 L-0.000,-0.007 L-0.000,1.473 L3.819,1.473 L8.019,10.719 L17.949,10.719 ZM18.712,4.062 L16.803,9.240 L9.165,9.240 L6.492,4.062 L18.712,4.062 ZM9.924,12.207 C8.553,12.207 7.442,13.281 7.442,14.607 C7.442,15.932 8.553,17.006 9.924,17.006 C11.295,17.006 12.406,15.932 12.406,14.607 C12.406,13.281 11.295,12.207 9.924,12.207 ZM9.924,15.530 C9.398,15.530 8.969,15.116 8.969,14.607 C8.969,14.098 9.398,13.684 9.924,13.684 C10.450,13.684 10.879,14.098 10.879,14.607 C10.879,15.116 10.450,15.530 9.924,15.530 ZM16.416,12.207 C15.045,12.207 13.934,13.281 13.934,14.607 C13.934,15.932 15.045,17.006 16.416,17.006 C17.787,17.006 18.899,15.932 18.899,14.607 C18.899,13.281 17.787,12.207 16.416,12.207 ZM16.416,15.530 C15.890,15.530 15.461,15.116 15.461,14.607 C15.461,14.098 15.890,13.684 16.416,13.684 C16.943,13.684 17.371,14.098 17.371,14.607 C17.371,15.116 16.943,15.530 16.416,15.530 Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block-5">
        <div class="wrapper">
            <div class="title">
                Ранее вы смотрели
            </div>
            <div class="populars">
                <div class="popular">
                    <div class="popular__img">
                        <img src="img/photos/11.png" alt="">
                    </div>
                    <div class="popular__name">
                        Видеокарта
                    </div>
                    <div class="popular__title">
                        Palit GTX 1660 Super
                        Jet Strim
                    </div>
                    <div class="popular__inf">
                        <div class="popular__price">
                            7 378 ₽
                        </div>
                        <div class="popular__old">
                            7 378 ₽
                        </div>
                        <button class="popular__cart btn">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="21px" height="17px">
                                <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                                      d="M17.949,10.719 L21.004,2.583 L6.110,2.583 L4.913,-0.007 L-0.000,-0.007 L-0.000,1.473 L3.819,1.473 L8.019,10.719 L17.949,10.719 ZM18.712,4.062 L16.803,9.240 L9.165,9.240 L6.492,4.062 L18.712,4.062 ZM9.924,12.207 C8.553,12.207 7.442,13.281 7.442,14.607 C7.442,15.932 8.553,17.006 9.924,17.006 C11.295,17.006 12.406,15.932 12.406,14.607 C12.406,13.281 11.295,12.207 9.924,12.207 ZM9.924,15.530 C9.398,15.530 8.969,15.116 8.969,14.607 C8.969,14.098 9.398,13.684 9.924,13.684 C10.450,13.684 10.879,14.098 10.879,14.607 C10.879,15.116 10.450,15.530 9.924,15.530 ZM16.416,12.207 C15.045,12.207 13.934,13.281 13.934,14.607 C13.934,15.932 15.045,17.006 16.416,17.006 C17.787,17.006 18.899,15.932 18.899,14.607 C18.899,13.281 17.787,12.207 16.416,12.207 ZM16.416,15.530 C15.890,15.530 15.461,15.116 15.461,14.607 C15.461,14.098 15.890,13.684 16.416,13.684 C16.943,13.684 17.371,14.098 17.371,14.607 C17.371,15.116 16.943,15.530 16.416,15.530 Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="popular">
                    <div class="popular__img">
                        <img src="img/photos/12.png" alt="">
                    </div>
                    <div class="popular__name">
                        Видеокарта
                    </div>
                    <div class="popular__title">
                        Palit GTX 1660 Super
                        Jet Strim
                    </div>
                    <div class="popular__inf">
                        <div class="popular__price">
                            7 378 ₽
                        </div>
                        <div class="popular__old">
                            7 378 ₽
                        </div>
                        <button class="popular__cart btn">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="21px" height="17px">
                                <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                                      d="M17.949,10.719 L21.004,2.583 L6.110,2.583 L4.913,-0.007 L-0.000,-0.007 L-0.000,1.473 L3.819,1.473 L8.019,10.719 L17.949,10.719 ZM18.712,4.062 L16.803,9.240 L9.165,9.240 L6.492,4.062 L18.712,4.062 ZM9.924,12.207 C8.553,12.207 7.442,13.281 7.442,14.607 C7.442,15.932 8.553,17.006 9.924,17.006 C11.295,17.006 12.406,15.932 12.406,14.607 C12.406,13.281 11.295,12.207 9.924,12.207 ZM9.924,15.530 C9.398,15.530 8.969,15.116 8.969,14.607 C8.969,14.098 9.398,13.684 9.924,13.684 C10.450,13.684 10.879,14.098 10.879,14.607 C10.879,15.116 10.450,15.530 9.924,15.530 ZM16.416,12.207 C15.045,12.207 13.934,13.281 13.934,14.607 C13.934,15.932 15.045,17.006 16.416,17.006 C17.787,17.006 18.899,15.932 18.899,14.607 C18.899,13.281 17.787,12.207 16.416,12.207 ZM16.416,15.530 C15.890,15.530 15.461,15.116 15.461,14.607 C15.461,14.098 15.890,13.684 16.416,13.684 C16.943,13.684 17.371,14.098 17.371,14.607 C17.371,15.116 16.943,15.530 16.416,15.530 Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="popular">
                    <div class="popular__img">
                        <img src="img/photos/11.png" alt="">
                    </div>
                    <div class="popular__name">
                        Видеокарта
                    </div>
                    <div class="popular__title">
                        Palit GTX 1660 Super
                        Jet Strim
                    </div>
                    <div class="popular__inf">
                        <div class="popular__price">
                            7 378 ₽
                        </div>
                        <div class="popular__old">
                            7 378 ₽
                        </div>
                        <button class="popular__cart btn">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="21px" height="17px">
                                <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                                      d="M17.949,10.719 L21.004,2.583 L6.110,2.583 L4.913,-0.007 L-0.000,-0.007 L-0.000,1.473 L3.819,1.473 L8.019,10.719 L17.949,10.719 ZM18.712,4.062 L16.803,9.240 L9.165,9.240 L6.492,4.062 L18.712,4.062 ZM9.924,12.207 C8.553,12.207 7.442,13.281 7.442,14.607 C7.442,15.932 8.553,17.006 9.924,17.006 C11.295,17.006 12.406,15.932 12.406,14.607 C12.406,13.281 11.295,12.207 9.924,12.207 ZM9.924,15.530 C9.398,15.530 8.969,15.116 8.969,14.607 C8.969,14.098 9.398,13.684 9.924,13.684 C10.450,13.684 10.879,14.098 10.879,14.607 C10.879,15.116 10.450,15.530 9.924,15.530 ZM16.416,12.207 C15.045,12.207 13.934,13.281 13.934,14.607 C13.934,15.932 15.045,17.006 16.416,17.006 C17.787,17.006 18.899,15.932 18.899,14.607 C18.899,13.281 17.787,12.207 16.416,12.207 ZM16.416,15.530 C15.890,15.530 15.461,15.116 15.461,14.607 C15.461,14.098 15.890,13.684 16.416,13.684 C16.943,13.684 17.371,14.098 17.371,14.607 C17.371,15.116 16.943,15.530 16.416,15.530 Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="popular">
                    <div class="popular__img">
                        <img src="img/photos/11.png" alt="">
                    </div>
                    <div class="popular__name">
                        Видеокарта
                    </div>
                    <div class="popular__title">
                        Palit GTX 1660 Super
                        Jet Strim
                    </div>
                    <div class="popular__inf">
                        <div class="popular__price">
                            7 378 ₽
                        </div>
                        <div class="popular__old">
                            7 378 ₽
                        </div>
                        <button class="popular__cart btn">
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="21px" height="17px">
                                <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                                      d="M17.949,10.719 L21.004,2.583 L6.110,2.583 L4.913,-0.007 L-0.000,-0.007 L-0.000,1.473 L3.819,1.473 L8.019,10.719 L17.949,10.719 ZM18.712,4.062 L16.803,9.240 L9.165,9.240 L6.492,4.062 L18.712,4.062 ZM9.924,12.207 C8.553,12.207 7.442,13.281 7.442,14.607 C7.442,15.932 8.553,17.006 9.924,17.006 C11.295,17.006 12.406,15.932 12.406,14.607 C12.406,13.281 11.295,12.207 9.924,12.207 ZM9.924,15.530 C9.398,15.530 8.969,15.116 8.969,14.607 C8.969,14.098 9.398,13.684 9.924,13.684 C10.450,13.684 10.879,14.098 10.879,14.607 C10.879,15.116 10.450,15.530 9.924,15.530 ZM16.416,12.207 C15.045,12.207 13.934,13.281 13.934,14.607 C13.934,15.932 15.045,17.006 16.416,17.006 C17.787,17.006 18.899,15.932 18.899,14.607 C18.899,13.281 17.787,12.207 16.416,12.207 ZM16.416,15.530 C15.890,15.530 15.461,15.116 15.461,14.607 C15.461,14.098 15.890,13.684 16.416,13.684 C16.943,13.684 17.371,14.098 17.371,14.607 C17.371,15.116 16.943,15.530 16.416,15.530 Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
<script src="{{ asset('js/numbers.js') }}"></script>
@endpush