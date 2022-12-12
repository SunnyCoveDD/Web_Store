@extends('admin.admin')
@section('title', 'Панель администратора')
@section('content')
<div class="container">
    <div id="shop" class="mb-5">
        <h2 class="pb-5">Товары</h2>
        <div class="d-flex gap-5 flex-wrap">
            <div class="container">
                <div class="d-flex gap-5 flex-wrap">
                    @foreach($products as $product)
                        <div class="card" style="width: 18rem;">
                            <img src="{{asset('storage/app/public/'.$product->photo)}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->name}}</h5>
                                <p class="card-text"><b>Производитель:</b> {{$product->manufacturer}}<br><b>Цена:</b> {{$product->price}} ₽
                                    <br><b>Категория:</b> {{$product->category()}}</p>
                                <a href="#" class="link-secondary text-decoration-none">Изменить</a>
                                <a href="#" class="btn btn-danger ms-2">Удалить</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
