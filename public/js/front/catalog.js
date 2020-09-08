(function () {
    const initMinPrice = $("#filter-price-min").val();
    const initMaxPrice = $("#filter-price-max").val();

    let query = "";

    const clearQuery = () => {
        query = "";
    };

    const appendToQuery = (params) => {
        query += !query.length ? `?${params}` : `&${params}`;
    };

    /**
     * Цены
     */
    const setPrices = () => {
        const minPrice = $("#filter-price-min").val();
        const maxPrice = $("#filter-price-max").val();

        if (minPrice !== initMinPrice || maxPrice !== initMaxPrice) {
            let params = `min_price=${minPrice}&max_price=${maxPrice}`;
            appendToQuery(params);
        }
    };

    /**
     * Атрибуты фильтрации
     */
    const setAttributes = () => {
        let attributes = [];

        $(".catalog-filter input[type=checkbox]:checked").each(function () {
            attributes.push($(this).val());
        });

        if (!attributes.length) return;

        attributes = attributes.join(";");

        let params = `attributes=${attributes}`;
        appendToQuery(params);
    };

    $(document).ready(function () {
        $("#filter-form").on("submit", function (e) {
            e.preventDefault();

            clearQuery();

            setPrices();
            setAttributes();

            window.location.href=query;
        });
    });
}());