(function () {
    let loading = false;

    let payinMethod;
    let payoutMethod;
    let isTotalAmount = false;

    let accountPayinCost;
    let accountPayinCostPercent;
    let accountPayoutCost;
    let accountPayoutCostPercent;

    const debounce = 500;
    let timeout;

    /**
     * Выбор платежной системы пополенния
     */
    const watchPayinMethods = () => {
        payinMethod = $("#payin input[type=radio]:checked").data("id");

        $(".payinMethods").on("click", function () {
            payinMethod = $("#payin input[type=radio]:checked").data("id");
            calcPayinFee();
        });
    };

    /**
     * Выбор платежной системы снятия
     */
    const watchPayoutMethods = () => {
        payoutMethod = $("#payout input[type=radio]:checked").data("id");

        $(".payoutMethods").on("click", function () {
            payoutMethod = $("#payout input[type=radio]:checked").data("id");
            calcPayoutFee();
        });
    };

    /**
     * Пополнение
     */
    const watchForPayin = () => {
        accountPayinCost = $("#account_payin_cost");
        accountPayinCostPercent = $("#account_payin_cost_percent");

        /**
         * Ввод суммы пополнения (без комиссии)
         */
        accountPayinCost.on("keyup mouseup", function () {
            clearTimeout(timeout);

            timeout = window.setTimeout(() => {
                isTotalAmount = false;
                calcPayinFee();
            }, debounce);
        });

        /**
         * Ввод суммы пополнения (с учетом комиссии)
         */
        accountPayinCostPercent.on("keyup mouseup", function () {
            clearTimeout(timeout);

            timeout = window.setTimeout(() => {
                isTotalAmount = true;
                calcPayinFee();
            }, debounce);
        });
    };

    /**
     * Вывод
     */
    const watchForPayout = () => {
        accountPayoutCost = $("#account_payout_cost");
        accountPayoutCostPercent = $("#account_payout_cost_percent");

        /**
         * Ввод суммы снятия (без комиссии)
         */
        accountPayoutCost.on("keyup mouseup", function () {
            clearTimeout(timeout);

            timeout = window.setTimeout(() => {
                isTotalAmount = false;
                calcPayoutFee();
            }, debounce);
        });

        /**
         * Ввод суммы снятия (с учетом комиссии)
         */
        accountPayoutCostPercent.on("keyup mouseup", function () {
            clearTimeout(timeout);

            timeout = window.setTimeout(() => {
                isTotalAmount = true;
                calcPayoutFee();
            }, debounce);
        });
    };

    /**
     * Получить сумму пополнения с комиссией
     */
    const calcPayinFee = () => {
        if (loading || (!accountPayinCost.val().length && !accountPayinCostPercent.val().length)) return;
        loading = true;

        $('.payinMethods').addClass("disabled");

        hideErrors();

        const amount = isTotalAmount ? parseInt(accountPayinCostPercent.val()) : parseInt(accountPayinCost.val());

        const data = {
            amount         : amount || 0,
            method         : parseInt(payinMethod),
            is_total_amount: isTotalAmount
        };

        axios.post('/comission/payin', data)
            .then(response => {
                if (isTotalAmount) {
                    $("#payinAmount").val(data.amount);
                    accountPayinCost.val(response.data.amount);
                    return;
                }

                $("#payinAmount").val(response.data.amount);
                accountPayinCostPercent.val(response.data.amount);
            })
            .catch(error => {
                showErrors(error);
            })
            .finally(() => {
                loading = false;
                $('.payinMethods').removeClass("disabled");
            });
    };

    /**
     * Получить сумму снятия с комиссией
     */
    const calcPayoutFee = () => {
        if (loading || (!accountPayoutCost.val().length && !accountPayoutCostPercent.val().length)) return;
        loading = true;

        $('.payoutMethods').addClass("disabled");

        hideErrors();

        const amount = isTotalAmount ? parseInt(accountPayoutCostPercent.val()) : parseInt(accountPayoutCost.val());

        const data = {
            amount         : amount || 0,
            method         : parseInt(payoutMethod),
            is_total_amount: isTotalAmount
        };

        axios.post('/comission/payout', data)
            .then(response => {
                if (isTotalAmount) {
                    accountPayoutCost.val(response.data.amount);
                    return;
                }

                accountPayoutCostPercent.val(response.data.amount);
            })
            .catch(error => {
                showErrors(error);
            })
            .finally(() => {
                loading = false;
                $('.payoutMethods').removeClass("disabled");
            });
    };

    /**
     * Скрыть ошибки
     */
    const hideErrors = () => {
        $(".error")
            .text("")
            .hide()
    };

    /**
     * Отобразить ошибки
     *
     * @param error
     */
    const showErrors = (error) => {
        switch (error.response.status) {
            case 422: {
                for (const key in error.response.data.errors) {
                    $("#paymentErrors")
                        .append(`${error.response.data.errors[key][0]}<br/>`)
                        .show();
                }
                break;
            }
        }
    };

    $(document).ready(function () {
        watchPayinMethods();
        watchPayoutMethods();

        watchForPayin();
        watchForPayout();
    });
}());