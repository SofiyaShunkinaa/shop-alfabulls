<!DOCTYPE html>
<html lang="ru">

<head>
    <meta name="yandex-verification" content="29728ba900d765ba" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'AlfaBulls' }}</title>
    <base href="" />

    <script src="https://api-maps.yandex.ru/2.1/?apikey=a5495493-75c5-48a9-bf96-dd598ce5032b&lang=ru_RU" type="text/javascript"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/css/style.css">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/site.js') }}"></script>
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="https://alfabulls.com/images/icons/favicons/apple-touch-icon.png">

    <link rel="icon" type="image/png" sizes="16x16" href="https://alfabulls.com/images/icons/favicons/favicon-16x16.png">

    <link rel="mask-icon" href="/images/icons/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/images/icons/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#252525">
    <meta name="msapplication-config" content="/images/icons/favicons/browserconfig.xml">
    <meta name="theme-color" content="#252525">
    <meta name="format-detection" content="telephone=no">
    <meta name="yandex-verification" content="29728ba900d765ba" />
<link rel="stylesheet" href="https://alfabulls.com/assets/components/minishop2/css/web/default.css?v=667ec14321" type="text/css" />
<link rel="stylesheet" href="https://alfabulls.com/assets/components/minishop2/css/web/lib/jquery.jgrowl.min.css" type="text/css" />
<script>miniShop2Config = {"close_all_message":"\u0437\u0430\u043a\u0440\u044b\u0442\u044c \u0432\u0441\u0435","cssUrl":"\/assets\/components\/minishop2\/css\/web\/","jsUrl":"\/assets\/components\/minishop2\/js\/web\/","actionUrl":"\/assets\/components\/minishop2\/action.php","ctx":"web","price_format":[2,"."," "],"price_format_no_zeros":true,"weight_format":[3,"."," "],"weight_format_no_zeros":true};</script>
<link rel="stylesheet" href="https://alfabulls.com/assets/components/ajaxform/css/default.css" type="text/css" />
<link rel="stylesheet" href="https://alfabulls.com/assets/components/mspromocode2/css/web/main.css?v=1744967774" type="text/css" />
<link rel="stylesheet" href="https://alfabulls.com/assets/components/easycomm/css/web/ec.default.css" type="text/css" />
<script type="text/javascript">easyCommConfig = {"ctx":"web","jsUrl":"\/assets\/components\/easycomm\/js\/web\/","cssUrl":"\/assets\/components\/easycomm\/css\/web\/","imgUrl":"\/assets\/components\/easycomm\/img\/web\/","actionUrl":"\/assets\/components\/easycomm\/action.php","reCaptchaSiteKey":""}</script>
<link rel="stylesheet" href="https://alfabulls.com/assets/components/discontrol/css/web/default.css" type="text/css" />
</head>

<body>
    <div class="shell">

  <header class="header">
    <div class="header-bg-1"></div>
    <div class="wrapper">
        <div class="header__inner">
            <div class="logo">
                <a href="/" class="logo-src">
                    <img src="/images/icons/logo_alfabulls.svg" alt="Alfabulls">
                </a>
            </div>
            <div class="navigation">
                <div class="navigation-menu">
                    <nav class="menu">
                        <ul>

                        <li  class="first {{ Route::currentRouteName() == 'catalog.index' ? 'active' : '' }}"><a href="/catalog/index" class="src link" >Каталог</a></li>
                        <li class="{{ Route::currentRouteName() == 'about' ? 'active' : '' }}"><a href="/about" class="src link" >О магазине</a></li>
                        <li class="{{ Route::currentRouteName() == 'nursery' ? 'active' : '' }}"><a href="/nursery" class="src link" >О питомнике</a></li>
                        <li class="{{ Route::currentRouteName() == 'dog' ? 'active' : '' }}"><a href="/dogs" class="src link" >Щенки</a></li>
                        <li class="{{ Route::currentRouteName() == 'pay-delivery' ? 'active' : '' }}"><a href="/pay-delivery" class="src link" >Оплата и доставка</a></li>
                        <li ><a href="/#reviews" class="src link" >Отзывы</a></li>
                        <li  class="last {{ Route::currentRouteName() == 'contacts' ? 'active' : '' }}"><a href="/contacts" class="src link" >Контакты и магазины</a></li>


                        <div id="msmcd-dropdown" class="dropdown msMiniCart" data-msmcddropdown="false">
    <div class="not_empty" style="display: block;">
        <li class='zamenabaska'>
            <a 
                href="javascript://" 
                class="src link cart-desktop header-cart" 
                onclick="$('.cart').addClass('show').removeClass('hide');"                    
            >
                <img src="/images/icons/icon-cart.svg" alt="Alfabulls Корзина"    >
               <span  class="ms2_total_count" @if (!$positions) style="display: none;" @endif> {{ $positions }} </span>
            </a>
     </li>
    </div>

