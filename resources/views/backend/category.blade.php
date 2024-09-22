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

                    if (response.status != "success") {
                        // Message response 
                        return;
                    }

                    let categories = response.records;
                    categories.forEach(category => {
                        records += getCategory(category);
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
