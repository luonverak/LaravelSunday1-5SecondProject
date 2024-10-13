$(document).on("click", "li.open-acount", function () {
    $("div.login-modal").modal("show");
}).on("click", "span.open-register-modal", function () {
    $("div.login-modal").modal("hide");
    $("div.register-modal").modal("show");
});