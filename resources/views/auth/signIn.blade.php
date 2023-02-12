<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <html lang="zh-TW">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <title>會員登入</title>
</head>
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    body {
        height: 100%;
    }

    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>

<body class="text-center bg-light">
    <main class="form-signin mx-auto" style="height:100vh;">
        <form action="signInHandle" class="form form_control " method="POST">
            {!! csrf_field() !!}

            {{-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}

            <h1 class="h3 mb-3 fw-normal">{{ $title }}</h1>
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="請輸入信箱"
                    value="{{ old('email') }}">
                <label for="floatingInput">信箱</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="請輸入密碼"
                    value="{{ old('password') }}">
                <label for="floatingPassword">密碼</label>
            </div>

            {{-- <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div> --}}
            @include('componets.validationErrorMessage')
            <div class="">
                <button class="w-100 btn btn-lg btn-primary" type="submit">登入</button>
                <a type="" href="sign_up" class="">註冊</a>
            </div>
        </form>
    </main>


</body>

</html>
