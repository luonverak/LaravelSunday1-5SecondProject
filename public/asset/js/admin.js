$(document).on("click", "button.open-category-modal", function () {
    $("div.category-modal").modal("show");
}).on("click", "button.accept-save-category", function () {

    let name = $("div.category-modal").find("input#name");
    let description = $("div.category-modal").find("textarea#description").val();
    let logo = $("div.category-modal").find("input#logo")[0].files[0];

    if (name.val() === "") {
        name.addClass("border-danger");
        return;
    } else {
        name.removeClass("border-danger");
    }

    addCategory(name.val(), description, logo);
    
});
function addCategory(name, description, logo) {

    let form = new FormData();
    form.append("name", name);
    form.append("description", description);
    form.append("logo", logo);

    $.ajax({
        type: "POST",
        url: "/api/admin/add-category",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: form,
        processData: false,
        contentType: false,
        beforeSend: function () {
            // before add data success
        },
        success: function (response) {
            // when send request ready
            $("div.category-modal").modal("hide");
        },
        error: function (xhr, status, error) {
            // when request ready but error 
        }
    });
}