</div>

                        <li>
                            @guest
                            <a href="{{ route('user.login') }}" class="src link"><img src="/images/icons/icon-lk.svg" alt="Личный кабинет"></a>
                             @else
                             <a href="{{ route('user.index') }}" class="src link"><img src="/images/icons/icon-lk.svg" alt="Личный кабинет"></a>
                               @endif
                        </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="user-info">
                <div id="msmcd-dropdown" class="dropdown msMiniCart" data-msmcddropdown="false">
    <div class="not_empty zamenabaska" style="display: block;">
                <a href="javascript://"
                onclick="$('.cart').addClass('show').removeClass('hide');"  class="header-cart cart-mobile src link" >
                    <img src="/images/icons/icon-cart.svg" alt="Alfabulls Корзина">
                    <span  class="ms2_total_count">@if ($positions) {{ $positions }} @endif</span>
                </a>
    </div>

</div>

                @guest
                             <a href="{{ route('user.login') }}" class="lk-mobile">
                    <img src="/images/icons/icon-lk.svg" alt="Личный кабинет">
                </a>
                 @else
                             <a href="{{ route('user.index') }}" class="lk-mobile">
                    <img src="/images/icons/icon-lk.svg" alt="Личный кабинет">
                </a>

                 @endif
                <div class="burger-btn">
                    <div class="burger-btn-open">
                        <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M5 12H20" stroke="#B5B4B4" stroke-width="1" stroke-linecap="round">
                                </path>
                                <path d="M5 17H20" stroke="#B5B4B4" stroke-width="1" stroke-linecap="round">
                                </path>
                                <path d="M5 7H20" stroke="#B5B4B4" stroke-width="1" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="burger-btn-close">
                        <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M16.9498 8.46447C17.3404 8.07394 17.3404 7.44078 16.9498 7.05025C16.5593 6.65973 15.9261 6.65973 15.5356 7.05025L12.0001 10.5858L8.46455 7.05025C8.07402 6.65973 7.44086 6.65973 7.05033 7.05025C6.65981 7.44078 6.65981 8.07394 7.05033 8.46447L10.5859 12L7.05033 15.5355C6.65981 15.9261 6.65981 16.5592 7.05033 16.9497C7.44086 17.3403 8.07402 17.3403 8.46455 16.9497L12.0001 13.4142L15.5356 16.9497C15.9261 17.3403 16.5593 17.3403 16.9498 16.9497C17.3404 16.5592 17.3404 15.9261 16.9498 15.5355L13.4143 12L16.9498 8.46447Z"
                                    fill="#B5B4B4"></path>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mobile-menu">
    <div class="mobile-menu__inner">
        <div class="mobile-menu-nav">
            <ul>
                <li  class="first"><a href="/catalog/index" class="src link" >Каталог</a></li>
                <li ><a href="/about" class="src link" >О магазине</a></li>
                <li ><a href="/nursery" class="src link" >О питомнике</a></li>
                <li ><a href="/dogs" class="src link" >Щенки</a></li>
                <li ><a href="/pay-delivery" class="src link" >Оплата и доставка</a></li>
                <li ><a href="/#reviews" class="src link" >Отзывы</a></li>
                <li  class="last"><a href="/contacts" class="src link" >Контакты и магазины</a></li>
            </ul>
        </div>
    </div>
</div>
        <main class="main">
            @yield('content')
        </main>



