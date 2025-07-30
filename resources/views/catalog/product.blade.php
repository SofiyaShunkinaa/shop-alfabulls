@extends('layout.site')

@section('content')

<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>



 <section class="breadcrumbs">
    <div class="wrapper">
        <div class="breadcrumbs__inner">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="/">Главная</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4" /></svg></span><li class="breadcrumb-item"><a href="/catalog/index">Каталог</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4" /></svg></span><li class="breadcrumb-item"><a href="/catalog/category/{{ $category[0]->slug }}">{{ $category[0]->name }}</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4" /></svg></span><li class="breadcrumb-item active">{{ $product->name }}</li></ol>
        </div>
    </div>
</section>
            <div class="wrapper">
                <div id="content" class="product">
                    <section class="item-card">
    <div id="msProduct" itemtype="http://schema.org/Product" itemscope>
        <meta itemprop="name" content="Консерва для кошек (индейка и треска), 100г">
        <meta itemprop="description" content="Состав: индейка (фарш - 27%), треска (фарш - 27%), желудки индейки - 13%, соус, тыква, шеи индейки (фарш - 6%), печень индейки, отруби, масло лососевое, кальций (1,5%).">
        <div class="wrapper">
            <div class="item-card__inner">


@foreach ($product->variants as $i => $variant)
    <div class="item-card-img farsofca_{{ $i+1 }}" style="overflow: hidden;">
        <div class="msGallery owl-carousel owl-theme">

            @foreach ($variant->images as $image)
                @php($url = asset('storage/catalog/product/source/' . $image->path))
                <div class="item">
                    <a href="{{ $url }}" data-fancybox="variant-{{ $variant->id }}">
                        <img src="{{ $url }}" alt="Изображение товара" title="{{ $variant->weight }}" style="width: 100%;">
                    </a>
                </div>
            @endforeach

        </div>
    </div>
@endforeach

<script>
$(document).ready(function(){
    $(".msGallery").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        dots: false,
        nav: true,              // включаем штатные стрелки
        navText: [
            // левая стрелка
            '<img src="{{ asset('storage/левая.png') }}" alt="prev">',
            // правая стрелка
            '<img src="{{ asset('storage/правая.png') }}" alt="next">'
        ]

    });

    
});
</script>


<style>
    .owl-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 100%;
        margin-top: -48px !important;
    z-index: 1000;
    position: relative;
    width: 100px;
    margin-left: auto;
    margin-right: auto;
}

.item a{
        display: flex;
    justify-content: center;
}

.owl-carousel .owl-nav.disabled{
    display: flex;
}

.active{
    z-index: 1;
}


</style>


                <div class="item-card-desc" itemtype="http://schema.org/AggregateOffer" itemprop="offers" itemscope>
                    <meta itemprop="category" content="Влажные корма">
                    <meta itemprop="offerCount" content="1">
                    <meta itemprop="price" content="126">
                    <meta itemprop="lowPrice" content="126">
                    <meta itemprop="priceCurrency" content="RUR">
                    <h1 class="item-card-desc-title">{{ $product->name }}</h1>


                        <div class="item-card-desc-size" style="
    margin-bottom: 30px;
