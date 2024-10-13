<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset("/asset/css/frontend.css")}}">
    <link rel="stylesheet" href="{{ asset('/asset/bootstrap/css/bootstrap.css') }}">
    <script src="{{ asset('/asset/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/asset/js/jquery.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/asset/fontawesome/css/all.css') }}">
</head>
<body>
    <div class="m-0 p-0 row header align-items-center">
        <div class="col-4 content-center">
            <img class="page-logo" src="{{emptyImage()}}" alt="">
        </div>
        
        <div class="col-8">
            <ul class="m-0 p-0 d-flex justify-content-evenly">
                <li class="algin-content-center"><a href="#">Home</a></li>
                <li class="algin-content-center"><a href="#">Category</a></li>
                <li class="algin-content-center"><a href="#">About Us</a></li>
                <li class="border border-primary pl-3 pr-3 pt-2 pb-2 open-acount">
                    <a class="m-5 text-primary">Account</a>
                </li>
            </ul>
        </div>
    </div>
    
    @include('modal.login')
    @include('modal.register')
</body>
<script src="{{asset("/asset/js/frontend.js")}}"></script>

</html>