</div>
 <footer class="footer {{ request()->is('/') ? 'home' : '' }}">
    <div class="footer-bg-1"></div>
    <div class="footer-bg-2"></div>
    <div class="wrapper">
        <div class="footer__inner">
            <div class="footer-logo">
                <a href="reviews.html">
                    <img src="/images/logo-footer.png">
                </a>

                <div class="footer-items_mini">
                    <a href="javascript://"
                onclick="$('.cart').addClass('show').removeClass('hide');"  class="header-cart cart-mobile src link" >
                    <img src="/images/icons/icon-cart.svg" alt="Alfabulls Корзина">
                    <span  class="ms2_total_count">@if ($positions) {{ $positions }} @endif</span>
                </a>
    

                @guest
                             <a href="{{ route('user.login') }}" class="lk-mobile">
                    <img src="/images/icons/icon-lk.svg" alt="Личный кабинет">
                </a>
                 @else
                             <a href="{{ route('user.index') }}" class="lk-mobile">
                    <img src="/images/icons/icon-lk.svg" alt="Личный кабинет">
                </a>

                 @endif

                 <div class="burger-btn">
                    <div class="burger-btn-open">
                        <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M5 12H20" stroke="#B5B4B4" stroke-width="1" stroke-linecap="round">
                                </path>
                                <path d="M5 17H20" stroke="#B5B4B4" stroke-width="1" stroke-linecap="round">
                                </path>
                                <path d="M5 7H20" stroke="#B5B4B4" stroke-width="1" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="burger-btn-close">
                        <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M16.9498 8.46447C17.3404 8.07394 17.3404 7.44078 16.9498 7.05025C16.5593 6.65973 15.9261 6.65973 15.5356 7.05025L12.0001 10.5858L8.46455 7.05025C8.07402 6.65973 7.44086 6.65973 7.05033 7.05025C6.65981 7.44078 6.65981 8.07394 7.05033 8.46447L10.5859 12L7.05033 15.5355C6.65981 15.9261 6.65981 16.5592 7.05033 16.9497C7.44086 17.3403 8.07402 17.3403 8.46455 16.9497L12.0001 13.4142L15.5356 16.9497C15.9261 17.3403 16.5593 17.3403 16.9498 16.9497C17.3404 16.5592 17.3404 15.9261 16.9498 15.5355L13.4143 12L16.9498 8.46447Z"
                                    fill="#B5B4B4"></path>
                            </g>
                        </svg>
                    </div>
                </div>
                </div>
            </div>
            
            <div class="footer-menu">
                <div class="footer-menu-ul">
                    <ul>
                        <li>
                            <a href="/catalog/index"><img src="/images/icons/icon-footer-1.svg">Каталог</a>
                        </li>
                        <li>
                            <a href="/about"><img src="/images/icons/icon-footer-2.svg">О магазине</a>
                        </li>
                        <li>
                            <a href="/nursery"><img src="/images/icons/icon-footer-2.svg">О питомнике</a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <a href="/#reviews"><img src="/images/icons/icon-footer-4.svg">Отзывы</a>
                        </li>
                        <li>
                            <a href="/dogs"><img src="/images/icons/icon-footer-5.svg">Щенки</a>
                        </li>
                        <li>
                            <a href="/pay-delivery"><img src="/images/icons/icon-footer-6.svg">Оплата и доставка</a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <a href="/contacts"><img src="/images/icons/icon-footer-7.svg">Контакты и магазины</a>
                        </li>
                        <li>
                            <a href="https://alfabulls.com/profile/"><img src="/images/icons/icon-footer-8.svg">Личный кабинет</a>
                        </li>
                        <li>
                            <a href="javascript://" onclick="$('.cart').addClass('show').removeClass('hide');"><img src="/images/icons/icon-footer-9.svg">Корзина</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-menu-contacts">
                    <p>© Все права защищены<br>
                        ИП Сестров Дмитрий Викторович<br>
ИНН 760213318412 / ОГРНИП 322762700052672
                    </p>
                    <a href="tel:+7 980-742-78-94" class="footer-menu-contacts-tel"><img src="/images/icons/icon-footer-tel.svg">+7 980-742-78-94</a>
                </div>
                <div class="footer-menu-desc">
                    <p>* Социальная сеть Instagram принадлежит компании Meta Platforms Inc.,<br>
                    которая запрещена на территории РФ в связи с осуществлением экстремистской деятельности</p>
                </div>
                <!-- <div class="footer-menu-create">
                    <a href="https://rst-media.ru/" target="_blank">Разработано в <img src="/images/rst_media_footer.png" alt="RST.media"></a>
                </div> -->
            </div>
        </div>
    </div>
</footer>


