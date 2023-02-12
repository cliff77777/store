@extends('layout.master')
@section('title', '商品頁面')
<div class="bg-secondary">
    @section('content')
        <aside>

        </aside>
        <div class="container content" style="background:white">
            <h2 class="my-3 py-3">{{ $data['name '] }}</h2>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($img_url as $key => $value)
                        <button type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide-to={{ $key }} class="@if ($loop->first) active @endif"
                            aria-current="true" aria-label="Slide{{ $key }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner mx-auto" style="width:40%;height:40%">
                    @foreach ($img_url as $value)
                        <div class="carousel-item @if ($loop->first) active @endif " data-bs-interval="4000">
                            <img src="{{ asset($value) }}" class="d-block rounded " alt="..."
                                style="width:100%;height:100%">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev" style="width:50%;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next" style="width:50%;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class=""></div>
        </div>
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

            //選擇圖片即時顯示的js
            function readURL(input) {
                var productAlbum = input.files;
                $("#imgPlace").html('');
                var imgPlace = '';
                var src_rotue = [];
                for (var i = 0; i < productAlbum.length; i++) {
                    if (productAlbum && productAlbum[i]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            imgPlace = '<img class="imgupload m-2" src="' + e.target.result +
                                '" alt="your image" width="300" />';
                            $('#imgPlace').append(imgPlace);
                        }
                        reader.readAsDataURL(productAlbum[i]);
                    }
                }
            }

            $(document).ready(function() {
                //控制上架功能文字
                $("#open_status").on('click', function() {
                    var switch_status = $("#open_status").prop("checked");
                    if (switch_status == false) {
                        $("#open_status_label").text('關閉上架功能');
                        $("#open_status").val("0");
                    } else {
                        $("#open_status_label").text('開啟上架功能');
                        $("#open_status").val("1");

                    }
                })

                //檢查欄位
                // $("#create_form").validate({
                //     rules: {
                //         name: "required",
                //         price: "required",
                //         count: "required",
                //         introduction: "required",
                //     },
                //     messages: {
                //         name: "請輸入商品名稱",
                //         price: "請輸入商品價格",
                //         count: "請輸入商品數量",
                //         introduction: "請輸入商品介紹",
                //     }
                // })

                $("#edit_data_btn").click(function() {
                    var img = $("#photo")[0].files[0];
                    $.ajax({
                        type: 'post',
                        url: '{{ url('merchandise/product_update') }}',
                        dataType: "json",
                        data: $("#edit_form").serialize(),
                        success: function(res) {
                            let status = res['data']['status'];
                            if (status == "200") {
                                toastr.success("修改成功");
                                // 暫時增加
                                window.setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                                if (img !== undefined) {
                                    // console.log("有圖片");
                                    // upload_img(res['insert_id'],img);
                                } else {
                                    console.log("沒有圖片");
                                }
                            } else {
                                toastr.error("修改失敗");
                            }
                        },
                        error: function(fail) {
                            console.log(fail);
                        }
                    });
                })

                function upload_img(insert_id, upload_img) {
                    var formData = new FormData();
                    formData.append("file", upload_img);
                    formData.append("real_name", $("#photo").val());
                    formData.append("id", insert_id);
                    $.ajax({
                        type: 'post',
                        processData: false,
                        contentType: false,
                        url: '{{ url('merchandise/create_product_process') }}',
                        dataType: "json",
                        data: formData,
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            let data = res
                            if (data["msg"] == "success") {
                                toastr.success("圖片新增成功");
                            } else {
                                toastr.error(data["msg"]);

                            }
                        },
                        error: function(fail) {
                            console.log(fail);
                        }
                    });
                }

            })
        </script>
    @endsection
