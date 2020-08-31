// (function () {
$(document).ready(function () {
    $(".copy-partner-link").on("click", () => {
        $("#partner-link").select();
        document.execCommand("copy");
    });
});
// }());