<div class="cart show hide">
    <div class="cart-block">
        <h2>Корзина</h2>
        <a href="javascript://" class="cart-block-close" onclick="$('.cart').addClass('hide');"
        >
            <img src="/images/icons/icon-close.svg" alt="">
        </a>

            <div class="ms2_total_products mini-basket-popup" id="mini-basket-popup">
                                        <div id="msCart">
                <div class="cart-items">
            @if ($basket_variants->count() === 0)
            <h3 
                style="
                display: flex;
                align-content: center;
                justify-content: center;
                "
            >
                Ваша корзина пуста
            </h3>
            @endif

                    @foreach($basket_variants as $variant)
                        @php
                            $product = $variant->product;
                        @endphp

                        <div class="cart-item" data-product-item-id="{{ $variant->id }}">
                             <div class="cart-item-img">
                                <a href="{{ route('catalog.product', ['product' => $product->slug]) }}" style="
                                        width: 150px;
                                        display: block;
                                        border-radius: 14px;
                                        text-align: center;
                                        overflow: hidden;
                                            height: 95px;
                                    ">
                                    @php
                                        $imageUrl = $variant->images->first()
                                            ? asset('storage/catalog/product/source/' . $variant->images->first()->path)
                                            : ($product->image
                                                ? asset('storage/catalog/product/source/' . $variant->images->first()->path)
                                                : 'https://via.placeholder.com/300x150');
                                    @endphp

                                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}" title="{{ $product->name }}" />
                                </a>
                            </div>

                            <div class="cart-item-title">
                                <a href="{{ route('catalog.product', ['product' => $product->slug]) }}">
                                    {{ $product->name }}, {{$variant->weight}}
                                </a>
                                <div class="order-desc-item-zakaz-item-total">
                                    <div style="display: flex;">
                                        <div class="input-group input-group-sm product-qty-wrapper" data-product-id="{{ $variant->id }}">
                                            <button 
                                            onclick="changeQuantity({{ $variant->id }}, 'minus')" 
                                            class="btn-qty">
                                                -
                                            </button>
                                            <input 
                                                type="number"
                                                min="1"
                                                value="{{ $variant->pivot->quantity }}"
                                                oninput="changeQuantity({{ $variant->id }}, 'set', parseInt(this.value) || 1)"
                                                class="form-control text-center product-qty"
                                            >
                                            <button onclick="changeQuantity({{ $variant->id }}, 'plus')" class="btn-qty plus-btn">+</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="cart-item-price [ js-mspc2-cart-product-prices ]">
                                    @if ($variant->sale)
                                        <p class="sale_price text-nowrap">
                                            {{ number_format($variant->sale * $variant->pivot->quantity, 2, '.', '') }} ₽
                                        </p>
                                    @endif

                                    <div style="display: flex;">
                                        <p class="old_price text-nowrap" id="product-total-old-{{ $variant->id }}">
                                        {{ number_format($variant->oldprice * $variant->pivot->quantity, 2, '.', '') }} ₽
                                        </p>
                                        <p class="mr-2 text-nowrap" id="product-total-{{ $variant->id }}">
                                            {{ number_format($variant->price * $variant->pivot->quantity, 2, '.', '') }} ₽
                                        </p>
                                    </div>
                                </div>
                        </div>

                            <div class="cart-item-remove">
                                <button 
                                    style="background: transparent; border: none;"
                                    class="btn-sm btn-danger delete-item-btn"
                                    data-id="{{ $variant->id }}"
                                    type="button">
                                    <img src="{{ asset('/images/icons/icon-basket-delete.svg') }}" alt="Delete">
                                </button>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="cart-promocode" @if ($basket_variants->count() === 0) style="display: none;" @endif>
                    <div class="mspc2 [ js-mspc2 ]">
                        <div class="mspc2-form [ js-mspc2-form ] ">
                                <div style="position: relative;">
                                    <input class="mspc2-form__input [ js-mspc2-input ]" 
                                    style="width: 100%;
                                        border: 1px dotted #A2A2A2;
                                        background: transparent;
                                        border-radius: 6px;
                                        color: #A2A2A2;
                                        font-family: Buyan;
                                        font-size: 20px;
                                        font-weight: 700;
                                        letter-spacing: 0.05em;" 
                                        type="text" name="mspc2_code" value="" placeholder="Введите промокод">
                                    <button style="border: none; background: none; position: absolute;
                                        top: 50%;
                                        transform: translateY(-50%);
                                        right: 10px;"
                                        class="promo-submit"
                                        >
                                        <img src="/images/icons/icon-arrow-right.svg" alt="">
                                    </button>
                                </div>
                        </div>

                        <div class="mspc2-description [ js-mspc2-coupon-description ]">
                        </div>


                        <div class="mspc2-message">
                            <div class="promo-message-success"></div>
                            <div class="promo-message-error"></div>
                            <div class="promo-message-info"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="discontrol-discounts discontrol-selector cart-bonus" data-propkey="" @if ($basket_variants->count() === 0) style="display: none;" @endif>
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
    <p class="cart-bonus-desc">Осталось купить на 50 000 руб. до скидки 5%</p>

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
            discountDesc.innerHTML = 'Осталось купить на 50 000 руб. до скидки 5%';
        }
    });
</script>

</div>

        <div class="msMiniCart full" @if ($basket_variants->count() === 0) style="display: none;" @endif>
    <div class="empty"></div>
    <div class="not_empty">
        <div class="cart-total-cost">
            <h3 class="cart-total-cost-title">Сумма заказа</h3>
            <ol class="cart-total-cost-pre-price">
                <li>
                  <div>Стоимость продуктов</div>
                  <div></div>
                  <div class="total_old_cost"><span id="total_basket">{{ $basket_total }}</span> ₽</div>
                </li>
                <li>
                  <div>Скидка</div>
                  <div></div>
                  <div><span class="discount-amount-js [ js-mspc2-discount-amount ]" id="discount_percent_basket">{{ $basket_discount }}</span> ₽</div>
                </li>
              </ol>
              <input type="hidden" class="discount-amount-input-js [ js-mspc2-discount-amount ]" value="0">
              <div class="cart-total-cost-total-price">
                  <p class="cart-total-cost-total-price-1">Итого</p>
                  <p class="total_cost cart-total-cost-total-price-2"><span class="ms2_total_cost" id="result_total_basket">{{ $basket_total_with_discount }}</span> ₽</p>
              </div>
        </div>
        <div style="
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            gap: 10px;
        ">
            <a href="{{ route('basket.checkout') }}" class="btn btn-success float-right" style="width: 100%;">
                Оформить заказ
            </a>

        </div>

    </div>
