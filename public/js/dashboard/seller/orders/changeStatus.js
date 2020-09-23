(function () {
    let loading = false;

    const changeStatusTpl = `
        <form>
            <div class="error" id="order_commonError" style="display: none; padding: 0 0 1rem 0; text-align: center;"></div>
            
            <div class="cardform__row">
                <div class="cardform__row__col1">
                    <label for="order_status">Статус</label>
                    <select id="order_status" class="input-card-full" style="margin-bottom: 0;">
                        {options}
                    </select>
                    <div class="error" style="display: none; padding: 10px 0;"></div>
                </div>
            </div>
            <div class="cardform__row" style="margin-top: 0.5rem;">
                <div class="cardform__row__col1">
                    <label for="order_notes">Описание</label>
                    <textarea id="order_notes" class="input-card-full" style="height: 150px; margin-bottom: 0; resize: none;"></textarea>
                    <div class="error" style="display: none; padding: 10px 0;"></div>
                </div>
            </div>
            <div class="cardform__row" style="margin: 2rem auto 0 auto;">
                <button type="submit" class="btn lcPageMenu__btn form-submit">Сохранить</button>
            </div>
        </form>
    `;

    /**
     * Показать модальное окно с выбором статуса
     */
    const showChangeStatusPopup = (order) => {
        const orderId = order.data("id");
        const orderStatus = order.data("status");

        //Если статус заказа "Новый" или "Отправлен"
        if ([0, 3].indexOf(orderStatus) > -1) {
            $("#popup-changeOrderStatus .popUp__body")
                .html("На данном этапе нельзя<br/>изменить статус заказа")
                .css({
                    "text-align" : "center",
                    "line-height": "1.5rem",
                });
            $("#popup-changeOrderStatus").fadeIn();
            return;
        }

        const allowStatuses = getOrdersStatusByCurrentStatus(orderStatus);

        let form = "";
        let options = `<option value="">Не выбрано</option>`;

        for (const key in allowStatuses) {
            options += `<option value="${allowStatuses[key].status}">${allowStatuses[key].title}</option>`;
        }

        form = Helpers.templateParser(changeStatusTpl, {options});

        $("#popup-changeOrderStatus .popUp__body").html(form);

        $("#popup-changeOrderStatus").fadeIn("normal", function () {
            $("#popup-changeOrderStatus form").on("submit", function (e) {
                e.preventDefault();
                changeStatus(orderId);
            });
        });
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
     * Получить доступные статусы в зависимости от текущего
     *
     * @param status
     * @returns {[]}
     */
    const getOrdersStatusByCurrentStatus = (status) => {
        const allowStatuses = [];
        let allowStatusesKeys = [];

        switch (status) {
            //Оплачен
            case 1: {
                allowStatusesKeys = [2, 6];
                break;
            }
            //Отправлен
            case 2: {
                allowStatusesKeys = [3, 6];
                break;
            }
        }

        // Набить массив объектами (ключ/статус)
        for (const key in allowStatusesKeys) {
            const status = {
                status: allowStatusesKeys[key],
                title : ordersStatus[allowStatusesKeys[key]]
            };

            allowStatuses.push(status);
        }

        return allowStatuses;
    };

    /**
     * Изменить статус
     *
     * @param orderId
     */
    const changeStatus = (orderId) => {
        if (loading) return;
        loading = true;

        hideErrors();

        const data = {
            order_id: orderId,
            status  : $("#order_status").val(),
            notes   : $("#order_notes").val()
        };

        axios.patch(`/dashboard/seller/order/${orderId}/status`, data)
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
                    if (!$(`#order_${key} + .error`).length) {
                        $('#order_commonError')
                            .text(error.response.data.errors[key][0])
                            .show();
                    }

                    $(`#order_${key} + .error`)
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
        $(".order-changeStatus").on("click", function (e) {
            e.preventDefault();
            showChangeStatusPopup($(this));
        });
    });
}());