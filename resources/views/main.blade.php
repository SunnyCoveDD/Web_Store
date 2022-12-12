@extends('welcome')
@section('title', 'Главная страница')
@section('content')
   <main>
       <div class="bg-img">
           <div class="container align-content-center pt-5">
               <h1 class="text-center pt-4">Совершенство в деталях</h1>
               <p style="font-size: 18px; width: 500px" class="m-auto text-center pt-3">Мы разработали специальную формулу для вашего совершенствования, изобретая косметику заново</p>
               <div class="d-flex justify-content-center pt-3"><a href="#shop" class="btn btn-outline-success">Узнать больше</a></div>
           </div>
       </div>
      <div class="container">
          <div id="shop" class="mt-5 mb-5">
              <h2 class="pb-5 pt-2">Товары</h2>
              <div class="d-flex gap-5 flex-wrap">
                  @foreach($products as $product)
                      <form action="" method="post">
                          @csrf
                          <div class="card" style="width: 18rem;">
                              <img src="{{asset('storage/app/public/'.$product->photo)}}" class="card-img-top" alt="...">
                              <input type="hidden" name="id" value="{{$product->id}}">
                              <input type="hidden" name="price" value="{{$product->price}}">
                              <div class="card-body">
                                  <h5 class="card-title">{{$product->name}}</h5>
                                  <p class="card-text"><b>Производитель:</b> {{$product->manufacturer}}<br><b>Цена:</b> {{$product->price}} ₽
                                      <br><b>Категория:</b> {{$product->category()}}</p>
                                      @if(!\Illuminate\Support\Facades\Auth::id())
                                          <p class="card-text">Для покупки товара необходимо авторизоваться</p>
                                          <a href="{{route('auth')}}" class="btn btn-primary">Авторизация</a>
                                      @endif
                                      @if($purchases != null)
                                          @foreach($purchases as $purchase)
                                              @if(\Illuminate\Support\Facades\Auth::id() && \Illuminate\Support\Facades\Auth::user()->role_id == 1 && $purchase->product_id == $product->id && $purchase->status != 'В корзине')
                                                  <button type="submit" class="btn btn-primary">Заказать</button>
                                                  @break
                                              @endif
                                          @endforeach
                                      @endif
                                      @foreach($purchases as $purchase)
                                          @if(\Illuminate\Support\Facades\Auth::id() && $purchase->product_id == $product->id && $purchase->status != 'Куплен')
                                            <a href="{{route('basket')}}" class="btn btn-primary">Товар уже в корзине</a>
                                              @break
                                          @endif
                                      @endforeach
                              </div>
                          </div>
                      </form>
                  @endforeach
              </div>
          </div>
      </div>
   </main>
@endsection
