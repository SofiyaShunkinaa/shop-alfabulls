@extends('layout.site', ['title' => $category->name])

@section('content')
    <section class="breadcrumbs">
    <div class="wrapper">
        <div class="breadcrumbs__inner">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="../reviews.html">Главная</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4" /></svg></span><li class="breadcrumb-item active">Каталог</li></ol>
        </div>
    </div>
</section>
            <section class="catalog">
                <div class="catalog-bg-1"></div>
                <div class="catalog-bg-2"></div>
                <div class="catalog-bg-2 catalog-bg-2-2"></div>
                <div class="catalog-bg-2 catalog-bg-2-3"></div>
                <div class="catalog-bg-3"></div>
                <div class="catalog-bg-3 catalog-bg-3-2"></div>
                <div class="catalog-bg-3 catalog-bg-3-3"></div>
                <div class="wrapper">
                    <h1 class="anim-title">Каталог</h1>
                    <div class="catalog-nav">
                        <ul class="">



                        @foreach ($roots as $root)
                            @include('catalog.part.category', ['category' => $root])
                        @endforeach
                    </div>
                    <h2 class="anim-title">{{ $category->name }}</h2>

<div class="catalog-nav">
                    <ul class="">
                        @foreach ($children as $child)
                            @include('catalog.part.category', ['category' => $child])
                        @endforeach

                    @if ($category->name == 'Сухие корма')
                    </div>
                    
                        <div class="catalog-privilege">



                            <div class="catalog-privilege-item catalog-privilege-item-1">
                                <ul class="catalog-privilege-ul parent-animation">
                                    <li class="catalog-privilege-li" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                        <div class="catalog-privilege-li-img">
                                            <img src="/images/catalog/icon-privilege-1.png" alt="Сбалансированный состав">
                                        </div>
                                        <div class="catalog-privilege-li-desc">
                                            <h3>Сбалансированный состав:</h3>
                                            <p>50% мяса для высококачественного протеина.</p>
                                        </div>
                                    </li>
                                    <li class="catalog-privilege-li" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                        <div class="catalog-privilege-li-img">
                                            <img src="/images/catalog/icon-privilege-2.png" alt="Разнообразия мяса">
                                        </div>
                                        <div class="catalog-privilege-li-desc">
                                            <h3>Разнообразия мяса:</h3>
                                            <p>Говядина и рыба для полноценного питания.</p>
                                        </div>
                                    </li>
                                    <li class="catalog-privilege-li" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                        <div class="catalog-privilege-li-img">
                                            <img src="/images/catalog/icon-privilege-3.png" alt="Полезные углеводы">
                                        </div>
                                        <div class="catalog-privilege-li-desc">
                                            <h3>Полезные углеводы:</h3>
                                            <p>Овсяные хлопья и рис обеспечивают стабильную энергию.</p>
                                        </div>
                                    </li>
                                    <li class="catalog-privilege-li" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                        <div class="catalog-privilege-li-img">
                                            <img src="/images/catalog/icon-privilege-4.png" alt="Поддержка суставов">
                                        </div>
                                        <div class="catalog-privilege-li-desc">
                                            <h3>Поддержка суставов:</h3>
                                            <p>Хрящи с глюкозамином и хондроитином.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="catalog-privilege-item catalog-privilege-item-2 parent-animation">
                                <img src="/images/privilege.webp" class="catalog-privilege-img" alt="Корм" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            </div>
                            <div class="catalog-privilege-item catalog-privilege-item-3">
                                <ul class="catalog-privilege-ul parent-animation">
                                    <li class="catalog-privilege-li" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                        <div class="catalog-privilege-li-desc">
                                            <h3>Здоровье кожи и шерсти:</h3>
                                            <p>Омега-кислоты из лососевого масла.</p>
                                        </div>
                                        <div class="catalog-privilege-li-img">
                                            <img src="/images/catalog/icon-privilege-5.png" alt="Здоровье кожи и шерсти">
                                        </div>
                                    </li>
                                    <li class="catalog-privilege-li" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                        <div class="catalog-privilege-li-desc">
                                            <h3>Иммунная поддержка:</h3>
                                            <p>Витамины и минералы для крепкого иммунитета.</p>
                                        </div>
                                        <div class="catalog-privilege-li-img">
                                            <img src="/images/catalog/icon-privilege-6.png" alt="Иммунная поддержка">
                                        </div>
                                    </li>
                                    <li class="catalog-privilege-li" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                        <div class="catalog-privilege-li-desc">
                                            <h3>Поддержка пищеварения:</h3>
                                            <p>Экстракты цикория и свекольный жом для здоровья кишечника.</p>
                                        </div>
                                        <div class="catalog-privilege-li-img">
                                            <img src="/images/catalog/icon-privilege-7.png" alt="Поддержка пищеварения">
                                        </div>
                                    </li>
                                    <li class="catalog-privilege-li" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                        <div class="catalog-privilege-li-desc">
                                            <h3>Полезные экстракты:</h3>
                                            <p>Экстракт виноградных косточек, бархатцев, корней топинамбура и тд.</p>
                                        </div>
                                        <div class="catalog-privilege-li-img">
                                            <img src="/images/catalog/icon-privilege-8.png" alt="Богат микроэлементами">
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                     @endif

                      @if ($category->name == 'Лежанки и матрасы')
                     <div class="catalog-beds">

                        <div class="pcilia">
                            <img src="/img/lezak.png">
                        </div>


                        <div class="mbilia">
                        <div class="catalog-beds-item catalog-beds-item-1">
                            <ul class="catalog-beds-ul parent-animation">
                                <li class="catalog-beds-li catalog-beds-li-1" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Непромокаемые чехлы на основании и бортиках</h3>
                                </li>
                                <li class="catalog-beds-li catalog-beds-li-2" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Съемный чехол на итальянской фурнитуре</h3>
                                </li>
                                <li class="catalog-beds-li catalog-beds-li-3" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Липучки для стойкого облегания у основания</h3>
                                </li>
                                <li class="catalog-beds-li catalog-beds-li-4" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Армированные нитки (устойчивость к вытягиванию и трению)</h3>
                                </li>
                            </ul>
                        </div>
                        <div class="catalog-beds-item catalog-beds-item-2 parent-animation">
                            <img src="/images/beds-pic.webp" class="catalog-beds-img" alt="Лежанка" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                        </div>
                        <div class="catalog-beds-item catalog-beds-item-3">
                            <ul class="catalog-beds-ul parent-animation">
                                <li class="catalog-beds-li catalog-beds-li-5" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Очень прочная износостойкая антивандальная ткань</h3>
                                </li>
                                <li class="catalog-beds-li catalog-beds-li-6" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Ортопедический синтепух</h3>
                                </li>
                                <li class="catalog-beds-li catalog-beds-li-7" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Каждый бортик и основание вынимается и легко стирается</h3>
                                </li>
                                <li class="catalog-beds-li catalog-beds-li-8" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Нескользящее днище из материала "Антикоготь"</h3>
                                </li>
                            </ul>
                        </div>
                        </div>

                    </div>
                    @endif


                     @if ($category->name == 'Поводки и ошейники')
                     <div class="catalog-leashes-collars">


                         <div class="pcilia">
                            <img src="/img/oshen.png">
                        </div>


                        <div class="mbilia">
                        <div class="catalog-leashes-collars-item catalog-leashes-collars-item-1">
                            <ul class="catalog-leashes-collars-ul parent-animation">
                                <li class="catalog-leashes-collars-li catalog-leashes-collars-li-1" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Натуральная кожа (Чепрак) + кожа КРС</h3>
                                </li>
                                <li class="catalog-leashes-collars-li catalog-leashes-collars-li-2" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Исключительно ручная работа</h3>
                                </li>
                                <li class="catalog-leashes-collars-li catalog-leashes-collars-li-3" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Сварная фурнитура из нержавеющей стали</h3>
                                </li>
                                <li class="catalog-leashes-collars-li catalog-leashes-collars-li-4" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Усиление итальянской стропой для долговечности</h3>
                                </li>
                            </ul>
                        </div>
                        <div class="catalog-leashes-collars-item catalog-leashes-collars-item-2 parent-animation">
                            <img src="/images/leashes-collars-pic.webp" class="catalog-leashes-collars-img" alt="Лежанка" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                        </div>
                        <div class="catalog-leashes-collars-item catalog-leashes-collars-item-3">
                            <ul class="catalog-leashes-collars-ul parent-animation">
                                <li class="catalog-leashes-collars-li catalog-leashes-collars-li-5" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Армированные нитки (устойчивость к вытягиванию и трению)</h3>
                                </li>
                                <li class="catalog-leashes-collars-li catalog-leashes-collars-li-6" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Верхний слой кожи состоит из кожи Бизона для износостойкости</h3>
                                </li>
                                <li class="catalog-leashes-collars-li catalog-leashes-collars-li-7" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Кожа КРС (Мягкая кожа) для комфорта в области шеи вашему питомцу</h3>
                                </li>
                                <li class="catalog-leashes-collars-li catalog-leashes-collars-li-8" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                                    <h3>Обработка Итальянским средством для гуммирования и воском</h3>
                                </li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    @endif



                    <div class="catalog-items parent-animation">
                           @foreach ($products as $product)
                               @include('catalog.part.product', ['product' => $product])
                            @endforeach

                    </div>

                </div>
            </section>

            <div class="to-top" data-action="gotop">
                <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 8H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M6 13H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M8 18H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M17 20V4L20 8" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </div>




 <script>


         function changeCount(){
                $('.type_flex div').each(function() {
                var rating = $(this).data('class');

                if(!$(this).hasClass('activ_type')){

                    $(this).parent().parent().parent().parent().find('.' + rating).css('display', 'none');
                }else{
                     $(this).parent().parent().parent().parent().find('.' + rating).css('display', 'inline');
                };
             });
            }


          changeCount();


             $('.type_flex div').click(function(){
                 event.preventDefault();
                 $(this).parent().parent().parent().parent().find('.type_flex div').removeClass("activ_type");
                 $(this).addClass("activ_type");
                 
                const variantId = $(this).data('variantid');
                const $wrapper = $(this).closest('.catalog-item-desc');

                $wrapper.find('input[name="variant_id"]').val(variantId);

                  changeCount();
             })
    </script>

    <style>
        .mbilia{ display:none }

                @media screen and (max-width: 1024px) {
                     .mbilia{ display:block; }

                     .pcilia{ display: none }
                }

                                .type_flex{
                                    display: flex;
                                    align-items: center;
                                        gap: 13px;
                                    margin-bottom: 22px;
                                    margin-top: -20px;
                                }

                                .type_flex div{
                                       min-width: 44px;
    text-align: center;
    border: 1px solid #807A74;
    color: #807A74;
    font-size: 16px;
    font-weight: 700;
    text-transform: uppercase;
    padding: 9px 0px 8px;
    font-family: 'Buyan';
    border-radius: 10px;
    cursor: pointer;

                                }

                                 .type_flex div.activ_type{
                                    border: 1px solid #fff;
                                        color: #fff;
                                 }


                                 .nonvisibl{
                                    display: none;
                                 }

                                  .dont_visibl{
                                    opacity: 0;
                                 }
                            </style>

@endsection