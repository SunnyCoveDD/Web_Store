<header>
    <div class="bg-light shadow">
        <nav class="container navbar navbar-expand-md">
            <div class="d-flex container-fluid">
                <a href="{{route('/')}}" style="font-size: 20px" class="text-success text-decoration-none">Web Store</a>
                <ul class="navbar-nav d-flex me-auto ps-2">
                    @auth()
                        @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('acc')}}">Личный кабинет</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('basket')}}">Корзина</a>
                            </li>
                        @elseif(\Illuminate\Support\Facades\Auth::user()->role_id == 2)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin')}}">Панель администратора</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                @auth()
                    <div class="nav-item text-end">
                        <a type="button" href="{{route('logout')}}" class="btn btn-danger">Выйти</a>
                    </div>
                @endauth
                @guest()
                    <div class="nav-item text-end">
                        <a type="button" href="{{route('auth')}}" class="btn btn-outline-success">Авторизация</a>
                        <a type="button" href="{{route('reg')}}" class="btn btn-success">Регистрация</a>
                    </div>
                @endguest
            </div>
        </nav>
    </div>
</header>
