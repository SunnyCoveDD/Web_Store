@extends('welcome')
@section('title', 'Авторизация')
@section('content')
    <div class="container p-5">
        <h2 class="text-center p-4">Авторизация</h2>
        <div class="row">
            <div class="col"></div>
            <div class="col-5">
                <form method="post">
                    @if(session()->has('success'))
                        <div class="alert alert-success">{{session()->get('success')}}</div>
                    @endif
                    @if(session()->has('errorLogin'))
                        <div class="alert alert-danger">{{session()->get('errorLogin')}}</div>
                    @endif
                    @csrf
                    <div class="mb-3">
                        <label class="form-label mb-2" for="loginInput">Логин</label>
                        <input class="form-control @error('login') is-invalid @enderror" id="loginInput" name="login" type="text">
                        @error('login')
                        <div id="invalidLogin" class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-2" for="passwordInput">Пароль</label>
                        <input class="form-control @error('password') is-invalid @enderror" id="passwordInput" name="password" type="password">
                        @error('password')
                        <div id="invalidPassword" class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button class="btn btn-success d-block m-auto" type="submit">Войти</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
