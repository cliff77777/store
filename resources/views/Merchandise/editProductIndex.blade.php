@extends('layout.master')
@section('title', '編輯商品頁面')
<div class="bg-secondary">
    @section('content')
        <div class="container content" style="background:white">
            <h2 class="my-3 py-3">修改商品</h2>
            {{-- {{ dd($data) }} --}}
            <form action="javascript:void(0);">
                {{ csrf_field() }}
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="open_status" name="open_status"
                        {{ $data['status'] == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="open_status" id="open_status_label">關閉上架功能</label>
                </div>
                <input type="text" class="form-control d-none" required name="id" value={{ $data['id'] }}>
                <span class="ns_font">(必填)</span>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" placeholder="商品名稱" required name="name"
                        value={{ $data['name'] }}>
                    <label for="name">商品名稱</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name_en" placeholder="商品名稱(英文)" name="name_en"
                        value={{ $data['name_en'] }}>
                    <label for="name_en">商品名稱(英文)</label>
                </div>
                <span class="ns_font">(必填)</span>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="price" placeholder="商品價格" required name="price"
                        value={{ $data['price'] }}>
                    <label for="price">商品價格</label>
                </div>
                <span class="ns_font">(必填)</span>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="count" placeholder="商品數量" required name="count"
                        value={{ $data['count'] }}>
                    <label for="count">商品數量</label>
                </div>
                <span class="ns_font">(必填)</span>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="商品介紹" id="introduction" style="height: 100px" required name="introduction">{{ $data['introduction'] }}</textarea>
                    <label for="introduction">商品介紹</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="商品介紹(英文)" id="introduction_en" style="height: 100px" name="introduction_en">{{ $data['introduction_en'] }}</textarea>
                    <label for="introduction_en">商品介紹(英文)</label>
                </div>
                <div class="form-floating mb-3">
                    <div class="">
                        <label for="floatingInput">商品封面圖</label>
                    </div>
                    <img class="imgupload  mt-2" id="blah" src="{{ $data['photo'] }}" alt="your image"
                        width="300" />
                </div>
                <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                    @for ($i = 0, $y = 1, $x = 'file'; $i <= 4; $i++, $y++)
                        @if (isset($photo_ablum[$i]) && $photo_ablum[$i]['photo_order'] == $x . $y)
                            <div class="col-6">
                                <input type="file" class="form-control img_file d-none"
                                    onchange="readURL(this,'#blah{{ $y }}');" id="photo{{ $y }}"
                                    name="photo{{ $y }}">
                                <img class="imgupload" id="blah{{ $y }}" alt="your image" width="300"
                                    src="{{ $photo_ablum[$i]['rotue'] }}" onclick="showInput(photo{{ $y }})" />
                                <div class="">
                                    <label for="photo{{ $y }}">商品圖{{ $y }}:
                                        <span>
                                            {{ $photo_ablum[$i]['photo_origin_name'] }}
                                        </span>
                                    </label>
                                    <div>
                                        <input type="radio" id="font_img{{ $y }}" name="font_img"
                                            value="{{ $x . $y }}" data-target="{{ $x . $y }}"
                                            class="font_img">
                                        <label for="font_img{{ $y }}">成為封面圖</label>
                                        <input type="checkbox" class="ms-2 del_img_c" value="{{ $x . $y }}"
                                            name="delete_img" id='delete_{{ $y }}'>
                                        <label for='delete_{{ $y }}'>刪除圖片</label>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-6">
                                <div class=""><label for="photo{{ $y }}">商品圖{{ $y }}</label>
                                </div>
                                <input type="file" class="form-control img_file"
                                    onchange="readURL(this,'#blah{{ $y }}','#control_cbx{{ $y }}');"
                                    id="photo{{ $y }}" name="photo{{ $y }}">
                                <img class="imgupload d-none mt-2" id="blah{{ $y }}" src="#"
                                    alt="your image" width="300" src="" />
                                <div class="d-none" id="control_cbx{{ $y }}">
                                    <input type="radio" id="font_img{{ $y }}" name="font_img"
                                        value="{{ $x . $y }}" data-target="{{ $x . $y }}" class="font_img">
                                    <label for="font_img{{ $y }}">成為封面圖</label>
                                    <input type="checkbox" class="ms-2 del_img_c" value="{{ $x . $y }}"
                                        name="delete_img" id='delete_{{ $y }}'>
                                    <label for='delete_{{ $y }}'>刪除圖片</label>
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>
                <input type="text" class="d-none" name="del_img" id="del_img">
                <input type="text" class="d-none" value="{{ $data['id'] }}" id="target_id">
                <button type="submit" class="btn btn-primary btn-sm" id="edit_data_btn">修改商品</button>
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
            function readURL(input, blash, control_cbx) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(blash).attr('src', e.target.result);
                        $(blash).removeClass("d-none");
                        $(control_cbx).removeClass("d-none");

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
                //刪除圖片控制
                var del_img_group = [];
                $(".del_img_c").click(function() {
                    var font_img = $('input[name=font_img]:checked').val()
                    var img_info = this.value;
                    if ($(this).prop('checked') == true) {
                        del_img_group.push(img_info)
                        if (font_img == img_info) {
                            $('input[name=font_img]:checked').prop('checked', false);
                        }
                    } else {
                        del_img_group = del_img_group.filter((item) => item != img_info)
                    }
                    $("#del_img").val(del_img_group);
                })

                // 控制如果選擇刪除圖片則不能成為封面圖
                $(".font_img").click(function() {
                    var target_img = $(this).val();
                    var img_group = $("#del_img").val();
                    var font_false = img_group.search(target_img);
                    if (font_false !== -1) {
                        var target_img_id = "#" + target_img;
                        $('input[name=font_img]:checked').prop('checked', false);
                    }
                })

                $("#edit_data_btn").click(function() {
                    var formData = new FormData();
                    formData.append("file1", $("#photo1")[0].files[0]);
                    formData.append("file2", $("#photo2")[0].files[0]);
                    formData.append("file3", $("#photo3")[0].files[0]);
                    formData.append("file4", $("#photo4")[0].files[0]);
                    formData.append("file5", $("#photo5")[0].files[0]);
                    formData.append("name", $("#name").val());
                    formData.append("name_en", $("#name_en").val());
                    formData.append("price", $("#price").val());
                    formData.append("count", $("#count").val());
                    formData.append("introduction", $("#introduction").val());
                    formData.append("introduction_en", $("#introduction_en").val());
                    formData.append("open_status", $("#open_status").val());
                    formData.append("target_id", $("#target_id").val());
                    formData.append("del_img_group", $("#del_img").val());
                    var font_img = $('input[name=font_img]:checked').val()
                    formData.append("font_img", font_img);

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
            })
        </script>
    @endsection