</div>

    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('.form-cart-change');

        // Функция для инициализации обработчиков
        function initializeForms() {
            forms.forEach(function(form) {
                const inputCount = form.querySelector('input[name="count"]');
                const plusButton = form.querySelector('[data-plus]');
                const minusButton = form.querySelector('[data-minus]');
                const submitButton = form.querySelector('button[type="submit"]');

                // Удаляем старые обработчики, если они были
                if (plusButton) {
                    plusButton.removeEventListener('click', addCount);
                    plusButton.addEventListener('click', addCount);
                }

                if (minusButton) {
                    minusButton.removeEventListener('click', subtractCount);
                    minusButton.addEventListener('click', subtractCount);
                }

                function addCount() {
                    inputCount.value = parseInt(inputCount.value) + 1;
                    submitButton.click();
                }

                function subtractCount() {
                    let currentValue = parseInt(inputCount.value);
                    if (currentValue > 1) {
                        inputCount.value = currentValue - 1;
                        submitButton.click();
                    }
                }
            });
        }

        // Инициализируем формы при загрузке страницы
        initializeForms();

        // Подписываемся на событие изменения количества товара
        miniShop2.Callbacks.add('Cart.change.response.success', 'restrict_cart', function() {
            console.log('Кол-во товара изменено');
            // Переинициализируем формы после изменения
            initializeForms();
        });
    });
</script>

