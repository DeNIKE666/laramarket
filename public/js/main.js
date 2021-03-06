$(function () {
    /**
     * Регистрация
     */
    $("registerForm").on("submit", function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        let formUrl = $(this).attr("action");
        let successUrl = $(this).data("success");
        $(".invalid-feedback").text("");
        $("#registerForm input").removeClass("is-invalid");
        $.ajax({
            method : "POST",
            headers: {
                Accept: "application/json"
            },
            url    : formUrl,
            data   : formData,
            success: () => {
                window.location.replace(successUrl)
            },
            error  : error => {
                if (error.status === 422) {
                    let errors = error.responseJSON.errors;
                    Object.keys(errors).forEach(function (key) {
                        $("#" + key + "Input").addClass("is-invalid");
                        $("#" + key + "Error").text(errors[key][0]);
                    });
                } else {
                    window.location.reload();
                }
            }
        })
    });

    /**
     * Авторизация
     */
    $("#loginForm").on("submit", function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        let formUrl = $(this).attr("action");
        $(".invalid-feedback").text("");
        $("#registerForm input").removeClass("is-invalid");
        $.ajax({
            method : "POST",
            headers: {
                Accept: "application/json"
            },
            url    : formUrl,
            data   : formData,
            success: response => {
                window.location.href = response.redirect
            },
            error  : error => {
                if (error.status === 422) {
                    let errors = error.responseJSON.errors;
                    Object.keys(errors).forEach(function (key) {
                        $("#" + key + "Input2").addClass("is-invalid");
                        $("#" + key + "Error2").text(errors[key][0]);
                    });
                } else {
                    window.location.reload();
                }
            }
        })
    });

    // $('#account_refill_cost').on('change', function(){
    //      let choose = $('#payRefill').find('input[name="choose"]:checked').data('percent') / 100;
    //     $('#account_refill_cost_percent').val(Number($('#account_refill_cost').val()) + $('#account_refill_cost').val() * choose);
    // });

    $('#payModal').on('click', function () {
        $('.popUp-pay').fadeIn();
    });


    $(function () {
        $('#js_cart').on('click', '.js_minus_product', function () {
            let quantity_product = $(this).parent().find('.cartContent__quantity');
            if (parseInt($(quantity_product).html()) > 1) {
                let quantity = parseInt($(quantity_product).text()) - 1;
                $(quantity_product).html(quantity);
                $.ajax({
                    method : "POST",
                    headers: {
                        Accept        : "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url    : $('#js_cart').data('update'),
                    data   : {
                        'action': 'minus',
                        'id'    : $(this).data('id')
                    },
                    success: function (data) {
                        if (data.msg === 'ok') {
                            //console.log(data);
                            $('.cartContent__item--id' + data.product_id).find('.cartContent__price').html(data.product_price + ' рублей');
                            $('#totalPrice').html(data.total_price + ' рублей');
                            $('#js_cart_numb').html(data.total_quantity);
                        }
                    }
                });
            }
        });
    });

    $('#js_cart').on('click', '.js_plus_product', function () {
        let quantity_product = $(this).parent().find('.cartContent__quantity');

        let quantity = parseInt($(quantity_product).text()) + 1;
        $(quantity_product).html(quantity);
        $.ajax({
            method : "POST",
            headers: {
                Accept        : "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url    : $('#js_cart').data('update'),
            data   : {
                'action': 'plus',
                'id'    : $(this).data('id')
            },
            success: function (data) {
                if (data.msg === 'ok') {
                    //console.log(data);
                    $('.cartContent__item--id' + data.product_id).find('.cartContent__price').html(data.product_price + ' рублей');
                    $('#totalPrice').html(data.total_price + ' рублей');
                    $('#js_cart_numb').html(data.total_quantity);
                }
            }
        });

    });

    $('#js_cart').on('click', '.js_del_product', function () {
        let product_del = $(this).data('id');
        $('.cartContent__item--id' + product_del).remove();

        $.ajax({
            method : "POST",
            headers: {
                Accept        : "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url    : $('#js_cart').data('remove'),
            data   : {
                'id': product_del
            },
            success: function (data) {
                if (data.msg === 'ok') {
                    //console.log(data);
                    $('#totalPrice').html(data.total_price + ' рублей');
                    $('#js_cart_numb').html(data.total_quantity);
                } else {
                    window.location.reload();
                }
            }
        });
    });

    if ($('#createProductAttribute').length > 0) {
        loadProductAttributes($('#createProductAttribute').data('url'), $('#createProductAttribute').data('id'));
        $('#category_id').on('change', function () {
            loadProductAttributes($('#createProductAttribute').data('url'), 0);
        });
    }

    if ($('#editProductAttribute').length > 0) {
        loadProductAttributes($('#editProductAttribute').data('url'), $('#editProductAttribute').data('id'));
        $('#category_id').on('change', function () {
            loadProductAttributes($('#editProductAttribute').data('url'), $('#editProductAttribute').data('id'));
        });
    }
});

function loadProductAttributes(url, id) {
    $.ajax({
        method : "POST",
        headers: {
            Accept        : "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url    : url,
        data   : {
            'id'         : id,
            'category_id': $('#category_id').val()
        },
        success: function (data) {
            if (data.msg === 'ok') {
                $('.js_list_attributes').html(data.returnHTML);
            } else {
                window.location.reload();
            }
        }
    });


}