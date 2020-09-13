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
});