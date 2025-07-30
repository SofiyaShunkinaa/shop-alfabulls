@extends('layout.site', ['title' => 'Заказ размещен'])

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
                <h1 class="anim-title" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px); text-align: center;">Неудача! Попробуйте еще раз!</h1>
                <div class="order__inner" id="msCart">



            </div>
</div>
</section>






@endsection
