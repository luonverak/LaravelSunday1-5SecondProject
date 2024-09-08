$(document).on("click", "button.open-category-modal", function () {
    $("div.category-modal").modal("show");
}).on("click","button.accept-save-category",function () {  
    let name = $("div.category-modal").find("input#name").val();
    let description =$("div.category-modal").find("textarea#description").val();
    let logo = $("div.category-modal").find("input#logo")[0].files[0];
    console.log(name);
    console.log(description);
    console.log(logo);
});