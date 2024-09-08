@extends('backend.backend_master')
@section('admin-content')
    <button class="btn btn-primary m-2 open-category-modal">
        <i class="fa-solid fa-plus"></i>
        Add Category
    </button>
    {{-- Call subview --}}
   @include('modal.category')
@endsection