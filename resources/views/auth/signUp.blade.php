<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <html lang="zh-TW">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <title>{{ $title }}</title>
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

<body class=" bg-light">
    <main class="form-signin mx-auto" style="height:100vh;">
        <form action="addUser" class="form form_control " method="POST">
            {!! csrf_field() !!}

            {{-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}

            <h1 class="h3 mb-3 fw-normal text-center">{{ $title }}</h1>
            <form action="addUser" class="form form_control" method="POST">
                {!! csrf_field() !!}
                <div class=" mb-3">
                    <label for="" class="px-2">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="請輸入信箱"
                        value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="" class="px-2">密碼</label>
                    <input type="password" class="form-control" name="password" placeholder="請輸入密碼"
                        value="{{ old('password') }}">
                </div>

                <div class="mb-3">
                    <label for="" class="px-2">確認密碼</label>
                    <input type="password" class="form-control" name="check_password" placeholder="再次確認密碼"
                        value="{{ old('check_password') }}">
                </div>

                <div class="mb-3">
                    <label for="" class="px-2">姓名</label>
                    <input type="text" class="form-control" name="name" placeholder="請輸入姓名"
                        value="{{ old('name') }}">
                </div>
                @include('componets.validationErrorMessage')
                <div class="">
                    <button class="btn  btn-success" type="submit">註冊</button>
                    <a type="button" href="javascript:history.back()" class="btn btn-danger">返回</a>
                    <a type="button" href="{{ route('signInPage') }}" class="btn btn-primary">登入頁面</a>
                </div>
            </form>
        </form>
    </main>


</body>

</html>
