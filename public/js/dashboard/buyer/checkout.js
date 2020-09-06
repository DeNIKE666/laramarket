(function () {
    let loading = false;

    const getDeliveryProfiles = () => {
        if (loading) return;
        loading = true;

        axios.get()
    };

    /**
     * Получить meta-данные
     */
    const getMeta = () => {
        const phoneMask = MaskedPhone.getMeta($("#phone"));

        $("#helper-text-phone").text(phoneMask.country);
        $("#phone_mask").val(phoneMask.mask);
    };

    $(document).ready(function () {
        $("#phone")
            .inputmask("phone")
            .on("keyup", function () {
                getMeta();
            });

        window.setTimeout(() => {
            getMeta();
        }, 0);
    });
}());