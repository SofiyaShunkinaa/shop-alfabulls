@extends('layout.site', ['title' => 'Личный кабинет'])

@section('content')



            <section class="breadcrumbs">
    <div class="wrapper">
        <div class="breadcrumbs__inner">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="/">Главная</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4"></circle></svg></span><li class="breadcrumb-item active"><img src="/images/icons/icon-lk.svg" alt="Alfabulls Личный кабинет"></li></ol>
        </div>
    </div>
</section>
            <section class="profile">
                <div class="profile-bg-1"></div>
                <div class="profile-bg-2"></div>
                <div class="wrapper parent-animation">
                    <h1 style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">Личный кабинет</h1>

    <div action="" method="post" class="profile-form" id="office-profile-form" enctype="multipart/form-data" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">


    <div class="profile-form-items">
        <h3>Личная информация</h3>
        <div class="profile-form-item profile-form-item-info">
        @if (count($profiles))

            @foreach($profiles as $profile)

                <form action="{{ route('user.profile.avatar.update', ['profile' => $profile->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="profile-form-item-image-wrapper">
                        <label for="avatar-input" class="profile-form-item-image">
                            <img id="avatar-preview" 
                                src="{{ $profile->avatar ? asset('storage/' . $profile->avatar) : '/images/avatar-thumb.png' }}"
                                alt="Аватар пользователя"
                            >
                            <div class="profile-form-item-image-overlay">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                <span>Изменить аватар</span>
                                <span>Размер изображения: до 2Мб</span>
                            </div>  
                        </label>
                            
                        <input 
                            hidden type="file"
                            onchange="this.form.submit()"
                            id="avatar-input" 
                            name="avatar" 
                            accept="image/*" 
                            class="d-none"
                        >
                    </div>
                </form>
                <div class="profile-form-item-desc">

                <form method="POST" action="{{ route('user.profile.update', ['profile' => $profile->id]) }}">
    @method('PUT')
    @include('user.profile.part.form')
</form>






            @endforeach

        @else
        <div class="profile-form-item-desc">
                    <a href="{{ route('user.profile.create') }}" class="btn btn-success mb-4">
        Создать профиль
                </a>
                @endif


                <br>
                <form action="{{ route('user.logout') }}" method="post">
                        @csrf
                        <button style="
    width: 100%;
" type="submit" class="btn btn-primary">Выйти</button>
                    </form>
        </div>

        <div class="profile-form-item-balance">
                <div class="profile-form-item-balance-block">
                    <div class="profile-form-item-balance-block-bg"></div>
                    <div class="profile-form-item-balance-block-desc">
                        <h4>Мой кошелек</h4>
                        <div class="profile-form-item-balance-block-desc-score">
                            <p>{{ $user->bonus_points }}</p>
                            <img src="/images/coin-1.png" alt="">
                        </div>
                        <p class="profile-form-item-balance-block-desc-info">Оставь отзыв, получи бонусы.<br>1 бонус равен 1 руб</p>
                    </div>
                    <div class="profile-form-item-balance-block-img">
                        <img src="/images/lk-photo.png">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="profile-discount" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                        <div class="discontrol-discounts discontrol-selector cart-bonus" data-propkey="">
    <div class="cart-bonus-ul">
        <div class="cart-bonus-li comparison-true " style="background: linear-gradient(to right, rgb(255, 213, 163) 0%, rgb(255, 213, 163) 0%, transparent 0%, transparent 100%);">
    <p>5% </p>
</div>
<div class="cart-bonus-li comparison-true ">
    <p>7% </p>
</div>
<div class="cart-bonus-li comparison-true ">
    <p>10% </p>
</div>
<div class="cart-bonus-li comparison-true ">
    <p>12% </p>
</div>
    </div>
    <p class="cart-bonus-desc">Ваша постоянная скидка {{ $user->discount_percent }}%</p>




        <script>
    document.addEventListener('DOMContentLoaded', function() {
            var cartBonusUl = document.querySelector('.cart-bonus-ul');
        if (!cartBonusUl) return;

        function animateGradient(element, targetProgress, duration) {
            var start = null;
            function step(timestamp) {
                if (!start) start = timestamp;
                var elapsed = timestamp - start;
                var progressFraction = elapsed / duration;
                if (progressFraction > 1) progressFraction = 1;
                var currentProgress = targetProgress * progressFraction;
                element.style.background = 'linear-gradient(to right, #FFD5A3 0%, #FFD5A3 '
                    + currentProgress.toFixed(2) + '%, transparent '
                    + currentProgress.toFixed(2) + '%, transparent 100%)';
                if (progressFraction < 1) {
                    window.requestAnimationFrame(step);
                }
            }
            window.requestAnimationFrame(step);
        }

        var observer = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {

                                                    var bonusItems = document.querySelectorAll('.cart-bonus-ul .cart-bonus-li');
                            if (bonusItems.length > 0) {
                                animateGradient(bonusItems[0], 0, 1000);
                            }

                    observer.disconnect();
                }
            });
        }, { threshold: 0.1 });

        observer.observe(cartBonusUl);
                var discountDesc = document.querySelector('.cart-bonus-desc');
        if (discountDesc) {
            discountDesc.innerHTML = 'Ваша постоянная скидка {{ $user->discount_percent }}%';
        }
    });
