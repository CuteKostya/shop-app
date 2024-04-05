<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="/css/main.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="/js/main.js"></script>

    @vite('resources/js/app.js')

    <title>@yield('title')</title>
</head>

<body>
<header class="pt-3">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('products') ? 'active' : null }}"
                           href="{{route('products')}}">Каталог</a>
                    </li>
                    <li class="nav-item">

                        <a class="nav-link {{ request()->is('basket') ? 'active' : null }}"
                           href="{{route('basket')}}">
                            Корзина
                        </a>
                    </li>
                    <li class="nav-item">
                        <h3 class="badge badge-light" id="countProducts"
                            style="color: red; background-color: gray;">
                        </h3>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('order') ? 'active' : null }}"
                           href="{{route('order')}}">
                            Заказы
                        </a>
                    </li>
                    <li class="nav-item">
                        @if(Auth::user() != null)
                            @if(Auth::user()->admin)
                                <a class="nav-link {{ request()->is('adminPanel') ? 'active' : null }}"
                                   href="{{route('adminPanel')}}">
                                    Панель администратора
                                </a>
                            @endif
                        @endif
                    </li>
                </ul>

            </div>
        </div>

        <form class="d-flex">
            @if(Auth::user() == null)
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('login.logout')}}">Вход </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('register')}}">Регистрация</a>
                    </li>
                </ul>

            @else
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link text-nowrap">{{Auth::user()->name}} </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" href="{{route('login.logout')}}">Logout... </a>
                    </li>
                </ul>
            @endif
        </form>
    </nav>
</header>
<main id="app" class="flex-shrink-0 pt-5 ">

    @yield('main_content')
    <example-component></example-component>
</main>

<script>
    new Vue({
        el: '#app',
        data: {
            countProducts: 10,
        },
        mounted: function () {
            this.extracted();
        },
        methods: {
            extracted: function () {
                var that = this;
                $.ajax({
                    url: '/helper/countProduct',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        that.countProducts = data['countProducts'];
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            },
            addToBasket: function (productId) {
                var that = this;
                $.ajax({
                    url: "/basket/store",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        productId: productId,
                    },

                    success: function (data) {
                        if (data['count'] > 0) {
                            $("#buttonAddProduct" + data['productId']).css("display", "none");
                            $("#formAddProduct" + data['productId']).css("display", "block");
                            $("#countProduct" + data['productId']).text(data['count']);

                        }
                        console.log(data['productId']);
                        that.extracted();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            },
            updateToBasket: function (productId, sign) {
                var that = this;
                $.ajax({
                    url: "/products/" + productId,
                    type: "put",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        productId: productId,
                        sign: sign,
                    },
                    success: function (data) {
                        $("#countProduct" + productId).text(data['count']);
                        if (data['count'] <= 0) {
                            $("#buttonAddProduct" + productId).css("display", "block");
                            $("#formAddProduct" + productId).css("display", "none");
                        }
                        that.extracted();

                        console.log(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }

        },
    })
</script>
</body>

</html>
