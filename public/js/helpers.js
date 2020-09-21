const Helpers = (function () {
    return {
        /**
         * Биндинг значений в шаблон
         *
         * @param template
         * @param data
         * @returns {*}
         */
        templateParser: function (template, data) {
            return template.replace(/\{(\w*)\}/g, function (m, key) {
                return data.hasOwnProperty(key) ? data[key] : m;
            });
        },

        url: {
            /**
             * Добавить параметры
             *
             * @param url
             * @param param
             * @param value
             * @returns {*}
             */
            addParams: function (url, param, value) {
                url = url.replace(new RegExp(`\&?\\??${param}\=[^&]+`), "");

                if (undefined !== value && value.length) {
                    url += (url.indexOf("?") >= 0 ? "&" : "?") + `${param}=${value}`;
                } else {
                    // url = url.replace(new RegExp(`&?${key}\=[^&]+`), "");
                }

                return url;
            }
        }
    }
}());