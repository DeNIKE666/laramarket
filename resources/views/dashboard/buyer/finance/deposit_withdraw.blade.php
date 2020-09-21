@php
    /** @var \Illuminate\Support\Collection $depositings */
    /** @var \App\Models\PaymentOption $depositing */

    /** @var \Illuminate\Support\Collection $withdrawals */
    /** @var \App\Models\PaymentOption $withdrawal */

    /** @var \Illuminate\Support\Collection $paySystems */
    /** @var App\Models\PaymentOption $paySystem */

    $historyPersonalBinds = __('buyer/finance/history.personal.bind');

dump($paySystems);
@endphp

@extends('layouts.admin')

@section('content')
    @push('styles')
        <link href="{{ asset('vendors/air-datepicker-master/dist/css/datepicker.min.css') }}" rel="stylesheet">
    @endpush

    <div class="lcPageContentTitle" style="display: block;">
        Пополнение / Снятие
    </div>
    <div class="lcPageContentPayChoose">
        <div class="lcPageContentPayChoose__item lcPageContentPayChoose__item-active">
            <div class="lcPageContentPayChoose__check">
                <span>
                </span>
                <input type="radio" class="paymentType" checked="checked">
            </div>
            <span>Пополнение счёта:</span>
        </div>
        <div class="lcPageContentPayChoose__item">
            <div class="lcPageContentPayChoose__check">
                <span>
                </span>
                <input type="radio" class="paymentType">
            </div>
            <span>Вывод средств:</span>
        </div>
    </div>

    <div class="error" id="paymentErrors" style="display: none;"></div>
    <div class="lcPageContentPay lcPageContentPay-active">
        <div class="lcPageContentPayTop">
            <div class="lcPageContentPayTop__text">
                Выберите способ пополнения:
            </div>
            <a href="{{ route('buyer.finance.history.personal-account', [], false) }}" class="lcPageContentPayTop__btn btn show-history">
                История транзакций
            </a>
        </div>
        <div id="payin" class="lcPageContentPayMiddle">
            @foreach ($depositings as $k => $depositing)
                <div class="payinMethods lcPageContentPayMiddle__item @if($k == 0) lcPageContentPayMiddle__item-active @endif">
                    <div class="lcPageContentPayMiddle__check ">
                    <span>
                    </span>
                        <input
                                name="payinMethod"
                                data-id="{{ $depositing->id }}"
                                type="radio"
                                value="{{ $depositing->title }}"
                                data-percent="{{ $depositing->depositeMoney }}"
                                @if($k == 0) checked @endif
                        />
                    </div>
                    <div class="lcPageContentPayMiddle__inf" data-modal="#modal3">
                        {{ $depositing->title }}
                        <span>Комиссия {{ $depositing->depositeMoney * 100 }}%</span>
                    </div>
                    @if($depositing->icon != '')
                        <div class="lcPageContentPayMiddle__img">
                            <img src="{{ asset($depositing->icon) }}" alt="">
                        </div>
                    @endif
                </div>
            @endforeach

        </div>
        <div class="lcPageContentPayBottom">
            <div class="lcPageContentPayBottom__item">
                <span>Пополнить счёт на:</span>
                <input id="account_payin_cost" type="number" min="0" placeholder="1 000 000 руб.">
            </div>
            <div class="lcPageContentPayBottom__item">
                <span>Будет списано:</span>
                <input id="account_payin_cost_percent" type="number" min="0" placeholder="1 000 000 руб.">
            </div>
            <button id="payModal" class="lcPageContentPayBottom__btn btn">
                Пополнить
            </button>
        </div>
    </div>
    <form action="{{ route('buyer.finance.withdraw') }}" method="POST">
        @CSRF
        <div class="lcPageContentPay">
            <div class="lcPageContentPayTop">
                <div class="lcPageContentPayTop__text">
                    Выберите способ вывода:
                </div>
                <a href="{{ route('buyer.finance.history.personal-account', [], false) }}" class="lcPageContentPayTop__btn btn show-history">
                    История транзакций
                </a>
            </div>

            <div id="payout" class="lcPageContentPayMiddle">
                @foreach ($withdrawals as $k => $withdrawal)
                    <div class="payoutMethods lcPageContentPayMiddle__item @if($k == 0) lcPageContentPayMiddle__item-active @endif">
                        <div class="lcPageContentPayMiddle__check ">
                    <span>
                    </span>
                            <input
                                    name="method"
                                    type="radio"
                                    data-id="{{ $withdrawal->id }}"
                                    value="{{ $withdrawal->id }}"
                                    data-percent="{{ $withdrawal->withdrawMoney }}"
                                    @if($k == 0) checked @endif
                            />
                        </div>
                        <div class="lcPageContentPayMiddle__inf" data-modal="#modal3">
                            {{ $withdrawal->title }}
                            <span>Комиссия {{ $withdrawal->withdrawMoney * 100 }}%</span>
                        </div>
                        @if($withdrawal->icon != '')
                            <div class="lcPageContentPayMiddle__img">
                                <img src="{{ asset($withdrawal->icon) }}" alt="">
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="lcPageContentPayBottom">
                <div class="lcPageContentPayBottom__item">
                    <span>К получению:</span>
                    <input type="number" id="account_payout_cost" autocomplete="off" placeholder="1 000 000 руб.">
                </div>
                <div class="lcPageContentPayBottom__item">
                    <span>Будет списано:</span>
                    <input type="number" id="account_payout_cost_percent" autocomplete="off" placeholder="1 000 000 руб." name="amount">
                </div>
                <button class="lcPageContentPayBottom__btn btn">Вывести</button>
            </div>
        </div>
    </form>

    <div class="lcPayWrap">
        {{-- Сортировка и фильтр --}}
        <div class="lcPageContentSort lcPagePayContentSort">
            <div class="lcPageContentSort__item">
                <span>Тип операции:</span>
                <select name="sort" class="select-css" id="filter-with-transType">
                    <option value="">Выбрать</option>
                    @foreach($historyPersonalBinds['trans_type'] as $keyTransType => $transType)
                        <option value="{{ $keyTransType }}">{{ $transType }}</option>
                    @endforeach
                </select>
            </div>
            <div class="lcPageContentSort__item">
                <span>Способ оплаты:</span>
                <select name="sort" class="select-css" id="filter-with-paySystem">
                    <option value="views_desc">Выбрать</option>
                    @foreach($paySystems as $paySystem)
                        <option value="{{ $paySystem->id }}">{{ $paySystem->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="lcPageContentSort__item">
                <span>Период:</span>
                <input type="text" data-range="true" data-multiple-dates-separator=" - " class="datepicker-here"  style="width: 210px;"/>
{{--                <input type="text" id="filter-with-dateRange">--}}
            </div>
            <button class="lcPageContentSort__btn btn">Применить</button>
        </div>

        {{-- Таблица истории --}}
        <div class="lcPageContentTable lcPageContentTable-pay" id="finance-history">
            <div class="lcPageContentRow" id="finance-history-table-title">
                <div class="lcPageContentCol" style="width: 75px;">
                    @lang('buyer/finance/history.personal.table_titles.row_num')
                </div>
                <div class="lcPageContentCol">
                    @lang('buyer/finance/history.personal.table_titles.type')
                </div>
                <div class="lcPageContentCol">
                    @lang('buyer/finance/history.personal.table_titles.pay_system')
                </div>
                <div class="lcPageContentCol" style="width: 150px;">
                    @lang('buyer/finance/history.personal.table_titles.amount')
                </div>
                <div class="lcPageContentCol">
                    @lang('buyer/finance/history.personal.table_titles.date')
                </div>
            </div>

            {{-- Пагинатор --}}
            <div id="finance-history-paginator" style="margin-bottom: 1rem; margin-top: 1rem;"></div>
        </div>
    </div>

    <div class="popUp popUp-pay">
        <div class="popUp__content">
            <div class="popUp__title">
                Пополнение<br/>
                банковские карты
            </div>
            <form id="cardform" name="cardform" action="{{ route('buyer.finance.deposit_via_card') }}" method="POST" class="cartBlockPay">
                <div class="cardform__row">
                    <div class="cardform__row__col1">
                        <label for="card">Номер карты</label>
                        <input type="text" class="input-card-full" name="card" id="card" placeholder="0000 0000 0000 0000">
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
                        <input type="password" class="input-card-full" placeholder="cvv" maxlength="3" name="cvv" id="cvv">
                    </div>
                    <input type="hidden" id="payinAmount" name="amount">
                    <input type="hidden" id="paySystem" name="pay_system">
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
        <script>
            const historyPersonalBinds = @json($historyPersonalBinds);
        </script>

        <script src="{{ asset('vendors/air-datepicker-master/dist/js/datepicker.min.js') }}"></script>
        <script src="{{ asset('js/helpers.js') }}"></script>
        <script src="{{ asset('js/dashboard/buyer/finance/history.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

        <script src="{{ asset('js/dashboard/buyer/pay_in_out.js') }}"></script>

        <script>
            let cc = cardform.card;
            let month = cardform.month;
            let year = cardform.year;
            let cvv = cardform.cvv;

            for (let i in ['input', 'change', 'blur', 'keyup']) {
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
                errorElement       : "div",
                errorElementClass  : "error",
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


                rules        : {
                    card  : {
                        required  : true,
                        creditcard: true
                    },
                    month : {
                        required: true,
                        number  : true,
                        max     : 12
                    },
                    year  : {
                        required: true,
                        number  : true,
                        min     : 19,
                        max     : 30
                    },
                    cvv   : {
                        required : true,
                        number   : true,
                        maxlength: 3
                    },
                    amount: {
                        required: true,
                        number  : true,
                    }
                },
                messages     : {
                    card : '- Номер карты указан неправильно',
                    month: '- Месяц указан неправильно',
                    year : '- Год указан неправильно',
                    cvv  : '- CVV-код указан неправильно',
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