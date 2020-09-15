(function () {
    const minPrice = $("#filter-price-min");
    const maxPrice = $("#filter-price-max");

    const initMinPrice = parseInt(minPrice.val());
    const initMaxPrice = parseInt(maxPrice.val());

    let catalogSortElem;

    let initParams = {
        prices    : {
            min: initMinPrice,
            max: initMaxPrice,
        },
        attributes: []
    };

    let query = "";

    const markSelectedAttributes = () => {
        const params = parseParams();

        initStatesOfFilters(params, () => {
            console.log(initParams);
            initPriceRangeComponent();
            initAttributes();
        });

        initStatesOfSort(params);
    };

    /**
     * Распарсить get-параметры в JSON
     *
     * @returns {{}}
     */
    const parseParams = () => {
        const params = {};

        const locationSearch = window.location.search
            .replace("?", "")
            .replace(/\%22/g, "\"");

        if (!locationSearch.length) return params;

        const split = locationSearch.split("&");

        split.forEach(item => {
            item = item.split("=");
            params[item[0]] = JSON.parse(item[1]);
        });

        return params;
    };

    /**
     * Инициализация фильтров
     *
     * @param params
     * @param cb
     */
    const initStatesOfFilters = (params, cb) => {
        if (!params.hasOwnProperty("filter")) {
            if (undefined !== cb) cb();
            return;
        }

        getInitPriceRange(params["filter"]);
        getInitAttributes(params["filter"]);

        if (undefined !== cb) cb();
    };

    /**
     * Инициализация сортировки
     *
     * @param params
     */
    const initStatesOfSort = (params,) => {
        if (!params.hasOwnProperty("sort")) return;

        const column = Object.keys(params["sort"])[0];
        const direction = params["sort"][column];

        catalogSortElem.val(`${column}_${direction}`);
    };

    /**
     * Инициализация диапазона цен
     *
     * @param filter
     */
    const getInitPriceRange = (filter) => {
        if (!filter.hasOwnProperty("prices")) return;

        const prices = filter["prices"].split("-");

        initParams.prices.min = parseInt(prices[0]);
        initParams.prices.max = parseInt(prices[1]);
    }

    /**
     * Инициализация чекбоксов
     *
     * @param filter
     */
    const getInitAttributes = (filter) => {
        if (!filter.hasOwnProperty("attributes")) return;

        initParams.attributes = filter["attributes"].split(",");
    };

    /**
     * Инициализация компонента диапазона цен
     */
    const initPriceRangeComponent = () => {
        minPrice.val(initParams.prices.min);
        maxPrice.val(initParams.prices.max);

        $(".filterRange").slider({
            range : true,
            values: [initParams.prices.min, initParams.prices.max],
            step  : 1,
            min   : initMinPrice,
            max   : initMaxPrice,
            slide : function slide(event, ui) {
                minPrice.val(ui.values[0]);
                maxPrice.val(ui.values[1]);
            }
        });
    };

    /**
     * Инициализация атрибутов фильтра
     */
    const initAttributes = () => {
        $(".catalog-filter input[type=checkbox]").each(function () {
            const exists = initParams.attributes.indexOf($(this).val()) > -1;
            $(this).prop("checked", exists);
        });
    };

    /***** СБОРКА ПАРАМЕТРОВ ФИЛЬТРАЦИИ И СОРТИРОВКИ *****/

    /**
     * Составить фильтр
     *
     * @returns {string|string}
     */
    const buildFilter = () => {
        let filter = {};

        const prices = getPrices();
        if (prices.length) {
            filter["prices"] = prices;
        }

        const attributes = getAttributes();
        if (attributes.length) {
            filter["attributes"] = attributes;
        }

        return Object.keys(filter).length
            ? `filter=${JSON.stringify(filter)}`
            : "";
    };

    /**
     * Составить сортировку
     *
     * @returns {string}
     */
    const buildSort = () => {
        let sort = catalogSortElem.val().split("_");

        const sortObj = {};

        sortObj[sort[0]] = sort[1];

        sort = JSON.stringify(sortObj);

        return `sort=${sort}`;
    };

    const clearQuery = () => {
        query = "";
    };

    const appendToQuery = (params) => {
        if (!params.length) return;

        query += !query.length ? `?${params}` : `&${params}`;
    };

    /**
     * Цены
     */
    const getPrices = () => {
        const min = parseInt(minPrice.val());
        const max = parseInt(maxPrice.val());

        if (min !== initMinPrice || max !== initMaxPrice) {
            return `${min}-${max}`;
        }

        return "";
    };

    /**
     * Атрибуты фильтрации
     */
    const getAttributes = () => {
        let attributes = [];

        $(".catalog-filter input[type=checkbox]:checked").each(function () {
            attributes.push($(this).val());
        });

        return attributes.join(",");
    };

    $(document).ready(function () {
        catalogSortElem = $("#catalogSort");

        catalogSortElem.on("change", function () {
            $("#filter-form").submit();
        });

        markSelectedAttributes();

        $("#filter-form").on("submit", function (e) {
            e.preventDefault();

            clearQuery();
            appendToQuery(buildFilter());
            appendToQuery(buildSort());

            window.location.href = query;
        });
    });
}());