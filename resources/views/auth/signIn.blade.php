@extends('layout.master')
@section('title',$title)
<div class="bg-secondary" >
@section('content')
    <div class="container content">
            <h1 class="mx-auto mb-3">{{$title}}</h1>
            @include('componets.validationErrorMessage')
        <form action="signInHandle" class="form form_control" method="POST">
            {!! csrf_field() !!}
            <div class=" mb-3">
                <label for="" class="px-2">Email</label>
                <input type="text" class="form-control" name="email" placeholder="請輸入信箱" value="{{old('email')}}">
            </div>
        
            <div class="mb-3">
                <label for="" class="px-2">密碼</label>
                <input type="password" class="form-control" name="password" placeholder="請輸入密碼" value="{{old('password')}}">
            </div>        
                <div class="">
                    <button class="btn btn-primary" type="submit">登入</button>
                    <a type="button" href="sign_up" class="btn btn-success" >註冊</a>
                </div>
        </form>
    </div>
</div>

@endsection