">
<style>
                                .type_flex{
                                    display: flex;
                                    align-items: center;
                                    gap: 20px;
                                        margin-bottom: 25px;
                                }

                                .type_flex div{
                                        min-width: 50px;
                                        text-align: center;
                                        border: 1px solid #807A74;
                                        color: #807A74;
                                        font-size: 20px;
                                        font-weight: 700;
                                        text-transform: uppercase;
                                        padding: 15px 0px;
                                        font-family: 'Buyan';
                                        border-radius: 14px;
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
                                    display: none;
                                 }
                            </style>


                            <div class='type_flex'>
                                @if ($product->variants)
                                    
                                    @foreach ($product->variants as $i => $variant)

                                        <div class="{{ $i == 0 ? 'activ_type' : '' }} @if (count($product->variants) == 1) {{'dont_visibl'}} @endif" data-class="farsofca_{{ $i+1 }}">
                                            <p>{{ $variant->weight }}</p>
                                        </div>
                                        
                                    @endforeach
                                @endif
                                <!--<div class="activ_type" data-class='farsofca_1'><p>1.5 КГ</p></div>
                                 <div class="" data-class='farsofca_2'><p>3 КГ</p></div>
                                <div class="" data-class='farsofca_3'><p>ss</p></div> -->
                            </div>
                            @if ($product->variants)                            
                                @foreach ($product->variants as $i => $variant)
                                    <div class="form-group farsofca_{{ $i+1 }}">
                                        <div class="item-card-desc-price">
                                            <p>
                                                <span class="msoptionsprice-cost">{{ number_format($variant->price, 2, '.', '') }}</span> ₽
                                            </p>
                                            @if ($variant->oldprice > 0)
                                                <p class="old_price ml-2">
                                                    <span class="msoptionsprice-old-cost">{{ number_format($variant->oldprice, 2, '.', '') }}</span> ₽
                                                </p>
                                            @endif
                                        </div>
                                    </div>                                
                                @endforeach
                            @endif
                        </div>


                        <!-- <div class="form-group farsofca_1">
                            
                            <div class="item-card-desc-price">
                                <p>
                                    <span class="msoptionsprice-cost msoptionsprice-32">{{ number_format($product->price, 2, '.', '') }}</span> ₽1 </p>


                                         @if ($product->oldprice != 0)

                <p class="old_price ml-2">
                                        <span class="msoptionsprice-old-cost msoptionsprice-32">{{ number_format($product->oldprice, 2, '.', '') }}</span> ₽1</p>
                @endif
                            </div>
                        </div>


                         <div class="form-group farsofca_2">
                            <label>Цена:</label>
                            <div class="item-card-desc-price">
                                <p>
                                    <span class="msoptionsprice-cost msoptionsprice-32">{{ number_format($product->price, 2, '.', '') }}</span> ₽2 </p>


                                         @if ($product->oldprice != 0)

                <p class="old_price ml-2">
                                        <span class="msoptionsprice-old-cost msoptionsprice-32">{{ number_format($product->oldprice, 2, '.', '') }}</span> ₽2</p>
                @endif
                            </div>
                        </div>



                         <div class="form-group farsofca_3">
                            
                            <div class="item-card-desc-price">
                                <p>
                                    <span class="msoptionsprice-cost msoptionsprice-32">{{ number_format($product->price, 2, '.', '') }}</span> ₽3 </p>


                                         @if ($product->oldprice != 0)

                <p class="old_price ml-2">
                                        <span class="msoptionsprice-old-cost msoptionsprice-32">{{ number_format($product->oldprice, 2, '.', '') }}</span> ₽3</p>
                @endif
                            </div>
                        </div> -->



                        <form action="{{ route('basket.add', ['id' => $product->id]) }}"
                              method="post" class="form-inline add-to-basket">
                            @csrf
                            <input type="hidden" name="variant_id" id="variant_id_input" value="{{ $product->variants->first()->id ?? '' }}">
                        <div class="form-group" style="opacity: 0; position: absolute; top: -100%;">
                            <label for="product_price">Количество:</label>
                            <div class="input-group">
                                <input type="number" name="quantity" id="input-quantity" class="form-control col-md-6" value="1"/>
                                <div class="input-group-append">
                                    <span class="input-group-text">шт.</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn item-card-desc-button" name="ms2_action" value="cart/add">
                                Добавить в корзину
                            </button>
                        </div>
                    </form>
                    <div class="item-card-desc-txt maxi">
                        <div class="item-card-desc-txt-buttons">
                            <input type="button" value="Описание" class="item-card-desc-txt-buttons-item active" id="itemCardDesc1" />
                            <input type="button" value="Состав" class="item-card-desc-txt-buttons-item" id="itemCardDesc2" />
                            <input type="button" value="Размеры" class="item-card-desc-txt-buttons-item" id="itemCardDesc3" />
                        </div>
                        <div class="item-card-desc-txt-block" id="itemCardDescTxtBlock1">
                            <p>{{ $product->content }}</p>
                        </div>
                         <div class="item-card-desc-txt-block" id="itemCardDescTxtBlock2">
                            <p>{{ $product->composition }}</p>
                        </div>
                         <div class="item-card-desc-txt-block" id="itemCardDescTxtBlock3">
                            @if ($product->variants)                            
                                @foreach ($product->variants as $i => $variant)
                                    <p>{{ $variant->width }}Х{{ $variant->height }}Х{{ $variant->length }}</p>                             
                                @endforeach
                            @endif
                         
                        </div>
                    </div>

                    <div class="item-card-desc-txt mini">
                        <details>
                            <summary>Описание <div><div class="cross-item"></div><div class="cross-item"></div></div></summary>
                            <p>{{ $product->content }}</p>
                        </details>

                        <details>
                            <summary>Состав<div><div class="cross-item"></div><div class="cross-item"></div></div></summary>
                            <p>{{ $product->composition }}</p>
                        </details>

                        @if ($product->variants)
                            <details>
                                <summary>Размеры<div><div class="cross-item"></div><div class="cross-item"></div></div></summary>
                                @foreach ($product->variants as $i => $variant)
                                    <p>{{ $variant->width }}Х{{ $variant->height }}Х{{ $variant->length }}</p>
                                @endforeach
                            </details>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.querySelectorAll('.type_flex div').forEach((el, index) => {
        el.addEventListener('click', () => {
            // Снимаем класс 'activ_type' у всех
            document.querySelectorAll('.type_flex div').forEach(d => d.classList.remove('activ_type'));
            // Добавляем класс активному
            el.classList.add('activ_type');

            // Обновляем hidden input с id варианта
            const variantId = @json($product->variants->pluck('id'));
            document.getElementById('variant_id_input').value = variantId[index];
        });
    });
