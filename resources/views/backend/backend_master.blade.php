<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/asset/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/asset/css/admin.css') }}">
    <script src="{{ asset('/asset/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/asset/js/jquery.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/asset/fontawesome/css/all.css') }}">
</head>

<body>
    <div class="m-0 p-0 row admin-dashboad">
        <div class="col-2 bg-dark">
            <div class="page-logo admin-menu mt-4 mb-5">
                <a class="admin-menu" href="/admin">
                    <img class="rounded-circle me-3" src="{{ asset('/asset/icons/logo.png') }}" alt="">
                    <p class="m-0 p-0 text-white fs-4">Blog Website</p>
                </a>
            </div>
            <div class="admin-menu">
                <a class="admin-menu" href="/admin/category">
                    <img class="menu-icon me-2" src="{{ asset('/asset/icons/categories.png') }}" alt="">
                    <p class="m-0 p-0 text-white ">Category</p>
                </a>
            </div>
            <div class="admin-menu mt-3">
                <a class="admin-menu" href="/admin/category">
                    <img class="menu-icon me-2" src="{{ asset('/asset/icons/categories.png') }}" alt="">
                    <p class="m-0 p-0 text-white ">Content</p>
                </a>
            </div>
        </div>
        <div class="col-10">
            @yield('admin-content')
        </div>
    </div>
</body>

@yield('script')
<script src="{{ asset('/asset/js/admin.js') }}"></script>

</html>
