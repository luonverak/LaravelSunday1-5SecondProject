$(document).on("click", "button.open-category-modal", function () {

    let categoryModal = $("div.category-modal");
    categoryModal.find("button#accept-category").addClass("accept-save-category").removeClass("accept-edit-category").attr("data-id", "").text("Save");
    categoryModal.find("h1.modal-title").text("Add category");
    categoryModal.modal("show");

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

    let id = $(this).attr("data-id");

    let categoryModal = $("div.category-modal");

    categoryModal.find("h1.modal-title").text("Edit category");
    categoryModal.find("button#accept-category").removeClass("accept-save-category").addClass("accept-edit-category").attr("data-id", id).text("Save change");


    let record = $(this).parents("div.category-record");
    let name = record.find("p.category-name").text();
    let description = record.find("p.category-description").text();

    categoryModal.find("input#name").val(name);
    categoryModal.find("textarea#description").val(description);

    categoryModal.modal("show");

}).on("click", "button.accept-edit-category", function () {

    let id = $(this).attr("data-id");
    let name = $("div.category-modal").find("input#name");
    let description = $("div.category-modal").find("textarea#description").val();
    let logo = $("div.category-modal").find("input#logo")[0].files[0];

    if (name.val() === "") {
        name.addClass("border-danger");
        return;
    } else {
        name.removeClass("border-danger");
    }

    editCategory(name.val(), description, logo, id);
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

function editCategory(name, description, logo, id) {

    let form = new FormData();
    form.append("name", name);
    form.append("description", description);
    form.append("logo", logo);
    form.append("id", id);

    $.ajax({
        type: "POST",
        url: "/api/admin/edit-category",
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
            let category = getCategory(response.record);
            $("div.list-category").find("div.category-record[data-id='" + id + "']").replaceWith(category);
            $("div.category-modal").modal("hide");
        },
        error: function (xhr, status, error) {
            // when request ready but error 
        }
    });
}

function getCategory(category) {
    return ` <div class="col-3 p-2 category-record position-relative d-flex justify-content-end" data-id="${btoa(category.id)}">
                <div class=" w-100 h-100 category bg-secondary bg-opacity-50 rounded m-2 d-flex flex-column align-items-center justify-content-center">
                    <div class="category-logo">
                        <img class="w-100 h-100 object-fit-cover  rounded-circle" src="${category.logo}" alt="">
                    </div>
                    <p class="category-name text-white mt-2">${category.name}</p>
                    <p class="category-description d-none text-white mt-2">${category.description}</p>
                </div>
                <span class="position-absolute open-edit-category p-2" role="button" data-id="${btoa(category.id)}" >
                    <img src="/asset/icons/edit.svg" alt="">
                </span>
            </div>
            `;
}