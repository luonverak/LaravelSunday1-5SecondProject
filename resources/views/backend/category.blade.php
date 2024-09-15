@extends('backend.backend_master')
@section('admin-content')
    <button class="btn btn-primary m-2 open-category-modal">
        <i class="fa-solid fa-plus"></i>
        Add Category
    </button>
    {{-- Call subview --}}

    <div class="list-category row">
        
    </div>

    @include('modal.category')
@endsection
@section('script')
    <script>
        var records = "";
        jQuery(function() {
            
            $.ajax({
                type: "POST",
                url: "/api/admin/get-category",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    // before add data success
                },
                success: function(response) {
                    
                    if(response.status !="success"){
                        // Message response 
                        return;
                    }
                    
                    let categories = response.records;
                    categories.forEach(category => {
                        records +=`
                                    <div class="col-3 ">
                                        <div
                                            class="category bg-secondary bg-opacity-50 rounded m-2 d-flex flex-column align-items-center justify-content-center">
                                            <div class="category-logo">
                                                <img class="w-100 h-100 object-fit-contain  rounded-circle" src="${category.logo}" alt="">
                                            </div>
                                            <p class="text-white mt-2">${category.name}</p>
                                        </div>
                                    </div>
                                    `;
                    });
                    $("div.list-category").html(records);
                },
                error: function(xhr, status, error) {
                    // when request ready but error 
                }
            });
        });
    </script>
@endsection