</script>

</div>
                    </div>


<br>


                    <div class="profile-history" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                        <h3>Текущие заказы</h3>



 @if($orders->count())

        @foreach($orders as $order)

                            <div class="order-row">
    <div class="order-row-head">
        Заказ номер {{ $order->id }} {{ $order->created_at->format('d.m.Y H:i') }}
    </div>
    <div class="history-row">
        <div class="order-row-status">
            <!-- <div class="order-row-status-pay">
                <p class="order-row-status-pay-1">Способ оплаты:</p>
                <p class="order-row-status-pay-2">СБП</p>
            </div> -->
            <div class="order-row-status-tk-cont">
            @php
                $statusColors = [
                    2 => '#92EBFF', // обработан
                    4 => '#B1FFBF', // завершен
                    1 => '#FFD580',  // ожидание
                    3 => '#FFB6B6',  // оплачен
                ];

                $statusColor = $statusColors[$order->status] ?? '#E0E0E0'; // По умолчанию
            @endphp

            <p class="order-row-status-tk" style="background-color: {{ $statusColor }};">
                {{ $statuses[$order->status] }}
            </p>
            </div>
            <div style="display: flex; gap: 5px; white-space: nowrap;">
            <div class="order-row-status-time">
                <p class="order-row-status-time-1">{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('j M') }}</p>
                <p class="order-row-status-time-2">Дата заказа</p>
            </div>
            <div class="arrow-svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="51" height="8" viewBox="0 0 51 8" fill="none">
                <path d="M50.3536 4.35355C50.5488 4.15829 50.5488 3.84171 50.3536 3.64645L47.1716 0.464466C46.9763 0.269204 46.6597 0.269204 46.4645 0.464466C46.2692 0.659728 46.2692 0.976311 46.4645 1.17157L49.2929 4L46.4645 6.82843C46.2692 7.02369 46.2692 7.34027 46.4645 7.53553C46.6597 7.7308 46.9763 7.7308 47.1716 7.53553L50.3536 4.35355ZM0 4.5H50V3.5H0V4.5Z" fill="white"/>
                </svg>
            </div>
            <div class="order-row-status-time">
                <p class="order-row-status-time-1">
                    {{ \Carbon\Carbon::parse($order->created_at)->addDays($order->delivery_date)->translatedFormat('j M') }}
                </p>
                <p class="order-row-status-time-2">Дата получения</p>
            </div>
            </div>
        </div>
        <div class="history-cart">
            <div class="history-cart-cont">
                <p class="history-cart-1">Адрес доставки:</p>
                <p class="history-cart-2">
                    {{$order->address}}
                </p>
            </div>
                        <p class="history-cart-3">Товары / {{ $order->items->count() }} шт.</p>
            <div class="history-cart-items" style="display: flex; gap: 5px;">
                   @foreach($order->items as $item)

                  @php
                    
                  @endphp 
                        <div class="order-desc-item-zakaz-item-img">
                                    <a href="{{ route('catalog.product', $item->product_id) }}" style="
                                    display: block; height: 77px;                                         
                                    width: 122px;
                                        display: block;
                                        border-radius: 14px;
                                        text-align: center;
                                        overflow: hidden;"
                                        >
                                            @php($url = url('storage/catalog/product/source/' . $item->product->image))
                                    <img src="{{ $url }}" alt="{{ $item->product->name }}" title="{{ $item->product->name }}" style=" height: 77px; box-shadow: none; margin: 0;">
                                </a>
                        </div>
                   @endforeach
            </div>
        </div>
        <div class="history-total">
            <p class="history-total-1">Cумма</p>
            <p class="history-total-2">{{ number_format($order->amount, 2, '.', '') }}  руб</p>
        </div>
    </div>
</div>
 @endforeach
  @else
        <p>Заказов пока нет</p>
    @endif






                    </div>

                </div>
            </section>







@endsection
