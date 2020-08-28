(function () {
    let loading = false;

    let method;
    let isTotalAmount = false;

    let accountRefillCost;
    let accountRefillCostPercent;

    const debounce = 500;
    let timeout;

    const calcPayinFee = () => {
        if (loading) return;
        loading = true;

        hideErrors();

        const amount = isTotalAmount ? parseInt(accountRefillCostPercent.val()) : parseInt(accountRefillCost.val());

        const data = {
            amount         : amount || 0,
            method         : parseInt(method),
            is_total_amount: isTotalAmount
        };

        axios.post('/comission/payin', data)
            .then(response => {
                if (isTotalAmount) {
                    accountRefillCost.val(response.data.amount);
                    return;
                }

                accountRefillCostPercent.val(response.data.amount);
            })
            .catch(error => {
                showErrors(error);
            })
            .finally(() => {
                loading = false;
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
        accountRefillCost = $("#account_refill_cost");
        accountRefillCostPercent = $("#account_refill_cost_percent");
        method = $("#payRefill input[type=radio]:checked").data("id");

        /**
         * Выбор способа оплаты
         */
        $(".payMethods").on("click", function () {
            method = $("#payRefill input[type=radio]:checked").data("id");
            calcPayinFee();
        });

        /**
         * Ввод суммы пополнения (без комиссии)
         */
        accountRefillCost.on("keyup mouseup", function () {
            if (!$(this).val().length) return;

            clearTimeout(timeout);

            timeout = window.setTimeout(() => {
                isTotalAmount = false;
                calcPayinFee();
            }, debounce);
        });

        /**
         * Ввод суммы пополнения (с учетом комиссии)
         */
        accountRefillCostPercent.on("keyup mouseup", function () {
            if (!$(this).val().length) return;

            clearTimeout(timeout);

            timeout = window.setTimeout(() => {
                isTotalAmount = true;
                calcPayinFee();
            }, debounce);
        });
    });
}());