(function () {
    let loading = false;

    let historyUrl = "";

    const rowsHistoryTpl = `
        <div class="lcPageContentRow finance-history-table-rows">
            <div class="lcPageContentCol" style="width: 75px;">{row_num}</div>
            <div class="lcPageContentCol">{type}</div>
            <div class="lcPageContentCol">{pay_system}</div>
            <div class="lcPageContentCol" style="width: 150px;">{amount}</div>
            <div class="lcPageContentCol">{date}</div>
        </div>
    `;

    /**
     * Получить данные
     *
     * @param url
     */
    const loadHistory = () => {
        if (loading) return;
        loading = true;

        axios.get(historyUrl)
            .then(response => {
                fillTable(response["data"]);
            })
            .catch(error => {
                console.log(error);
            })
            .finally(() => {
                loading = false;
            });
    };

    /**
     * Заполнить таблицу
     *
     * @param data
     */
    const fillTable = (data) => {
        const meta = data["meta"];
        const collection = data["collection"];
        const paginator = data["paginator"];

        if (!collection.length) return;

        //Стартовый номер по порядку
        const startRow = (parseInt(meta["perPage"]) * parseInt(meta["currentPage"])) - parseInt(meta["perPage"]);

        let rows = "";

        for (const i in collection) {
            rows += Helpers.templateParser(rowsHistoryTpl, {
                row_num   : startRow + parseInt(i) + 1,
                type      : historyPersonalBinds["trans_type"][collection[i]["type"]],
                pay_system: collection[i]["pay_system"]["title"],
                amount    : collection[i]["amount"]["formatted"],
                date      : collection[i]["date"]["formatted"],
            });
        }

        //Удалить существующие строки и наполнить новыми
        $(".finance-history-table-rows").remove();
        $("#finance-history-table-title").after(rows);

        //Пагинатор
        $("#finance-history-paginator").html(paginator);

        initPaginator();
    };

    /**
     * Ининциализация событий перехвата пагинации
     */
    const initPaginator = () => {
        $("#finance-history-paginator a.pagItem").on("click", function (e) {
            e.preventDefault();
            const url = new URL($(this).attr("href"));
            const params = new URLSearchParams(url.search);

            // historyUrl = $(this).attr("href");
            historyUrl = Helpers.url.addParams(historyUrl, "page", params.get("page"));

            console.log(historyUrl);

            loadHistory();
        });
    };

    $(document).ready(function () {
        historyUrl = $(".show-history").attr("href");

        $(".show-history").on("click", function (e) {
            e.preventDefault();
            loadHistory();
        });

        $("#filter-with-transType").on("change", function () {
            // if ($(this).val().length) {
                historyUrl = Helpers.url.addParams(historyUrl, "trans_type", $(this).val());
            // }

            console.log(historyUrl);
        });
    });

}());