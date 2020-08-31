(function () {
    let loading = false;

    /**
     * Показать модальное окно
     */
    const showPopup = () => {
        $("#popup-transferToPersonalAccount").fadeIn("normal", function () {
            $("#transferToPersonalAccount_amount").focus();
        });
    };

    /**
     * Скрыть модальное окно
     */
    const hidePopup = () => {
        $('#popup-transferToPersonalAccount').fadeOut("normal", function () {
            window.location.reload();
        });
    };

    /**
     * Перевести
     */
    const transferToPersonalAccount = () => {
        if (loading) return;
        loading = true;

        hideErrors();

        const data = {
            amount: $("#transferToPersonalAccount_amount").val()
        };

        axios.patch("/dashboard/partner/account/transfer-to-personal-account", data)
            .then(response => {
                hidePopup();
            })
            .catch(error => {
                showErrors(error);
            })
            .finally(() => {
                loading = false;
            });
    };

    /**
     * Скрыть ошибки
     */
    const hideErrors = () => {
        $("#popup-transferToPersonalAccount .error")
            .text("")
            .hide()
    };

    /**
     * Отобразить ошибки
     *
     * @param error
     */
    const showErrors = (error) => {
        switch (error.response.status) {
            case 422: {
                for (const key in error.response.data.errors) {
                    if (!$(`#transferToPersonalAccount_${key} + .error`).length) {
                        $('#transferToPersonalAccount_commonError')
                            .text(error.response.data.errors[key][0])
                            .show();
                    }

                    $(`#transferToPersonalAccount_${key} + .error`)
                        .text(error.response.data.errors[key][0])
                        .show();
                }
                break;
            }
            case 400:
            case 403: {
                $('#transferToPersonalAccount_commonError')
                    .text(error.response.data.message)
                    .show()
                break;
            }
        }
    };

    $(document).ready(function () {
        $("#openForm-transferToPersonalAccount").on("click", () => {
            showPopup();
        });

        $("#form-transferToPersonalAccount").on("submit", (e) => {
            e.preventDefault();

            transferToPersonalAccount();
        });
    });
}());