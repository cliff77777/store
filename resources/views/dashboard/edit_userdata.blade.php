<form action='{{ route('userupdate') }}' method="POST" id="update_user_form" onsubmit="return false;">
    @csrf
    <p class="text-danger">需要修改會員資料請先輸入會員密碼</p>
    <div class="row">
        <div class="mb-3 col-lg-3">
            <label for="password" class="form-label">您目前的密碼</label>
            <input type="password" class="form-control" id="password" onchange=check_pass()>
            <div id="password_help" class="form-text">請輸入您目前的密碼</div>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-lg-3">
            <label for="edit_password" class="form-label">修改密碼
            </label>
            <i class="fa-solid fa-eye-slash" id="Ctrleyes" onclick=showpass()></i>
            <input type="password" class="form-control edit_data" id="edit_password" disabled name="password"
                onchange=confirm_pass()>
            <div id="edit_password_help" class="form-text">請輸入要修改的密碼</div>
        </div>
        <div class="mb-3 col-lg-3">
            <label for="check_password" class="form-label">再次輸入修改的密碼</label>
            <input type="password" class="form-control edit_data" id="check_password" disabled onchange=confirm_pass()
                name="check_password">
            <div id="check_password_help" class="form-text">再次輸入修改的密碼</div>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-lg-3">
            <label for="name" class="form-label">姓名</label>
            <input type="text" class="form-control edit_data" id="name" name="name"
                value={{ !empty($search_data->name) ? $search_data->name : '' }} disabled>
            <div id="nameHelp" class="form-text">請輸入要修改的姓名</div>
        </div>

        <div class="mb-3 col-lg-3">
            <label for="email" class="form-label">信箱</label>
            <input type="email" class="form-control edit_data" id="email" name="email"
                value={{ !empty($search_data->email) ? $search_data->email : '' }} disabled>
            <div id="emailHelp" class="form-text">信箱帳號不得修改</div>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-lg-3">
            <div class="mb-3">
                <label for="phone" class="form-label">連絡電話</label>
                <input type="phone" class="form-control edit_data" id="phone" disabled name="phone">
                <div id="phone_Help" class="form-text">連絡電話</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-lg-6">
            <div class="mb-3">
                <label for="id_address" class="form-label">戶籍地址</label>
                <input type="text" class="form-control edit_data" id="id_address" disabled name="id_address">
                <div id="id_address_Help" class="form-text">請輸入要修改的戶籍地址</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-lg-6">
            <div class="mb-3">
                <label for="live_address" class="form-label">居住地址</label>
                <input type="text" class="form-control edit_data" id="live_address" disabled name="live_address">
                <div id="live_address_Help" class="form-text">請輸入要修改的居住地址</div>
            </div>
        </div>
    </div>
    <input type="hidden" name="email" value={{ !empty($search_data->email) ? $search_data->email : '' }}>
    <div class="row">
        <div class="mb-3 col-lg-3">
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <div class="text-danger" id="error_msg"></div>
            <button type="" class="btn btn-primary" disabled id="edit_btn"
                onclick=submit_form()>修改會員資料</button>
        </div>
    </div>
</form>
