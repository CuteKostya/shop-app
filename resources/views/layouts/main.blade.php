<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <title>@yield('title')</title>
</head>

<body>
<header class="pt-3">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('products')}}">Каталог</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('basket')}}">
                            Корзина
                        </a>
                    </li>
                    <li class="nav-item">
                        @if($countProducts)
                            <h3 class="badge badge-light"
                                style="color: red; background-color: gray;">{{ $countProducts }}
                            </h3>
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('order')}}">
                            Заказы
                        </a>
                    </li>
                    <li class="nav-item">
                        @if(Auth::user() != null)
                            @if(Auth::user()->admin)
                                <a class="nav-link" aria-current="page" href="{{route('adminPanel')}}">
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
<main class="flex-shrink-0 pt-5 container">
    @yield('main_content')
</main>
</body>

</html>
