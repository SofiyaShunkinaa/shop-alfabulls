@extends('layout.site', ['title' => 'Ваша корзина'])

@section('content')




            <section class="breadcrumbs">
    <div class="wrapper">
        <div class="breadcrumbs__inner">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="/">Главная</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4"></circle></svg></span><li class="breadcrumb-item active">Ваша корзина</li></ol>
        </div>
    </div>
</section>
            <section class="order">
               <div class="wrapper">
                <h1 class="anim-title" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px); text-align: center;">Ваша корзина</h1>
                <div class="order__inner" id="msCart">


                  <div class="order-desc">
                      <div class="order-desc-item">
                          <div class="order-desc-item-title">
                              <p>1</p>
                              <h3>Товары в заказе</h3>
                          </div>

                          @if (count($products))

            <div class="order-desc-item-zakaz">

                 @foreach($products as $product)

                                    <!--  -->
                    <div class="order-desc-item-zakaz-item">
                        <div class="order-desc-item-zakaz-item-img">
                                                            <a href="{{ route('catalog.product', ['product' => $product->slug]) }}">
                                                                 @php($url = url('storage/catalog/product/image/' . $product->image))
                                    <img src="{{ $url }}" alt="Консерва для кошек (курица), 100г" title="Консерва для кошек (курица), 100г">
                                </a>
                        </div>
                        <div class="order-desc-item-zakaz-item-title">
                                                            <a href="{{ route('catalog.product', ['product' => $product->slug]) }}">{{ $product->name }}</a>
                        </div>

                        <div class="order-desc-item-zakaz-item-total">
                            <h5>Кол-во</h5>

                            <div style="
                                    display: flex;
                                    justify-content: center;
                                ">
                            <form action="{{ route('basket.minus', ['id' => $product->id]) }}"
                                                  method="post" class="d-inline" style="
                                margin-right: 20px;
                                width: auto;
                            ">
                                                @csrf
                                                <button type="submit" class="m-0 p-0 border-0 bg-transparent" style='    background: none;
    border: 0px;
    color: #fff;
    font-size: 20px;'>
                                                    -
                                                </button>
                                            </form>
                                            <span class="mx-1">{{ $product->pivot->quantity }}</span>
                                            <form action="{{ route('basket.plus', ['id' => $product->id]) }}"
                                                  method="post" class="d-inline" style="
                            width: auto;
                            margin-left: 23px;
                        ">
                                                @csrf
                                                <button type="submit" class="m-0 p-0 border-0 bg-transparent" style='    background: none;
    border: 0px;
    color: #fff;
    font-size: 20px;'>
                                                    +
                                                </button>
                                            </form>
                                        </div>
                        </div>

                        <div class="order-desc-item-zakaz-item-cost">
                            <h5>Сумма</h5>
                            <p class="order-desc-item-zakaz-item-cost">{{ number_format($product->price * $product->pivot->quantity, 2, '.', '') }} ₽</p>
                        </div>
                        <div class="">
                                 <form action="{{ route('basket.remove', ['id' => $product->id]) }}"
                                  method="post">
                                @csrf
                                <button type="submit" class="m-0 p-0 border-0 bg-transparent" style="
    background: none;
    border: 0px;
    color: #fff;
    font-family: 'Buyan';
    font-size: 22px;
    font-weight: 700;
    margin-left: 20px;
    padding-top: 18px;
">
                                    Удалить
                                </button>
                                </form>
                        </div>

                    </div>

                     @endforeach


                </div>

                <div style="
                    display: flex;
                    justify-content: space-between;
                    margin-top: 20px;
                    gap: 10px;
                ">

                    <form action="{{ route('basket.clear') }}" method="post" class="text-right">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger mb-4 mt-0">
                                Очистить корзину
                            </button>
                    </form>
                     <a href="{{ route('basket.checkout') }}" class="btn btn-success float-right">
                        Оформить заказ
                    </a>
                </div>
                  @else
        <p>Ваша корзина пуста</p>
    @endif


                      </div>
                    </div>
            </div>
</div>
</section>










@endsection
