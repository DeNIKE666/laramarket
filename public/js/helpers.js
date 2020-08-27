const Helpers = (function () {
    return {
        /**
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
    }
}());