@extends('layout.master')
@section('title','編輯商品頁面')
<div class="bg-secondary" >
@section('content')
<div class="container content" style="background:white">
    <h2 class="my-3 py-3">修改商品</h2>
    {{-- {{dd($data)}} --}}
    <form action="javascript:void(0);" id="edit_form" method="post">

        {{ csrf_field() }}
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="open_status" name="open_status" {{($data['status'] == "1" ?"checked":"")}}>
            <label class="form-check-label" for="open_status" id="open_status_label">關閉上架功能</label>
          </div>
          <input type="text" class="form-control d-none"  required name="id" value={{$data['id']}}>
          <span class="ns_font">(必填)</span>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" placeholder="商品名稱" required name="name" value={{$data['name']}}>
            <label for="name">商品名稱</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name_en" placeholder="商品名稱(英文)" name="name_en" value={{$data['name_en']}}>
            <label for="name_en">商品名稱(英文)</label>
          </div>   
          <span class="ns_font">(必填)</span>     
          <div class="form-floating mb-3">
            <input type="number" class="form-control" id="price" placeholder="商品價格" required name="price" value={{$data['price']}}>
            <label for="price">商品價格</label>
          </div>   
          <span class="ns_font">(必填)</span>     
          <div class="form-floating mb-3">
            <input type="number" class="form-control" id="count" placeholder="商品數量" required name="count" value={{$data['count']}}>
            <label for="count">商品數量</label>
          </div>
          <span class="ns_font">(必填)</span>
          <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="商品介紹" id="introduction" style="height: 100px" required name="introduction" >{{$data['introduction']}}</textarea>
            <label for="introduction">商品介紹</label>
          </div>      
          <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="商品介紹(英文)" id="introduction_en" style="height: 100px" name="introduction_en">{{$data['introduction_en']}}</textarea>
            <label for="introduction_en">商品介紹(英文)</label>
          </div>
          <div class="form-floating mb-3">
            <label for="floatingInput">商品封面圖</label>
            <img class="imgupload  mt-2" id="blah" src="{{$data['photo']}}" alt="your image" width="300" />
          </div>
          <div class="form-floating mb-3">
            <input type="file" class="form-control" onchange="readURL(this);" id="photo" name="photo" placeholder="" multiple>
            <label for="floatingInput">新增商品圖片</label>
            <div id="imgPlace"> </div>
          </div>

          <button type="submit" class="btn btn-primary btn-sm" id="edit_data_btn">修改商品</button>
          <button type="button" class="btn btn-secondary btn-sm">清空內容</button>
    </form>
    
</div>
 <!-- toastr v2.1.4 -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
 <!-- jquery -->
<script  src="https://code.jquery.com/jquery-3.6.1.min.js"  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="  crossorigin="anonymous"></script>


<script>
  	toastr.options = {
  		// 參數設定[註1]
  		"closeButton": false, // 顯示關閉按鈕
  		"debug": false, // 除錯
  		"newestOnTop": false,  // 最新一筆顯示在最上面
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
      var productAlbum=input.files;
      $("#imgPlace").html('');
      var imgPlace='';
      var src_rotue=[];
      for (var i = 0; i < productAlbum.length; i++) {
        if (productAlbum && productAlbum[i]){
          var reader = new FileReader();
          reader.onload = function (e) {
            imgPlace ='<img class="imgupload m-2" src="' + e.target.result + '" alt="your image" width="300" />';
            $('#imgPlace').append(imgPlace);
          }
          reader.readAsDataURL(productAlbum[i]);
        }
      }    
    }

    $(document).ready(function(){
        //控制上架功能文字
        $("#open_status").on('click',function(){
            var switch_status=$("#open_status").prop("checked");
            if(switch_status == false){
                $("#open_status_label").text('關閉上架功能');
                $("#open_status").val("0");
            }else{
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
                    url: '{{url("merchandise/product_update")}}',
                    dataType: "json",
                    data: $("#edit_form").serialize(),
                    success: function (res) {
                        let status = res['data']['status'];
                        if (status == "200") {
                            toastr.success("修改成功");
                            // 暫時增加
                            window.setTimeout(function(){
                              window.location.reload();
                            },2000);
                          if(img !== undefined){
                            // console.log("有圖片");
                            // upload_img(res['insert_id'],img);
                          }else{
                            console.log("沒有圖片");
                          }
                        }else{
                          toastr.error("修改失敗");
                        }
                    },error: function (fail) {
                    console.log(fail);
                    }
            });
            })

            function upload_img(insert_id,upload_img){
                var formData = new FormData();
                formData.append("file", upload_img);
                formData.append("real_name", $("#photo").val());
                formData.append("id", insert_id);
                $.ajax({
                    type: 'post',
                    processData: false,
                    contentType: false,
                    url: '{{url("merchandise/create_product_process")}}',
                    dataType: "json",
                    data: formData,
                    headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        let data = res
                        if (data["msg"] == "success") {
                            toastr.success("圖片新增成功");
                        }else{
                          toastr.error(data["msg"]);

                        }
                    },error: function (fail) {
                    console.log(fail);
                    }
            });
            }

    })



</script>
@endsection
