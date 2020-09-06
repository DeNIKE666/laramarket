$(document).ready(function() {
    $('.textarea').ckeditor();
    $('.select').select2();

    function getIdProducts() {
        if ($('.product-chek:checked').length > 0) {
            let checked = [];
            $('.product-chek:checked').each(function() {
                checked.push($(this).val());
            });
            return checked;
        } else {
            toastr.error("Не выбран товар");
            return false;
        }
    }

    $('#js_product_disable, #js_product_activate').on('click', function () {
        //console.log(getIdProducts());
        if($('.product-chek:checked').length > 0) {
            let checked = [];
            $('.product-chek:checked').each(function() {
                checked.push($(this).val());
            });
            $.ajax({
                method: "PATCH",
                headers: {
                    Accept: "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $(this).data('route'),
                data: {ids : checked},
                success: () => {
                    toastr.success("изменения сохранены");
                    setTimeout(function() {
                        window.location.reload();
                    }, 500);
                },
                error: (response) => {

                    if(response.status === 422) {
                        let errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(function (key) {
                            /*$("#" + key + "Input").addClass("is-invalid");
                            $("#" + key + "Error").text(errors[key][0]);*/
                        });
                    } else {
                        window.location.reload();
                    }

                }
            });
        } else {
            toastr.error("Не выбран товар");
            return false;
        }

    });

    $('#js_product_delete').on('click', function () {
        if(confirm('Точно удалить?')) {
            if($('.product-chek:checked').length > 0) {
                let checked = [];
                $('.product-chek:checked').each(function() {
                    checked.push($(this).val());
                });
                $.ajax({
                    method: "DELETE",
                    headers: {
                        Accept: "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: $(this).data('route'),
                    data: {ids : checked},
                    success: () => {
                        toastr.success("изменения сохранены");
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
                    },
                    error: (response) => {

                        if(response.status === 422) {
                            let errors = response.responseJSON.errors;
                            Object.keys(errors).forEach(function (key) {
                                /*$("#" + key + "Input").addClass("is-invalid");
                                $("#" + key + "Error").text(errors[key][0]);*/
                            });
                        } else {
                            window.location.reload();
                        }

                    }
                });
            } else {
                toastr.error("Не выбран товар");
                return false;
            }
        }
    });
});