<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="resources/css/app.css">
    <link rel="stylesheet" href="/resources/css/bootstrap.css">
    <link rel="stylesheet" href="/resources/css/bootstrap.min.css">
    <script src="/resources/js/bootstrap.js"></script>
    <script src="/resources/js/app.js"></script>
    <script src="/resources/js/bootstrap.min.js"></script>
    <script src="/resources/js/bootstrap.bundle.min.js"></script>
    <title>@yield('title', 'Панель администратора')</title>
</head>
<body>
@include('components.header')
<div class="container p-5">
    <h2 class="text-center p-4">Панель администратора</h2>
    <div class="row navbar navbar-expand-md">
        <div class="col-6">
            <ul class="navbar-nav d-flex me-auto ps-2">
                <li class="nav-item">
                    <a class="nav-link link-dark" href="{{route('admin')}}">Товары</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark" aria-current="page" href="{{route('add_product')}}">Добавление товара</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark" href="">Добавление категорий</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@yield('content')
@include('components.footer')
</body>
</html>
