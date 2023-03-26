@extends('layout.master')
<style>
    .exmaple {
        border-radius: 3%;
        box-shadow: 0 0 20px 10px rgba(102, 100, 100, 0.5);
    }

    .carousel-item img {
        width: 1000px;
        height: 500px;
        object-fit: cover;
        transition: all .5s ease;
    }

    .carousel-item.active img {
        transform: scale(1.1);
    }

    .text-content {
        background-color: rgb(227, 223, 223);
        width: 900px;
        margin: 50px auto;
        border-radius: 3%;
        text-align: center;
        min-height: 600px;
    }

    .text-content p {
        margin: 20px;
        padding: 10px
    }

    .text-content img {
        max-width: 600px;
        margin: 20px;
        border-radius: 1%;
    }

    .shop_area {
        width: 900px;
        margin: 50px auto;
        justify-content: end
    }
</style>
@section('title', '商品頁面')
<div class="bg-secondary">
    @section('content')
        <div class="container content" style="margin-top:50px">
            <div style="text-align:center;">
                <h2 class="p-5">{{ $data['name'] }}</h2>
            </div>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($img_url as $key => $value)
                        <button type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide-to={{ $key }} class="@if ($loop->first) active @endif"
                            aria-current="true" aria-label="Slide{{ $key }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner mx-auto exmaple" style="max-width:1000px;">
                    @foreach ($img_url as $value)
                        <div class="carousel-item @if ($loop->first) active @endif " data-bs-interval="4000">
                            <img src="{{ asset($value) }}" class="d-block rounded " alt="...">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev" style="width:40%;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next" style="width:40%;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="shop_area d-flex align-items-center">
                <input type="number" class="form-control me-2" placeholder="購買數量" style="width:150px;" id="count"
                    method="count">
                <button class="btn btn-success me-2 shopBtn" type="button" method="buy_now" id="buy_now">
                    <i class="fa-solid fa-truck-fast"></i>立即購買</button>
                <button class="btn btn-primary me-2 shopBtn" type="button" method="add_cart" id="add_cart">
                    <i class="fa-sharp fa-solid fa-cart-plus m-1"></i>加入購物車</button>
                <button class="btn btn-danger m2 shopBtn" id="add_focus" method="add_focus">
                    <i class="fa-solid fa-heart-circle-plus"></i>加入關注</button>
            </div>

            <div class="text-content">
                <p>
                    圖片介紹:
                </p>
                <p>
                    {!! $data['introduction'] !!}
                </p>
                @foreach ($img_url as $value)
                    <div class="">
                        <img src="{{ asset($value) }}">
                    </div>
                @endforeach



            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script>
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
            };
            $(document).ready(function() {
                var shopBtn = document.querySelectorAll('.shopBtn');
                shopBtn.forEach(element => {
                    element.addEventListener('click', () => {
                        var method = element.getAttribute("method");
                        var count = document.getElementById('count');
                        // 加入購物車
                        if (method == "add_cart") {
                            var product_id = {{ $data['id'] }}
                            $.ajax({
                                type: 'post',
                                url: '{{ route('cartHandler') }}',
                                dataType: "json",
                                headers: {
                                    'X-CSRF-Token': '{{ csrf_token() }}'
                                },
                                data: {
                                    method: method,
                                    count: count.value,
                                    product_id: product_id
                                },
                                success: function(res) {
                                    console.log(res);
                                },
                                error: function(fail) {
                                    console.log(fail);
                                }
                            });
                        }
                    })

                });
            })
        </script>
    @endsection
