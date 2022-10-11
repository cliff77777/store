@extends('layout.master')
@section('title',$title)
<div class="bg-secondary" >
@section('content')
    <div class="container content">
            <h1 class="mx-auto mb-3">{{$title}}</h1>
            @include('componets.validationErrorMessage')
        <form action="addUser" class="form form_control" method="POST">
            {!! csrf_field() !!}
            <div class=" mb-3">
                <label for="" class="px-2">Email</label>
                <input type="text" class="form-control" name="email" placeholder="請輸入信箱" value="{{old('email')}}">
            </div>
        
            <div class="mb-3">
                <label for="" class="px-2">密碼</label>
                <input type="password" class="form-control" name="password" placeholder="請輸入密碼" value="{{old('password')}}">
            </div>

            <div class="mb-3">
                <label for="" class="px-2">確認密碼</label>
                <input type="password" class="form-control" name="check_password" placeholder="再次確認密碼" value="{{old('check_password')}}">
            </div>
        
            <div class="mb-3">
                <label for="" class="px-2">姓名</label>
                <input type="text" class="form-control" name="name" placeholder="請輸入姓名" value="{{old('name')}}">
            </div>
                <div class="">
                    <button class="btn btn-primary" type="submit">確定</button>
                    <a type="button" href="javascript:history.back()" class="btn btn-danger" >返回</a>
                    <a type="button" href="{{route('signInPage')}}" class="btn btn-success" >會員登入</a>
                </div>
        </form>
    </div>
</div>

@endsection