</script>

    <script>


         function changeCount(){
                 $('.type_flex div').each(function() {
                var rating = $(this).data('class');

                if(!$(this).hasClass('activ_type')){

                    $('.' + rating).css('display', 'none');
                }else{
                     $('.' + rating).css('display', 'block');
                };
             });
            }




        $(document).ready(function(){

            $('.item-card-desc-txt-buttons-item').click(function(){
                $('.item-card-desc-txt-buttons-item').removeClass('active');
                $(this).addClass('active');
            });
            $("#itemCardDesc1").click(function(){
                $("#itemCardDescTxtBlock1").fadeIn("fast");
                $("#itemCardDescTxtBlock2").fadeOut("fast");
                $("#itemCardDescTxtBlock3").fadeOut("fast");
                $("#itemCardDesc1").css("color", "#fff !important", "border-bottom", "1px solid #fff !important");
                $("#itemCardDesc2").css("color", "#807A74 !important", "border-bottom", "1px solid #807A74 !important");
                $("#itemCardDesc3").css("color", "#807A74 !important", "border-bottom", "1px solid #807A74 !important");

            });

            $("#itemCardDesc2").click(function(){
                $("#itemCardDescTxtBlock1").fadeOut("fast");
                $("#itemCardDescTxtBlock2").fadeIn("fast");
                $("#itemCardDescTxtBlock3").fadeOut("fast");
                $("#itemCardDesc2").css("color", "#fff !important", "border-bottom", "1px solid #fff !important");
                $("#itemCardDesc1").css("color", "#807A74 !important", "border-bottom", "1px solid #807A74 !important");
                $("#itemCardDesc3").css("color", "#807A74 !important", "border-bottom", "1px solid #807A74 !important");
            });

            $("#itemCardDesc3").click(function(){
                $("#itemCardDescTxtBlock1").fadeOut("fast");
                $("#itemCardDescTxtBlock2").fadeOut("fast");
                $("#itemCardDescTxtBlock3").fadeIn("fast");
                $("#itemCardDesc3").css("color", "#fff !important", "border-bottom", "1px solid #fff !important");
                $("#itemCardDesc1").css("color", "#807A74 !important", "border-bottom", "1px solid #807A74 !important");
                $("#itemCardDesc2").css("color", "#807A74 !important", "border-bottom", "1px solid #807A74 !important");
            });




        });

          changeCount();


             $('.type_flex div').click(function(){
                 $('.type_flex div').removeClass("activ_type");
                 $(this).addClass("activ_type");

                  changeCount();
             })
    </script>


              </div>
            </div>
@endsection

