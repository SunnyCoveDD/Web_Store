@extends('admin.admin')
@section('title', 'Добавление товара')
@section('content')
    <form class="container" method="post" enctype="multipart/form-data">
        <div class="row d-flex justify-content-center mb-4">
            <h3 class="text-center pb-5">Создание заявки</h3>
            <div class="col-6">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name">
                    @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="manufacturer" class="form-label">Производитель</label>
                    <input name="manufacturer" type="text" class="form-control @error('manufacturer') is-invalid @enderror" id="manufacturer">
                    @error('manufacturer')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Цена, в ₽</label>
                    <input name="price" type="number" class="form-control @error('price') is-invalid @enderror" id="price">
                    @error('price')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Категория</label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" id="category_id">
                        <option selected>Выберите категорию</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Фото</label>
                    <input name="photo" type="file" class="form-control @error('photo') is-invalid @enderror" id="password">
                    @error('photo')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Создание продукта</button>
            </div>
        </div>
    </form>
@endsection
