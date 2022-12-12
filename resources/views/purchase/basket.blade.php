@extends('welcome')
@section('title', 'Корзина')
@section('content')
    <div class="container p-5">
        <h2 class="text-center p-4">Корзина</h2>
        <div class="row">
            <div class="col">
                <div class="main-grid mx-auto">
                    @if($sum == null)
                        <h3 class="text-center pb-4">Здесь еще ничего нет:)</h3>
                    @else
                        <h3 class="text-center pb-4">Общая сумма заказа: {{$sum}}</h3>
                    @endif
                    @foreach($purchases as $purchase)
                        @foreach($products as $product)
                            @if($product->id == $purchase->product_id && $purchase->status == 'В корзине')
                                <div class="bg-schedule">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Номер заказа</th>
                                            <th scope="col">Продукт</th>
                                            <th scope="col">Производитель</th>
                                            <th scope="col">Цена в ₽</th>
                                            <th scope="col">Категория</th>
                                            <th scope="col">Фото</th>
                                            <th scope="col">Количество</th>
                                            <th scope="col">Удалить</th>
                                        </tr>
                                        </thead>
                                            <tr>
                                                <th scope="row">{{$purchase->id}}</th>
                                                <td class="text-center">{{$product->name}}</td>
                                                <td class="text-center">{{$product->manufacturer}}</td>
                                                <td class="text-center">{{$purchase->sum}}</td>
                                                <td class="text-center">{{$product->category()}}</td>
                                                <td class="text-center"><img style="width: 150px;" src="{{asset('storage/app/public/'.$product->photo)}}" class="card-img-top" alt="..."></td>
                                                <td class="text-center">
                                                    <form action="{{route('basket_count',$purchase)}}" method="post">
                                                        @csrf
                                                        <input value="{{$purchase->count}}" onchange="this.form.submit()" style="width: 100px" class="form-control" id="count" name="count" type="number">
                                                    </form>
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{route('basket_delete',$purchase)}}" method="post">
                                                        @csrf
                                                        <button class="btn btn-outline-danger" type="submit">Удалить</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                @foreach($purchases as $purchase)
                    @if($purchase->status == 'В корзине')
                        <form action="{{route('basket_buy', $purchase)}}" method="post" class="d-flex justify-content-center">
                            @csrf
                            <button class="btn btn-success" type="submit">Заказать</button>
                        </form>
                        @break
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
