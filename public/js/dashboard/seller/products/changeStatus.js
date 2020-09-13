(function () {
    let loading = false;

    /**
     * Изменить статусы отмеченным товарам
     *
     * @param route
     */
    const setStatusForChecked = (route) => {
        const products = getCheckedProducts();
        if (!products.length) {
            toastr.error("Не выбран товар");
            return;
        }

        if (loading) return;
        loading = true;

        axios.patch(route, {products})
            .then(() => {
                toastr.success("Статус успешно изменен!");
                window.setTimeout(() => {
                    window.location.reload();
                }, 1000);
            })
            .catch(error => {
                console.log(error);
            })
            .finally(() => {
                loading = false;
            });
    };

    /**
     * Изменить статусы всем товарам
     *
     * @param route
     */
    const setStatusForAll = (route) => {
        if (loading) return;
        loading = true;

        axios.patch(route, {})
            .then(() => {
                toastr.success("Статус успешно изменен!");
                window.setTimeout(() => {
                    window.location.reload();
                }, 1000);
            })
            .catch(error => {
                console.log(error);
            })
            .finally(() => {
                loading = false;
            });
    };

    const destroyForChecked = (route) => {
        const products = getCheckedProducts();
        if (!products.length) {
            toastr.error("Не выбран товар для удаления");
            return;
        }

        if (!confirm("Вы действительно хотите удалить выбранные товары?")) return;

        if (loading) return;
        loading = true;

        axios.patch(route, {products})
            .then(() => {
                toastr.success("Удаление успешно завершено!");
                window.setTimeout(() => {
                    window.location.reload();
                }, 1000);
            })
            .catch(error => {
                console.log(error);
            })
            .finally(() => {
                loading = false;
            });
    };

    /**
     * Выделенные продукты
     *
     * @returns {[]}
     */
    const getCheckedProducts = () => {
        const products = [];

        $('.product-chek:checked').each(function () {
            products.push(parseInt($(this).val()));
        });

        return products;
    }

    $(document).ready(function () {
        /**
         * Изменить статусы отмеченным товарам
         */
        $("#js_product_enable, #js_product_disable").on("click", function () {
            setStatusForChecked($(this).data("route"));
        });

        /**
         * Изменить статусы всем товарам
         */
        $("#js_product_enable_all, #js_product_disable_all").on("click", function () {
            setStatusForAll($(this).data("route"));
        });

        $("#js_product_destroy").on("click", function () {
            destroyForChecked($(this).data("route"));
        });
    });
}());