<script>
document.querySelector('.cart-items').addEventListener('click', function(e) {
    const button = e.target.closest('.delete-item-btn');
    
    if (!button) return;
        const productId = button.getAttribute('data-id');
        
        fetch(`/basket/remove/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'ok') {
                console.log(data);
                // Находим и удаляем элемент товара
                const item = document.querySelector(`[data-product-item-id="${productId}"]`);
                if (item) item.remove();

                // Обновляем данные корзины
                document.getElementById('total_basket').innerText = data.total;
                document.getElementById('discount_percent_basket').innerText = data.discount;
                document.getElementById('result_total_basket').innerText = data.total_with_discount;

                // Проверяем, есть ли оставшиеся товары
                const remainingItems = document.querySelectorAll('[data-product-item-id]');
                if (remainingItems.length === 0) {
                    const emptyBlock = document.querySelector('.cart-items');
                    document.querySelector('.discontrol-discounts').style.display = 'none';
                    document.querySelector('.msMiniCart.full').style.display = 'none';
                    document.querySelector('.ms2_total_count').style.display = 'none';
                    document.querySelector('.cart-promocode').style.display = 'none';

                    if (emptyBlock) {
                        emptyBlock.innerHTML = `<h3 
                            style="display: flex; align-content: center; justify-content: center;">
                            Ваша корзина пуста
                        </h3>`;
                    }
                }else{
                    document.querySelector('.ms2_total_count').textContent = remainingItems.length;
                }
            }
        });
    
});


</script>

<script>
function changeQuantity(productId, action = 'set', quantity = 1) {
    console.log('📤 Отправляем запрос:', { productId, action, quantity }); // ЛОГ 1

    fetch(`/basket/ajax/change/${productId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify({
            action: action,
            quantity: quantity,
            _token: '{{ csrf_token() }}'
        })
    })
    .then(res => {
        console.log('📥 Ответ от сервера (raw response):', res); // ЛОГ 2
        return res.json();
    })
    .then(data => {
        console.log('✅ Распарсили JSON:', data); // ЛОГ 3

        if (data.success) {
            console.log('🟢 Сервер вернул success. Обновляем корзину…'); // ЛОГ 4

            // обновляем итоговые суммы
            document.getElementById('total_basket').innerText = data.total;
            document.getElementById('discount_percent_basket').innerText = data.discount;
            document.getElementById('result_total_basket').innerText = data.total_with_discount;
            console.log('💰 Обновили суммы: ', {
                total: data.total,
                discount: data.discount,
                total_with_discount: data.total_with_discount
            }); // ЛОГ 5

            // если товар удалён (quantity == 0) — убираем из корзины
            if (data.quantity == 0) {
                console.log(`❌ Товар ${productId} удалён (quantity == 0)`); // ЛОГ 6
                const item = document.querySelector(`[data-product-item-id="${productId}"]`);
                if (item) item.remove();
            } else {
                // иначе обновляем цену и количество
                document.querySelector(`[data-product-id="${productId}"] .product-qty`).value = data.quantity;
                document.getElementById(`product-total-${productId}`).innerText = `${data.total_item_price} ₽`;
                document.getElementById(`product-total-old-${productId}`).innerText = `${data.total_item_old_price} ₽`;

                console.log(`🔄 Товар ${productId} обновлён:`, {
                    quantity: data.quantity,
                    total_item_price: data.total_item_price,
                    total_item_old_price: data.total_item_old_price
                }); // ЛОГ 7
            }

            // проверяем, не осталась ли корзина пустой
            const remainingItems = document.querySelectorAll('[data-product-item-id]');
            console.log('📊 Количество оставшихся товаров в корзине:', remainingItems.length); // ЛОГ 8

            if (remainingItems.length === 0) {
                console.log('🛒 Корзина пуста. Прячем блоки.'); // ЛОГ 9
                document.querySelector('.cart-items').innerHTML = `<h3 
                    style="display: flex; align-content: center; justify-content: center;">
                    Ваша корзина пуста
                </h3>`;
                document.querySelector('.discontrol-discounts').style.display = 'none';
                document.querySelector('.msMiniCart.full').style.display = 'none';
                document.querySelector('.ms2_total_count').style.display = 'none';
                document.querySelector('.cart-promocode').style.display = 'none';
            } else {
                // обновляем счётчик, если он есть
                document.querySelector('.ms2_total_count').textContent = remainingItems.length;
            }
        } else {
            console.warn('⚠️ Сервер вернул success: false', data); // ЛОГ 10
        }
    })
    .catch(err => console.error('❗ Ошибка запроса:', err)); // ЛОГ 11
}


</script>


<!-- БД, сек 0.0457 s<br>
БД запросов 82<br>
PHP - 0.1179 s<br>
Генерация: 0.1636 s<br>
Память: 4 096 kb<br>
Кеш? cache<br> -->

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
<!--<script type="text/javascript" src="/js/jquery.inputmask.js"></script>-->

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollToPlugin.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/TextPlugin.min.js"></script>
<script src="/js/main.js"></script>
<!--<script src="https://unpkg.com/imask"></script>-->
<script type="text/javascript" src="/js/jquery.lazy.min.js"></script>
<script>
    const maskElements = document.querySelectorAll('input[type="tel"]');
    const maskOptions = {
        mask: '+{7}(000)000-00-00'
    };
    maskElements.forEach((elem) => {
        IMask(elem, maskOptions);
    })
</script>
<script>
    $(function() {
        $(window).on("scroll", function() {
            if($(window).scrollTop() > 50) {
                $(".header").addClass("active");
            } else {
                //remove the background property so it comes transparent again (defined in your css)
               $(".header").removeClass("active");
            }
        });
        //$('.tel, #phone').inputmask('+7 (999) 999 99 99',{
        //    clearMaskOnLostFocus: true,
        //    clearIncomplete: true
        //});
    });
</script>
<script>
window.replainSettings = { id: 'd85e2a64-c496-4224-bd7f-c0316aa9813d' };
(function(u){var s=document.createElement('script');s.async=true;s.src=u;
var x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);
})('https://widget.replain.cc/dist/client.js');
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(100413837, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/100413837" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
    <script>
        function scrollContainer(containerId, direction) {
            const container = document.getElementById(containerId);
            if (!container) {
                console.error(`Container with ID ${containerId} not found.`);
                return;
            }
            const cardWidth = 271 + 20;
            const scrollAmount = cardWidth * 1;
            container.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
        }
    </script>
    <div style="display: none;" id="reviews-js" class="review-form">
    <h2 class="review-form-title">Оставить отзыв</h2>
    <p class="review-form-desc">Благодарим Вас за то, что выбрали <strong>Alfabulls</strong>!<br>Мы хотели бы узнать, как Вам понравилось наше обслуживание.<br>Будем благодарны, если вы оставите отзыв на нашем сайте.</p>
    <div class="review-form-how">
        <h3 class="review-form-how-title">Как получить бонусы:</h3>
        <p class="review-form-how-desc">За каждый оставленный отзыв за покупку Вы получите <strong>до 200 бонусов. 1 бонус= 1 рубль</strong>. На одну покупку Вы можете оставить только один отзыв.</p>
    </div>
    <div class="review-form-features">
        <div class="review-form-features-item">
            <h4>За текстовый отзыв</h4>
            <p><strong>50</strong> бонусов</p>
        </div>
        <div class="review-form-features-item">
            <h4>За фото отзыв</h4>
            <p><strong>100</strong> бонусов</p>
        </div>
        <div class="review-form-features-item">
            <h4>За видео отзыв</h4>
            <p><strong>200</strong> бонусов</p>
        </div>
    </div>
    <h2 class="review-success" style="display:none;">Ваш отзыв отправлен на модерацию</h2>

     @guest


                            <p>
            <a href="{{ route('user.login') }}" style="background-image: linear-gradient(263.56deg, #FFE9C8 -4.53%, #FFD9AD 18.44%, #FFDDB5 51.46%, #FFDDB5 76.6%, #FFCC8F 111.92%); color: transparent; background-clip: text; -webkit-background-clip: text;">Авторизуйтесь</a> в личном кабинете, что бы оставить отзыв
        </p>
                             @else



                             <div class="reviews-all-form">




        <div class="review-forms">



            <div class="review-form-video" style="" ;="">
                <!--<h2>Написать сообщение</h2>-->
 <form method="post" action="{{ route('user.otzv.index') }}" enctype="multipart/form-data">
    @csrf


    <div class="ec-form__row ec-input-parent">
        <label for="reviewVideoForm-rating" style="margin-right: 7px;" class="control-label">Оценка:</label>
        <input type="hidden" name="rating" id="reviewVideoForm-rating" value="5">
        <div class="ec-rating ec-clearfix" data-storage-id="reviewVideoForm-rating">
            <div class="ec-rating-stars ec-rating-stars--default">
                <span data-rating="1" data-description="Плохо" class="active"></span>
                <span data-rating="2" data-description="Есть и получше" class="active"></span>
                <span data-rating="3" data-description="Средне" class="active"></span>
                <span data-rating="4" data-description="Хорошо" class="active"></span>
                <span data-rating="5" data-description="Отлично! Рекомендую!" class="active"></span>
            </div>

        </div>
        <span class="ec-error help-block" id="reviewVideoForm-rating-error"></span>
    </div>

    <div class="ec-form__row ec-input-parent ec-form__row_1">
        <label for="reviewVideoForm-text" class="control-label">Ваше сообщение</label>
        <textarea name="text" class="form-control" placeholder="Комментарий" rows="5" id="reviewVideoForm-text"></textarea>
        <span class="ec-error help-block" id="reviewVideoForm-text-error"></span>
    </div>

            <div class="ec-form__row ec-input-parent">
            <label for="reviewVideoForm-files" style="margin-right: 7px;" class="control-label">Вложения</label>
            <input type="file" name="file" id="reviewVideoForm-files" multiple="multiple">
            <!-- <span class="ec-error help-block" id="reviewVideoForm-files-error"></span> -->
        </div>


            <div class="ec-form__row checkbox ec-input-parent">
            <label>
                <input type="checkbox" name="agree" value="1" checked> Я даю свое согласие на обработку персональных данных            </label>
        </div>

    <div class="ec-form__row ec-form__row_btn">
        <button class="btn btn-primary">Оставить отзыв</button>
    </div>
</form>

            </div>
        </div>
    </div>



                               @endif




</div>

@if(session('success'))
<div id="jGrowlSuccess" class="top-right jGrowl" style="z-index: 9999999999; right: -1000px; transition: 0.3s;">
    <div class="jGrowl-notification alert ui-state-highlight ui-corner-all ms2-message-success" style="display: block;">
        <button class="jGrowl-close">×</button>
        <div class="jGrowl-header"></div>
        <div class="jGrowl-message">{{ session('success') }}</div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // показываем блок
        document.getElementById('jGrowlSuccess').style.right = '0px';

        // скрываем через 5 секунд
        setTimeout(function() {
            document.getElementById('jGrowlSuccess').style.right = '-1000px';
        }, 5000);

        // закрытие по кнопке ×
        document.querySelector('#jGrowlSuccess .jGrowl-close').addEventListener('click', function() {
            document.getElementById('jGrowlSuccess').style.right = '-1000px';
        });
    });
