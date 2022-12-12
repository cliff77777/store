@extends('layout.master')
@section('title', '商品列表')
<div class="bg-secondary">
    @section('content')
        <div class="container content " style="background:white">
            <h2 class="my-3 py-3">商品列表</h2>
            {{-- {{dd($data->toArray())}} --}}
            <div class="row row-cols-1 row-cols-md-4 g-4 ">
                @foreach ($data as $key => $value)
                    <div class="col">
                        <div class="card " style="width: 18rem;">
                            <img src="{{ $value['photo'] }}"
                                class="card-img-top {{ $value['status'] == '1' ?: 'img_opacity02' }}" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">商品名稱:{{ $value['name'] }}</h5>
                                @if ($value['status'] == '1')
                                    <p class="card-text">商品狀態:<span class="">上架中</span></p>
                                @else
                                    <p class="card-text">商品狀態:<span class="text-danger">下架中</span></p>
                                @endif
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">價格:{{ $value['price'] }}</li>
                                <li class="list-group-item">數量:{{ $value['count'] }}</li>
                            </ul>
                            <div class="card-body">
                                <a href="#" type='button' class="card-link btn-primary btn edit_btn"
                                    data-id="{{ $value['id'] }}">修改</a>
                                <a href="#" type='button' class="card-link btn btn-danger del_btn"
                                    data-bs-toggle="modal" data-bs-target="#del_modal" data-id="{{ $value['id'] }}">刪除</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            {{-- <img src="../../public//product_img/1666517064.jpeg" alt=""> --}}



        </div>
        {{-- 刪除modal --}}
        @include('layout.alert')
        <!-- toastr v2.1.4 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <!-- jquery -->
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>


        <script>
            var myModal = document.getElementById('del_modal')

            toastr.options = {
                // 參數設定[註1]
                "closeButton": false, // 顯示關閉按鈕
                "debug": false, // 除錯
                "newestOnTop": false, // 最新一筆顯示在最上面
                "progressBar": true, // 顯示隱藏時間進度條
                "positionClass": "toast-top-right", // 位置的類別
                "preventDuplicates": false, // 隱藏重覆訊息
                "onclick": null, // 當點選提示訊息時，則執行此函式
                "showDuration": "300", // 顯示時間(單位: 毫秒)
                "hideDuration": "1000", // 隱藏時間(單位: 毫秒)
                "timeOut": "5000", // 當超過此設定時間時，則隱藏提示訊息(單位: 毫秒)
                "extendedTimeOut": "1000", // 當使用者觸碰到提示訊息時，離開後超過此設定時間則隱藏提示訊息(單位: 毫秒)
                "showEasing": "swing", // 顯示動畫時間曲線
                "hideEasing": "linear", // 隱藏動畫時間曲線
                "showMethod": "fadeIn", // 顯示動畫效果
                "hideMethod": "fadeOut" // 隱藏動畫效果
            }

            $(document).on('click', '.edit_btn', function() {
                var product_id = $(this).attr('data-id');
                $(this).attr('href', "{{ url('merchandise/') }}" + '/' + 'edit' + '/' + product_id)
                console.log(product_id);
            })
            $(document).on('click', '.del_btn', function() {
                var product_id = $(this).attr('data-id');
                $("#confirm_del").attr('data-id', product_id);
            })
            $("#confirm_del").on('click', function() {
                var product_id = $(this).attr('data-id');
                $.ajax({
                    type: 'post',
                    url: '{{ url('merchandise/product_update') }}',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    },
                    success: function(res) {

                    },
                    error: function(fail) {}
                });
                $("#del_modal").modal('hide');
            })
        </script>
    @endsection
