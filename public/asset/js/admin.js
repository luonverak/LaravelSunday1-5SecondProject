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

}).on("click", "span.open-edit-category", function () {
    $("div.category-modal").modal("show");
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
            if (response.status != "success") {
                return;
            }
            $("div.category-modal").modal("hide");
            let category = getCategory(response.record);
            $("div.list-category").append(category);
        },
        error: function (xhr, status, error) {
            // when request ready but error 
        }
    });
}

function getCategory(category) {
    return ` <div class="col-3 p-2 position-relative d-flex justify-content-end">
                <div class=" w-100 h-100 category bg-secondary bg-opacity-50 rounded m-2 d-flex flex-column align-items-center justify-content-center">
                    <div class="category-logo">
                        <img class="w-100 h-100 object-fit-contain  rounded-circle" src="${category.logo}" alt="">
                    </div>
                    <p class="text-white mt-2">${category.name}</p>
                </div>
                <span class="position-absolute open-edit-category p-2" role="button" >
                    <img src="/asset/icons/edit.svg" alt="">
                </span>
            </div>
            `;
}