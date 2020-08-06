@extends('layouts.admin')

@section('content')

    <div class="lcPageContentTitle">
        История заказов
    </div>
    <div class="lcPageContentSort">
        <div class="lcPageContentSort__item">
                                <span>
                                    Период:
                                </span>
            <input type="text" placeholder="с 18.07.2020">
            <input type="text" placeholder="по 18.07.2020">
        </div>
        <div class="lcPageContentSort__item">
                                <span>
                                    Отображать по:
                                </span>
            <div class="catalogTop__sort">
                <div class="catalogSort">
                    <span>100</span>
                    <svg
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="12px" height="6px">
                        <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
                              d="M-0.000,-0.000 L12.000,-0.000 L6.000,6.000 L-0.000,-0.000 Z"/>
                    </svg>
                    <div class="catalogSort__drop">
                                            <span>
                                                200
                                            </span>
                        <span>
                                                300
                                            </span>
                        <span>
                                                400
                                            </span>
                    </div>
                </div>
            </div>
        </div>
        <button class="lcPageContentSort__btn btn">
            Применить
        </button>
    </div>
    <div class="lcPageContentTable">
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                № Заказа
            </div>
            <div class="lcPageContentCol">
                Дата заказа
            </div>
            <div class="lcPageContentCol">
                Сумма заказа
            </div>
            <div class="lcPageContentCol">
                Начислено кэшбэка
            </div>
        </div>
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                80145732180
            </div>
            <div class="lcPageContentCol">
                15.07.2020
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
        </div>
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                80145732180
            </div>
            <div class="lcPageContentCol">
                15.07.2020
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
        </div>
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                80145732180
            </div>
            <div class="lcPageContentCol">
                15.07.2020
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
        </div>
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                80145732180
            </div>
            <div class="lcPageContentCol">
                15.07.2020
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
        </div>
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                80145732180
            </div>
            <div class="lcPageContentCol">
                15.07.2020
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
        </div>
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                80145732180
            </div>
            <div class="lcPageContentCol">
                15.07.2020
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
        </div>
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                80145732180
            </div>
            <div class="lcPageContentCol">
                15.07.2020
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
        </div>
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                80145732180
            </div>
            <div class="lcPageContentCol">
                15.07.2020
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
        </div>
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                80145732180
            </div>
            <div class="lcPageContentCol">
                15.07.2020
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
        </div>
        <div class="lcPageContentRow">
            <div class="lcPageContentCol">
                80145732180
            </div>
            <div class="lcPageContentCol">
                15.07.2020
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
            <div class="lcPageContentCol">
                1 000 000 руб.
            </div>
        </div>
    </div>
@endsection