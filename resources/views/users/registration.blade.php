@extends('welcome')
@section('title', 'Регистрация')
@section('content')
    <form class="container" method="post">
        <div class="row d-flex justify-content-center pt-5">
            <h3 class="text-center pb-4">Регистрация</h3>
            <div class="col-6">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">ФИО</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name">
                    @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input name="login" type="text" class="form-control @error('login') is-invalid @enderror" id="login">
                    @error('login')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
                    @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль повторно</label>
                    <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password">
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3 form-check">
                    <input name="success" type="checkbox" class="form-check-input @error('success') is-invalid @enderror" id="check">
                    <label class="form-check-label" for="check">Согласен на обработку персональных данных</label>
                    @error('success')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Регистрация</button>
            </div>
        </div>
    </form>
@endsection
