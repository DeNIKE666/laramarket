@extends('layouts.admin')

@section('content')

    @push('styles')
        <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    @endpush

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
            <span>Пополнение счёта:</span>
        </div>
        <div class="lcPageContentPayChoose__item">
            <div class="lcPageContentPayChoose__check">
                <span>
                </span>
                <input name="choose" type="radio">
            </div>
            <span>Вывод средств:</span>
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
        <div id="payRefill" class="lcPageContentPayMiddle">
            @foreach ($refills as $k=>$refill)
                <div class="lcPageContentPayMiddle__item @if($k == 0) lcPageContentPayMiddle__item-active @endif">
                    <div class="lcPageContentPayMiddle__check ">
                    <span>
                    </span>
                        <input @if($k == 0) checked @endif
                        name="choose"
                               type="radio"
                               value="{{ $refill->title }}"
                               data-percent="{{ $refill->percent }}"
                        >
                    </div>
                    <div class="lcPageContentPayMiddle__inf" data-modal="#modal3">
                        {{ $refill->title }}
                        <span>Комиссия {{ $refill->percent }}%</span>
                    </div>
                    @if($refill->ico != '')
                        <div class="lcPageContentPayMiddle__img">
                            <img src="{{ asset($refill->ico) }}" alt="">
                        </div>
                    @endif
                </div>
            @endforeach

        </div>
        <div class="lcPageContentPayBottom">
            <div class="lcPageContentPayBottom__item">
                <span>Пополнить счёт на:</span>
                <input id="account_refill_cost" type="number" placeholder="1 000 000 руб.">
            </div>
            <div class="lcPageContentPayBottom__item">
                <span>Будет списанно:</span>
                <input id="account_refill_cost_percent" type="number" placeholder="1 000 000 руб.">
            </div>
            <button id="payModal" class="lcPageContentPayBottom__btn btn">
                Пополнить
            </button>
        </div>
    </div>
    <form action="{{ route('withdraw') }}" method="POST">
        @CSRF
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
                        <input name="pay_system" type="radio" value="QIWI Кошелёк">
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
            </div>

            <div class="lcPageContentPayBottom">
                <div class="lcPageContentPayBottom__item">
                                    <span>
                                        Вывести средства:
                                    </span>
                    <input type="text" placeholder="1 000 000 руб." name="amount">
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
    </form>
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
                            <path fill-rule="evenodd" fill="rgb(153, 153, 153)"
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
                            <path fill-rule="evenodd" fill="rgb(153, 153, 153)"
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
    </div>

    <div class="popUp popUp-pay">
        <div class="popUp__content">
            <div class="popUp__title">
                Пополнение<br/>
                банковские карты
            </div>
            <form id="cardform" name="cardform" action="{{ route('qiwi.pay') }}" method="POST" class="cartBlockPay">
                <div class="cardform__row">
                    <div class="cardform__row__col1">
                        <label for="card">Номер карты</label>
                        <input type="text" class="input-card-full" name="card" id="card" placeholder="2222 2222 2222 2222">
                    </div>
                </div>

                <div class="cardform__row">
                    <div class="cardform__row__col2">
                        <label for="month">Месяц</label>
                        <input type="text" class="input-card-full" name="month" id="month" placeholder="Месяц" maxlength="2">
                    </div>
                    <div class="cardform__row__col2">
                        <label for="year">Год</label>
                        <input type="text" class="input-card-full" placeholder="Год" maxlength="2" name="year" id="year">
                    </div>
                    <div class="cardform__row__col2">
                        <label for="cvv">cvv</label>
                        <input type="text" class="input-card-full" placeholder="cvv" maxlength="3" name="cvv" id="cvv">
                    </div>
                </div>

                <div class="cardform__row">
                    <div class="cardform__row__col1">
                        <label for="amount">Сумма пополнения (руб.)</label>
                        <input type="text" class="input-card-full input-card-full--big" placeholder="Сумма ввода" name="amount" id="amount">
                    </div>
                </div>
                <div class="cardform__foot">
                    <button class="btn lcPageMenu__btn form-submit " id="pay_button">Пополнить счёт</button>

                    <div class="mt-20 text-danger text-sm error-div" style="display: none">
                        <span>Исправьте ошибки, выделенные красной рамкой:</span>
                    </div>
                </div>
            </form>
        </div>
        <div class="popUp__layer">

        </div>
    </div>





    @push('scripts')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

        <script>
            var cc = cardform.card;
            var month = cardform.month;
            var year = cardform.year;
            var cvv = cardform.cvv;
            var amount = cardform.amount;

            for (var i in ['input', 'change', 'blur', 'keyup']) {
                cc.addEventListener('input', formatCardCode, false);
                month.addEventListener('input', formatMonth, false);
                year.addEventListener('input', formatYear, false);
                cvv.addEventListener('input', formatCvv, false);
            }

            function formatCardCode() {
                var cardCode = this.value.replace(/[^\d]/g, '').substring(0, 18);
                cardCode = cardCode != '' ? cardCode.match(/.{1,4}/g).join(' ') : '';
                this.value = cardCode;
            }

            function formatMonth() {
                var month = this.value.replace(/[^\d]/g, '').substring(0, 2);
                month = month != '' ? month.match(/.{1,2}/g) : '';
                this.value = month;
            }

            function formatYear() {
                var year = this.value.replace(/[^\d]/g, '').substring(0, 2);
                year = year != '' ? year.match(/.{1,2}/g) : '';
                this.value = year;
            }

            function formatCvv() {
                var cvv = this.value.replace(/[^\d]/g, '').substring(0, 3);
                cvv = cvv != '' ? cvv.match(/.{1,3}/g) : '';
                this.value = cvv;
            }


            $('form[id="cardform"]').validate({
                //wrapper: 'div',
                errorElement: "div",
                errorElementClass: "error",
                errorLabelContainer: '.error-div',

                //errorClass: "error",
                errorPlacement: function (error, element) {
                    //error.insertAfter($('.credit-cards'));
                    // var placement = $(element).data('error');
                    // if (placement) {
                    //     $(placement).append(error)
                    // } else {
                    //     error.insertAfter(element);
                    // }
                },


                rules: {
                    card: {
                        required: true,
                        creditcard: true
                    },
                    month: {
                        required: true,
                        number: true,
                        max: 12
                    },
                    year: {
                        required: true,
                        number: true,
                        min: 19,
                        max: 30
                    },
                    cvv: {
                        required: true,
                        number: true,
                        maxlength: 3
                    },
                    amount: {
                        required: true,
                        number: true,
                    }
                },
                messages: {
                    card: '- Номер карты указан неправильно',
                    month: '- Месяц указан неправильно',
                    year: '- Год указан неправильно',
                    cvv: '- CVV-код указан неправильно',
                    amount: '- Сумма не указана'
                },
                submitHandler: function (form) {
                    $("#pay_button").after('<img id="loader" src="img/spinner.gif">');
                    $("#pay_button").remove();
                    form.submit();
                }
            });
        </script>
    @endpush

@endsection