<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/asset/bootstrap/css/bootstrap.css') }}">
    <script src="{{ asset('/asset/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/asset/js/jquery.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/asset/fontawesome/css/all.css') }}">
</head>
<body>
    <div class="d-flex justify-content-center align-item-center m-5" style="height: 100vh !important;">
        <div class="col-3">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
              </div>
              <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
              </div>
              <button type="button" id="btnLogin" class="btn btn-primary">Login</button>
        </div>
    </div>
</body>
<script>
    $(document).on("click","button#btnLogin",function () {
    
        let email = $("input#email").val();
        let password = $("input#password").val();
        
        login(email,password);

    });

    function login(email,password){
        $.ajax({
            type: "POST",
            url: "/admin/login",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                email: email,
                password : password
            },
            beforeSend: function () {
                // before add data success
            },
            success: function (response) {
                // when send request ready
                if (response.status != "success") {
                    return;
                }
                localStorage.setItem("user_token", response.token);

                if (window.location.pathname === '/admin/login') {
                    window.location.replace('/admin');
                }
            },
            error: function (xhr, status, error) {
                // when request ready but error 
            }
        });
    }
</script>
</html>
