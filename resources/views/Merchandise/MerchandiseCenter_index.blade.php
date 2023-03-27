@extends('layout.master')
@section('title', '產品中心')
@section('content')
    <div class="container content ">
        <h2 class="my-5 py-3">產品中心</h2>
        <div class="row row-cols-1 row-cols-md-4 g-4 ">
            <div class="card-group">
                @foreach ($data as $key => $value)
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset($value['photo']) }}" class="card-img-top img-thumbnail " alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $value['name'] }}</h5>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-primary detail_btn" data-id="{{ $value['id'] }}">立即搶購</a>
                                {{-- <small class="-muted">Last updated 3 mins ago</small> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

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

        $(document).on('click', '.detail_btn', function() {
            var product_id = $(this).attr('data-id');
            $(this).attr('href', "{{ url('merchandise/') }}" + '/' + 'merchandise_index' + '/' + product_id)
            console.log(product_id);
        })

        $(".detail_btn").on('click', function() {
            console.log($(this).data('id'));
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
                    let status = res['data']['status'];
                    if (status == "200") {
                        toastr.success("修改成功");
                        window.setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        toastr.error("修改失敗");
                    }
                },
                error: function(fail) {
                    console.log(fail);
                }
            });
        })
    </script>
@endsection
