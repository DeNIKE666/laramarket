(function () {
    let loading = false;

    let orderId;
    let orderStatus;
    let payoutPeriod;

    /**
     * Показать модальное окно с выбором статуса
     */
    const showChangeStatusPopup = (order) => {
        orderId = order.data("id");
        orderStatus = order.data("status");

        showStatusConfirm();

        $('#popup-changeOrderStatus').fadeIn();
    };

    /**
     * Показать подтверждение получения товара
     */
    const showStatusConfirm = () => {
        $("#popup-changeOrderStatus .popUp__title").text("Подтвердите действие");
        $("#popup-changeOrderStatus .popUp__body p").html(getPopupMessage());

        $("#statusConfirm").show();
        $('#selectPayoutPeriod').hide();
    };

    /**
     * Показать выбор периода
     */
    const showSelectPayoutPeriod = () => {
        $("#popup-changeOrderStatus .popUp__title").text("Выберите период выплат");
        $("#statusConfirm").hide();
        $('#selectPayoutPeriod').show();
    };

    /**
     * Сообщение в модалке в зависимости от статуса
     *
     * @param status
     * @returns {string}
     */
    const getPopupMessage = () => {
        switch (orderStatus) {
            //Товар получен
            case 4: {
                return "Товар/услуга получены,<br/>претензий к продавцу не имею";
            }
            //Отмена со стороны покупателя
            case 5: {
                return "Отмена заказа";
            }
            default : {
                return "";
            }
        }
    };

    /**
     * Скрыть модальное окно
     */
    const hideChangeStatusPopup = () => {
        $('#popup-changeOrderStatus').fadeOut("normal", function () {
            window.location.reload();
        });
    };

    /**
     * Изменить статус
     */
    const changeStatus = () => {
        if (loading) return;
        loading = true;

        hideErrors();

        const data = {
            order_id: orderId,
            status  : orderStatus,
            period  : payoutPeriod
        };

        axios.patch(`/dashboard/buyer/order/${orderId}/status`, data)
            .then(response => {
                hideChangeStatusPopup();
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
        $("#popup-changeOrderStatus .error")
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
                    $('#order_commonError')
                        .text(error.response.data.errors[key][0])
                        .show();
                }
                break;
            }
            case 403:
            case 404: {
                $('#order_commonError')
                    .text(error.response.data.message)
                    .show()
                break;
            }
        }
    };

    $(document).ready(function () {
        $(".order-changeStatus").on("click", function () {
            showChangeStatusPopup($(this));
        });

        $("#statusConfirm_button").on("click", function () {
            //Отмена со стороны покупателя
            if (orderStatus === 5) {
                changeStatus();
            } else {
                showSelectPayoutPeriod();
            }
        });

        $(".selectPayoutPeriod").on("click", function () {
            payoutPeriod = $(this).data("period");
            changeStatus();
        });
    });
}());