@extends('layout.master')
@section('title', $title)
@include('layout.sidebar')
@section('content')
    <div class="row mt-3">
        <div class="col-md-12 content">
            <h1 class="my-5 py-2 ms-5">{{ $title }}</h1>
            <div class="dashborad_body" id="dashboard_body" data-id="{{ $user }}" data-action="">
                <div class="body_content ms-5" id="body_content">
                </div>
            </div>
            @include('componets.validationErrorMessage')
        </div>
    </div>
    <script>
        window.onload = () => {
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
                "timeOut": "2000", // 當超過此設定時間時，則隱藏提示訊息(單位: 毫秒)
                "extendedTimeOut": "1000", // 當使用者觸碰到提示訊息時，離開後超過此設定時間則隱藏提示訊息(單位: 毫秒)
                "showEasing": "swing", // 顯示動畫時間曲線
                "hideEasing": "linear", // 隱藏動畫時間曲線
                "showMethod": "fadeIn", // 顯示動畫效果
                "hideMethod": "fadeOut" // 隱藏動畫效果
            }
        }
        const order_list = document.getElementById("order_list");
        const aside = document.querySelectorAll(".aside");
        var dashboard_body = document.getElementById('dashboard_body');
        var body_content = document.getElementById('body_content');
        var target_user = dashboard_body.dataset.id;
        var target_actrion = dashboard_body.dataset.action;

        aside.forEach((menu) => {
            menu.addEventListener('click', (event) => {
                var clickedMenu = event.target; // 取得點擊menu
                var action = clickedMenu.id; // 取得點擊menu id
                getdata(target_user, action);
            });
        });

        let getdata = (target_id, action) => {
            $.ajax({
                url: '{{ route('userdetail') }}',
                type: 'post',
                dataType: "json",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "user_id": target_id,
                    "action": action
                },
                success: function(data) {
                    body_content.innerHTML = data.html
                },
                error: function() {

                }
            });
        };


        //檢查密碼是否正確
        var check_pass = () => {
            var password = document.getElementById("password");
            var target_user = dashboard_body.dataset.id;
            var dashboardUserDetailUrl = "{{ route('userdetail') }}";
            $.ajax({
                url: dashboardUserDetailUrl,
                type: 'post',
                dataType: "json",
                data: {
                    "user_id": target_user,
                    "password": password.value
                },
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    var edit_data = document.querySelectorAll(".edit_data");
                    var edit_btn = document.getElementById("edit_btn");
                    var email = document.getElementById("email");

                    if (data.status == 400) {
                        edit_data.forEach((input) => {
                            input.disabled = true;
                        })
                        edit_btn.disabled = true;
                    }

                    if (data.status == 200) {
                        edit_data.forEach((input) => {
                            input.disabled = false;
                        })
                        edit_btn.disabled = false;
                        email.disabled = true;

                    }
                },
                error: function() {
                    edit_data.forEach((input) => {
                        input.disabled = true;
                    })
                    edit_btn.disabled = true;
                }
            });
        };

        //控制眼睛顯示密碼
        var showpass = () => {
            var Ctrleyes = document.getElementById("Ctrleyes");
            var edit_password = document.getElementById("edit_password");
            var type = edit_password.type;
            var show_icon = "fa-solid fa-eye-slash";
            var display_icon = "fa-sharp fa-solid fa-eye";
            if (type == "password") {
                edit_password.type = 'text'
                Ctrleyes.className = display_icon
            } else {
                edit_password.type = 'password'
                Ctrleyes.className = show_icon
            }
        };
        //確認密碼
        var confirm_pass = () => {
            var password = document.getElementById("edit_password");
            var check_password = document.getElementById("check_password");
            var check_password_help = document.getElementById("check_password_help")
            var edit_btn = document.getElementById("edit_btn")

            if (password.value == "" && check_password.value == "") {
                check_password_help.textContent = "請再次確認密碼"
                check_password_help.style.color = "grey"
                edit_btn.disabled = false
            } else if (password.value == check_password.value) {
                console.log("true");
                check_password_help.textContent = "密碼確認"
                check_password_help.style.color = "blue"
                edit_btn.disabled = false
            } else if (password.value != check_password.value) {
                console.log("false");
                check_password_help.textContent = "密碼不一致"
                check_password_help.style.color = "red"
                edit_btn.disabled = true
            }

        };

        //ajax送表單
        let submit_form = () => {
            var result = $('#update_user_form').serialize();
            var emial = $("#email").val();
            $.ajax({
                url: '{{ route('userupdate') }}',
                type: 'post',
                dataType: "json",
                data: result,
                success: function(data) {
                    toastr.success(data[0]);
                    setTimeout(() => {
                        location.reload()
                    }, 2000);
                },
                error: function(error) {
                    var errormsg = $.parseJSON(error.responseText);
                    $("#error_msg").text(errormsg[0]);
                }
            });
        };
    </script>
@endsection
