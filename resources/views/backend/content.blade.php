@extends('backend.backend_master')
@section('admin-content')
    <button class="btn btn-primary m-2 open-content-modal">
        <i class="fa-solid fa-plus"></i>
        Add Content
    </button>
    {{-- Call subview --}}

    <div class="list-content row">

    </div>

    @include('modal.content')
@endsection
@section('script')
    <script>
        var records = "";
        jQuery(function() {

             

             
        });
        
    </script>
@endsection
