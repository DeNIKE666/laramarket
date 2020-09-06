const MaskedPhone = (function () {
    return {
        getMeta: (phoneElem) => {
            let data = {
                country: "",
                mask   : ""
            };

            if (!phoneElem.val().length) return data;

            const meta = phoneElem.inputmask("getmetadata");
            if (!Object.keys(meta).length) return data;

            data.country = meta.name_ru;
            data.mask = meta.mask;

            return data;
        }
    };
}());