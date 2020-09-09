(function ($) {
    $.fn.customSelect = function (options) {
        options = $.extend({
            onChange: () => {
            }
        }, options);

        let currentValue = {
            value: "",
            text : ""
        };

        const init = () => {
            const current = $(this).find(".custom-select-dropdown > span:first-child");

            if (!current.length) return;

            setCurrent(current);
        };

        const setCurrent = (clicked) => {
            //Выбрано сейчас
            const current = $(this).children("span");

            //Нажатое
            currentValue.value = clicked.data("value");
            currentValue.text = $.trim(clicked.text());

            current
                .text(currentValue.text)
                .data("value", currentValue.value);

            $(this).find(".custom-select-dropdown > span").show();
            clicked.hide();
        };

        $(this).on("click", function () {
            $(this).find(".custom-select-dropdown").fadeToggle("fast");
        });
        $(this).hover(function () {
        }, function () {
            $(this).find(".custom-select-dropdown").fadeOut("fast");
        });

        /**
         * Клик по пунктам
         */
        $(this).find(".custom-select-dropdown > span").on("click", function () {
            setCurrent($(this));
            options.onChange(currentValue);
        });

        init();

        return {
            getValue: () => {
                return currentValue;
            },
            setValue: (value) => {
                const find = $(this).find(`.custom-select-dropdown > span[data-value="${value}"]`);

                if (!find.length) return;

                setCurrent(find);
            }
        };
    };
})(jQuery);