</script>
@endif

<div id="jGrowl" class="top-right jGrowl" style="z-index: 9999999999;right: -1000px;transition: 0.3s;"><div class="jGrowl-notification"></div>

<div class="jGrowl-notification alert ui-state-highlight ui-corner-all ms2-message-success" style="
    display: block;
">
    <button class="jGrowl-close">×</button><div class="jGrowl-header"></div>
    <div class="jGrowl-message">Товар добавлен в корзину</div>
</div>
</div>

<script type="text/javascript">


   $('.add-to-basket').on( "click", function() {
            $('#jGrowl').css('right', '-0px');



            setTimeout(function()
            {
               $('#jGrowl').css('right', '-1000px');
            }, 5000);
        });


</script>

<script>
    document.querySelector('.promo-submit').addEventListener('click', function (e) {
        e.preventDefault();

        var promoCode = document.querySelector('.mspc2-form__input').value;
        fetch("{{ route('basket.apply.promo') }}", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                mspc2_code: promoCode
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                document.querySelector('.promo-message-success').textContent = data.message;
                document.querySelector('.promo-message-error').textContent = '';
                
                if (window.location.pathname === '/basket/checkout' && !document.getElementById('promo')) {
                    location.reload(); 
                }
            } else {
                document.querySelector('.promo-message-error').textContent = data.message;
                document.querySelector('.promo-message-success').textContent = '';
            }
        });
    });
