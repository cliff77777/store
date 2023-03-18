        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-secondary">
            <div class="container-fluid">
                <div class="navbar-brand disabled" href="#">商標放置區</div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('homepage/index') }}">首頁</a>
                        </li>
                        <li class="nav-item">
                            @if (optional(session()->get('user_data'))->type !== null)
                                <a class="nav-link active" aria-current="page"
                                    href="{{ url('dashboard/index') }}">會員中心</a>
                            @else
                                <a class="nav-link active" aria-current="page"
                                    href="{{ url('user/auth/sign_in') }}">會員中心</a>
                            @endif
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                商品中心
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <li><a class="dropdown-item" href="{{ url('merchandise/MerchandiseCenter') }}">全部商品</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="">最新商品</a></li>
                            </ul>
                        </li>
                        @if (null !== optional(session()->get('user_data'))->type && session()->get('user_data')->type == 'a')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    商品管理
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                    <li><a class="dropdown-item" href="{{ url('merchandise/create') }}">新增商品</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('merchandise/') }}">商品列表</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                    @if (null !== optional(session()->get('user_data')) && !empty(session()->has('user_data')))
                        <div class="text-light">Hello!! {{ session()->get('user_data')->name }} 歡迎您回來</div>
                        <a class="nav-link text-danger" aria-current="page"
                            href="{{ url('user/auth/sign_out') }}">登出</a>
                    @else
                        <a class="nav-link text-light" aria-current="page" href="{{ url('user/auth/sign_in') }}">登入</a>
                        <a class="nav-link text-light" aria-current="page" href="{{ url('user/auth/sign_up') }}">註冊</a>
                    @endif
                    <button class="btn btn-success position-relative me-3" id="cart_btn">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            id="cart_btn_count">
                            0
                        </span>
                    </button>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <script>
            window.onload = () => {
                // cart_btn = document.getElementById("cart_btn");
                // cart_btn.addEventListener('click', () => {
                //     var cart_content = JSON.parse(localStorage.getItem('add_cart'));
                //     console.log(cart_content);
                // })
                // //navbar自動抓localstorage 數量
                // var gat_cart_content = JSON.parse(localStorage.getItem('add_cart'))
                // var cart_btn_count = document.getElementById("cart_btn_count")
                // var objectLength = Object.keys(gat_cart_content).length;
                // cart_btn_count.textContent = objectLength
            }
        </script>
