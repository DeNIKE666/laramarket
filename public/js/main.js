$(function () {
    $('#registerForm').submit(function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        let formUrl = $(this).attr('action');
        $(".invalid-feedback").text("");
        $("#registerForm input").removeClass("is-invalid");
        $.ajax({
            method: "POST",
            headers: {
                Accept: "application/json"
            },
            url: formUrl,
            data: formData,
            success: () => window.location.reload(),
            error: (response) => {

                if(response.status === 422) {
                    let errors = response.responseJSON.errors;
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
    $('#loginForm').submit(function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        let formUrl = $(this).attr('action');
        $(".invalid-feedback").text("");
        $("#registerForm input").removeClass("is-invalid");
        $.ajax({
            method: "POST",
            headers: {
                Accept: "application/json"
            },
            url: formUrl,
            data: formData,
            success: () => window.location.reload(),
            error: (response) => {

                if (response.status === 422) {
                    let errors = response.responseJSON.errors;
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

    $('#account_refill_cost').on('change', function(){
         let choose = $('#payRefill').find('input[name="choose"]:checked').data('percent') / 100;
        $('#account_refill_cost_percent').val(Number($('#account_refill_cost').val()) + $('#account_refill_cost').val() * choose);
    });

    $('#payModal').on('click', function(){
        $('.popUp-pay').fadeIn();
    });

});