</script>


<script>
    $(function() {
        $('.review-orders-title a').on( "click", function() {
            $('.review-order').toggle();
            return false;
        });

        $('.review-order-link').on( "click", function() {
            $('.review-orders').toggle();
            $('.review-order-select').toggle();
            $('.review-type').toggle();
            $('.review-order-select').text( $(this).text() );
            $('.review-subject').val( $('.review-subject').val() + ' ' + $(this).text() );
            $('.review-order').val( $(this).attr('data-order') );
            return false;
        });

        $('.review-types-title a').on( "click", function() {
            $('.review-type').toggle();
            return false;
        });

        $('.review-type-link').on( "click", function() {
            $('.review-types').toggle();
            $('.review-type-select').toggle();
            $('.review-type-select').text( $(this).text() );
            $('.review-subject').val( $('.review-subject').val() + ' ' + $(this).text() );
            return false;
        });

        $('.review-button-text').on( "click", function() {
            $('.review-form-text').toggle();
        });

        $('.review-button-photo').on( "click", function() {
            $('.review-form-photo').toggle();
        });

        $('.review-button-video').on( "click", function() {
            $('.review-form-video').toggle();
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const ratingContainers = document.querySelectorAll('.ec-rating');
    
    ratingContainers.forEach(container => {
        const stars = container.querySelectorAll('.ec-rating-stars span');
        const hiddenInput = document.getElementById(container.dataset.storageId);
        const descriptionBox = container.querySelector('.ec-rating-description');
        
        // Инициализация текущего рейтинга
        let currentRating = parseInt(hiddenInput.value);
        updateStars(stars, currentRating);
        
        // Обработка клика по звезде
        stars.forEach(star => {
            star.addEventListener('click', function() {
                currentRating = parseInt(this.dataset.rating);
                hiddenInput.value = currentRating;
                updateStars(stars, currentRating);
                
                // Показываем описание
                if (descriptionBox) {
                    descriptionBox.textContent = this.dataset.description;
                }
            });
            
            // Эффект при наведении
            star.addEventListener('mouseover', function() {
                const hoverRating = parseInt(this.dataset.rating);
                stars.forEach((s, index) => {
                    s.classList.toggle('active', index < hoverRating);
                });
            });
        });
        
        // Сброс эффекта наведения
        container.addEventListener('mouseleave', function() {
            updateStars(stars, currentRating);
        });
    });
    
    function updateStars(stars, rating) {
        stars.forEach((star, index) => {
            star.classList.toggle('active', index < rating);
        });
    }
});
</script>

<script src="https://alfabulls.com/assets/components/minishop2/js/web/default.js?v=667ec14321"></script>
<script src="https://alfabulls.com/assets/components/minishop2/js/web/lib/jquery.jgrowl.min.js"></script>
<script src="https://alfabulls.com/assets/components/minishop2/js/web/message_settings.js"></script>
<script src="https://alfabulls.com/assets/components/ajaxform/js/default.js"></script>
<script type="text/javascript">AjaxForm.initialize({"assetsUrl":"\/assets\/components\/ajaxform\/","actionUrl":"\/assets\/components\/ajaxform\/action.php","closeMessage":"\u0437\u0430\u043a\u0440\u044b\u0442\u044c \u0432\u0441\u0435","formSelector":"form.ajax_form","pageId":1});</script>

<script>
                    if (typeof(msPromoCode2MainCls) === "undefined") {
                        var msPromoCode2MainCls = new msPromoCode2Main({"assetsUrl":"\/assets\/components\/mspromocode2\/","actionUrl":"\/assets\/components\/mspromocode2\/action.php","ctx":"web"});
                    }
                </script>
<script>msMCDMiniCartConfig ={"actionUrl":"\/assets\/components\/msmcd\/action.php","animate":false,"dropdown":false,"ctx":"web"}</script>
<script src="https://alfabulls.com/assets/components/msmcd/js/web/msmcdminicart.js"></script>
<script src="https://alfabulls.com/assets/components/easycomm/js/web/ec.default.js"></script>
<script src="https://alfabulls.com/assets/components/discontrol/js/web/default.js"></script>
<script type="text/javascript">Discontrol.initialize({"assetsBaseUrl":"\/assets\/","assetsUrl":"\/assets\/components\/discontrol\/","actionUrl":"\/assets\/components\/discontrol\/action.php","selector":".discontrol-selector","propkey":"704b95c76e372b87cbac50028e64db50f1a2f7b4","action":"","ctx":"web","miniShop2":{"version":"3.0.7-pl"}});</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

</body>

</html>