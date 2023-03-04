@extends('layout.master')
@section('title', '新增商品')
<div class="bg-secondary">
    @section('content')
        <div class="container content">
            <h2 class="my-3 py-3">新增商品</h2>
            {{-- <form action="{{url("merchandise/create_product_process")}}" id="create_form" method="post"> --}}
            <form action="javascript:void(0);" id="create_form" method="post">

                {{ csrf_field() }}
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="open_status" name="open_status">
                    <label class="form-check-label" for="open_status" id="open_status_label">關閉上架功能</label>
                </div>
                <span class="ns_font">(必填)</span>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" placeholder="商品名稱" required name="name">
                    <label for="name">商品名稱</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name_en" placeholder="商品名稱(英文)" name="name_en">
                    <label for="name_en">商品名稱(英文)</label>
                </div>
                <span class="ns_font">(必填)</span>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="price" placeholder="商品價格" required name="price">
                    <label for="price">商品價格</label>
                </div>
                <span class="ns_font">(必填)</span>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="count" placeholder="商品數量" required name="count">
                    <label for="count">商品數量</label>
                </div>
                <span class="ns_font">(必填)</span>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="商品介紹" id="introduction" style="height: 100px" required name="introduction"></textarea>
                    <label for="introduction">商品介紹</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="商品介紹(英文)" id="introduction_en" style="height: 100px" name="introduction_en"></textarea>
                    <label for="introduction_en">商品介紹(英文)</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="file" class="form-control img_file" onchange="readURL(this,'#blah1');" id="photo1"
                        name="photo1">
                    <label for="floatingInput">商品圖一</label>
                    <img class="imgupload d-none mt-2" id="blah1" src="#" alt="your image" width="300" />
                </div>
                <div class="form-floating mb-3">
                    <input type="file" class="form-control img_file" onchange="readURL(this,'#blah2');" id="photo2"
                        name="photo2">
                    <label for="floatingInput">商品圖二</label>
                    <img class="imgupload d-none mt-2" id="blah2" src="#" alt="your image" width="300" />
                </div>
                <div class="form-floating mb-3">
                    <input type="file" class="form-control img_file" onchange="readURL(this,'#blah3');" id="photo3"
                        name="photo3">
                    <label for="floatingInput">商品圖三</label>
                    <img class="imgupload d-none mt-2" id="blah3" src="#" alt="your image" width="300" />
                </div>
                <div class="form-floating mb-3">
                    <input type="file" class="form-control img_file" onchange="readURL(this,'#blah4');" id="photo4"
                        name="photo4">
                    <label for="floatingInput">商品圖四</label>
                    <img class="imgupload d-none mt-2" id="blah4" src="#" alt="your image" width="300" />
                </div>
                <div class="form-floating mb-3">
                    <input type="file" class="form-control img_file" onchange="readURL(this,'#blah5');"
                        id="photo5" name="photo5">
                    <label for="floatingInput">商品圖五</label>
                    <img class="imgupload d-none mt-2" id="blah5" src="#" alt="your image" width="300" />
                </div>
                <button type="submit" class="btn btn-success btn-sm" id="add_data_btn">新增</button>
                <button type="button" class="btn btn-secondary btn-sm">清空內容</button>
            </form>

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
            function readURL(input, blash) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(blash).attr('src', e.target.result);
                        $(blash).removeClass("d-none");
                    }
                    reader.readAsDataURL(input.files[0]);
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

                $("#add_data_btn").click(function() {
                    $.ajax({
                        type: 'post',
                        url: '{{ url('merchandise/create_product_process') }}',
                        dataType: "json",
                        data: $("#create_form").serialize(),
                        success: function(res) {
                            let status = res['status'];
                            if (status == "success") {
                                toastr.success("新增商品成功");
                                upload_img(res['insert_id']);
                            } else if (status == 'fail') {
                                toastr.error(res['msg']);
                            }
                        },
                        error: function(fail) {
                            console.log(fail);
                        }
                    })
                })

                function upload_img(insert_id) {
                    var img_group = [$("#photo1")[0].files[0], $("#photo2")[0].files[0], $("#photo3")[0].files[
                        0], $("#photo4")[0].files[0], $("#photo5")[0].files[0]];
                    var check_img_count = img_group.filter(word => word !== undefined);

                    if (check_img_count != 0) {
                        var formData = new FormData();
                        formData.append("file1", $("#photo1")[0].files[0]);
                        formData.append("file2", $("#photo2")[0].files[0]);
                        formData.append("file3", $("#photo3")[0].files[0]);
                        formData.append("file4", $("#photo4")[0].files[0]);
                        formData.append("file5", $("#photo5")[0].files[0]);
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
                    } else {
                        console.log("沒有圖片");
                    }
                }

            })
        </script>
    @endsection
