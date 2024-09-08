$(document).on("click", "button.open-category-modal", function () {
    $("div.category-modal").modal("show");
}).on("click","button.accept-save-category",function () {  
    let name = $("div.category-modal").find("input#name").val();
    console.log("name : "+name);
});