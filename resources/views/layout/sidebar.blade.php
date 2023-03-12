<head>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .sidebar {
            height: 100%;
            width: 280px;
            position: fixed;
            top: 55px;
            left: 0;
            overflow: auto;
            border-width: 2px;
        }

        .sidebar ul li a:hover,
        .sidebar ul li a:active {
            background-color: #f8f9fa1e;
            color: #333;
        }

        ,
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<aside class="d-flex flex-column flex-shrink-0 p-3 text-white bg-secondary sidebar col-md-2">
    <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
        </svg>
        <span class="fs-4">會員資訊</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="#" class="nav-link text-white aside" aria-current="page" id="order_list">
                <svg class="bi me-2" width="16" height="16">
                </svg>
                訂單列表
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-white aside" id="order_history">
                <svg class="bi me-2" width="16" height="16">
                    <use xlink:href="#speedometer2" />
                </svg>
                歷史訂單
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-white aside" id="shopping_cart">
                <svg class="bi me-2" width="16" height="16">
                </svg>
                購物車
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-white aside" id="my_favorite">
                <svg class="bi me-2" width="16" height="16">
                </svg>
                我的最愛
            </a>
        </li>
        <li>
            <a href="#" class="nav-link text-white aside" id="edit_userdata">
                <svg class="bi me-2" width="16" height="16">
                </svg>
                會員資料編輯
            </a>
        </li>
    </ul>
    <hr>
</aside>
<script>
    //控制sidebar active 位置
    const links = document.querySelectorAll('.nav-link');
    links.forEach(link => {
        link.addEventListener('click', () => {
            links.forEach(otherLink => otherLink.classList.remove('active'));
            link.classList.add('active');
        });
    });
</script>

</body>
