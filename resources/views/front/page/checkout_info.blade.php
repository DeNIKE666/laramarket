@extends('layouts.app')

@section('content')
    @include('front.partials.breadcrumbs')
    <div class="block-cart">
        <div class="wrapper">
                <h1 class="title">Заказ #{{ $order->id }}</h1>

            {{ dd($amount) }}
            @include('front.partials.pay_methods')

            @push('styles')
                <link rel="stylesheet" href="{{ asset('css/common.css') }}">
            @endpush
            <form id="cardform" name="cardform"  action="{{ route('qiwi.order.pay', $order) }}" method="POST"  class="cartBlock cartAddress">
                <input type="text" class="input-card-full"  name="card" id="card"  placeholder="2222 2222 2222 2222">
                <input type="text" class="input-card-full"  name="month" id="month" placeholder="Месяц" maxlength="2">
                <input type="text" class="input-card-full" placeholder="Год" maxlength="2" name="year" id="year">
                <input type="text" class="input-card-full"  placeholder="Защитный код" maxlength="3" name="cvv" id="cvv">
                <input type="hidden" class="input-card-full"  name="amount" id="amount" value="{{ $order->price }}">
                <button class="btn lcPageMenu__btn form-submit " id="pay_button">Оплатить</button>

                <div class="mt-20 text-danger text-sm error-div" style="display: none">
                    <span>Исправьте ошибки, выделенные красной рамкой:</span>
                </div>
            </form>

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
                var cardCode = this.value.replace(/[^\d]/g, '').substring(0,18);
                cardCode = cardCode != '' ? cardCode.match(/.{1,4}/g).join(' ') : '';
                this.value = cardCode;
            }

            function formatMonth() {
                var month = this.value.replace(/[^\d]/g, '').substring(0,2);
                month = month != '' ? month.match(/.{1,2}/g) : '';
                this.value = month;
            }

            function formatYear() {
                var year = this.value.replace(/[^\d]/g, '').substring(0,2);
                year = year != '' ? year.match(/.{1,2}/g) : '';
                this.value = year;
            }
            function formatCvv() {
                var cvv = this.value.replace(/[^\d]/g, '').substring(0,3);
                cvv = cvv != '' ? cvv.match(/.{1,3}/g) : '';
                this.value = cvv;
            }


            $('form[id="cardform"]').validate({
                //wrapper: 'div',
                errorElement: "div",
                errorElementClass: "error",
                errorLabelContainer: '.error-div',

                //errorClass: "error",
                errorPlacement: function(error, element) {
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
                submitHandler: function(form) {
                    $("#pay_button").after('<img id="loader" src="img/spinner.gif">');
                    $("#pay_button").remove();
                    form.submit();
                }
            });
        </script>
    @endpush

@endsection
