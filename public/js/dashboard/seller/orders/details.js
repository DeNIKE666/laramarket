(function () {
    let loading = false;

    const orderDetailsTpl = `
        <form>            
            <div class="cardform__row">
                <div class="cardform__row__col1 order-details">
                    <div class="order-num">№ {orderId} от {orderCreated}</div>
                    <div class="order-status">{orderStatus} {orderStatusDate}</div>
                
                    <div class="section-title">
                        Товары в заказе
                    </div>
                    <div>
                        <table class="products-list">
                            <thead>
                                <tr>
                                    <th rowspan="2">Наименование</th>
                                    <th rowspan="2">Кол-во</th>
                                    <th rowspan="2">Комиссия</th>
                                    <th rowspan="2">Цена за 1 ед.</th>
                                    <th colspan="3">Сумма</th>
                                </tr>
                                <tr>
                                    <th>Без<br/>комиссии</th>
                                    <th>Комиссия<br/>сервиса</th>
                                    <th>К<br/>выплате</th>
                                </tr>
                            </thead>
                            {orderProducts}
                        </table>
                    </div>
                    
                    <div class="section-title">
                        Доставка
                    </div>
                    <div>
                        <table class="table-align-right">
                            <tr>
                                <td>Получатель:</td>
                                <td>{deliveryName}</td>
                            </tr>
                            <tr>
                                <td>Телефон:</td>
                                <td>{deliveryPhone}</td>
                            </tr>
                            <tr>
                                <td>Адрес:</td>
                                <td>{deliveryAddress}</td>
                            </tr>
                            <tr>
                                <td>Служба доставки:</td>
                                <td>{deliveryService}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="section-title">
                        Оплата
                    </div>
                    <div>
                        <table class="table-align-right">
                            <tr>
                                <td>Способ оплаты:</td>
                                <td>{payMethod}</td>
                            </tr>
                            <tr>
                                <td>Статус:</td>
                                <td>{payStatus}</td>
                            </tr>
                            <tr>
                                <td>Дата:</td>
                                <td>{payDate}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div style="margin: 2rem auto 0 auto; width: 200px;">
                <button type="button" class="btn lcPageMenu__btn">Закрыть</button>
            </div>
        </form>
    `;

    /**
     * Показать модальное окно
     */
    const showOrderDetailsPopup = (url) => {
        $("#popup-orderDetails .popUp__body").html("");

        $("#popup-orderDetails").fadeIn("normal", function () {
            getOrderDetails(url, (details) => {
                details = details.data;

                $("#popup-orderDetails .popUp__body").html(
                    Helpers.templateParser(
                        orderDetailsTpl,
                        {
                            //Шапка
                            orderId        : details["orderId"],
                            orderCreated   : details["orderCreated"]["formatted"],
                            orderStatus    : details["orderStatus"]["formatted"],
                            orderStatusDate: details["orderStatusDate"]["formatted"],

                            //Список товаров
                            orderProducts: renderProducts(details["products"], details["productsTotalPrices"]),

                            //Доставка
                            deliveryName   : details["deliveryName"],
                            deliveryPhone  : details["deliveryPhone"],
                            deliveryAddress: details["deliveryAddress"],
                            deliveryService: details["deliveryService"]["formatted"],

                            //Оплата
                            payMethod: details["payMethod"],
                            payStatus: details["payStatus"]["formatted"],
                            payDate  : details["payDate"]["formatted"]
                        }
                    )
                );
            });
        });
    };

    /**
     * Скрыть модальное окно
     */
    const hideOrderDetailsPopup = () => {
        $('#popup-changeOrderStatus').fadeOut("normal", function () {
            window.location.reload();
        });
    };

    /**
     * Получить детали заказа
     *
     * @param url
     * @param cb
     */
    const getOrderDetails = (url, cb) => {
        if (loading) return;
        loading = true;

        axios.get(url)
            .then(response => {
                console.log(response);
                if (undefined !== cb) cb(response.data);
            })
            .catch(error => {
                console.log(error);
            })
            .finally(() => {
                loading = false;
            });
    };

    /**
     * Список товаров и Итого
     *
     * @param products
     * @param productsTotalPrices
     * @returns {string}
     */
    const renderProducts = (products, productsTotalPrices) => {
        let rows = "<tbody>";

        for (const i in products) {
            rows += `
                <tr>
                    <td>${products[i]["title"]}</td>
                    
                    <td class="text-center">${products[i]["quantity"]}</td>

                    <td class="text-center">${products[i]["percent_fee"]["formatted"]}</td>
                    
                    <td class="text-center">${products[i]["price"]["without_fee"]["formatted"]}</td>
                    
                    <td class="text-center">${products[i]["sum"]["without_fee"]["formatted"]}</td>
                    <td class="text-center">${products[i]["sum_fee"]["formatted"]}</td>
                    <td class="text-center">${products[i]["sum"]["with_fee"]["formatted"]}</td>
                </tr>
            `;
        }

        rows += "</tbody>";

        //Итого
        rows += `
            <tfoot>
                <tr>
                    <td colspan="3">
                        Итого:
                    </td>
                    <td class="text-center">
                        ${productsTotalPrices["price"]["without_fee"]["formatted"]}
                    </td>
                    
                    <td class="text-center">
                        ${productsTotalPrices["sum"]["without_fee"]["formatted"]}
                    </td>
                    <td class="text-center">
                        ${productsTotalPrices["sum_fee"]["formatted"]}
                    </td>
                    <td class="text-center">
                        ${productsTotalPrices["sum"]["with_fee"]["formatted"]}
                    </td>
                </tr>
            </tfoot>
        `;

        return rows;
    };

    $(document).ready(function () {
        $(".order-showDetails").on("click", function (e) {
            e.preventDefault();
            showOrderDetailsPopup($(this).data("url"));
        });
    });
}());