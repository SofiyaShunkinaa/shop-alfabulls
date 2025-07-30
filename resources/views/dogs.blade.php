	@extends('layout.site')


@section('content')
  <section class="breadcrumbs">
    <div class="wrapper">
        <div class="breadcrumbs__inner">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="../reviews.html">Главная</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4" /></svg></span><li class="breadcrumb-item active">Щенки</li></ol>
        </div>
    </div>
</section>
            <section class="dogs">
                <div class="dogs-bg-1"></div>
                <div class="dogs-bg-2"></div>
                <div class="dogs-bg-3"></div>
                <div class="dogs-bg-4"></div>
                <div class="dogs-bg-5"></div>
                <div class="wrapper">
                    <h1 class="anim-title">Щенки</h1>
                    <div class="dogs-info">
                        <div class="dogs-info-1">
                            <ul class="dogs-info-ul parent-animation">
                                <li class="dogs-info-li">
                                    <div class="dogs-info-li-img">
                                        <img src="/images/icons/dogs-icon-1.svg">
                                    </div>
                                    <p>Приобретая у нас щенка, вы получаете именно тот тип, на который рассчитываете и никак иначе.</p>
                                </li>
                                <li class="dogs-info-li">
                                    <div class="dogs-info-li-img">
                                        <img src="/images/icons/dogs-icon-2.svg">
                                    </div>
                                    <p>Наши щенки и их родители проверены на все, к чему предрасположена порода и все дефекты исключены.</p>
                                </li>
                                <li class="dogs-info-li">
                                    <div class="dogs-info-li-img">
                                        <img src="/images/icons/dogs-icon-3.svg">
                                    </div>
                                    <p>Наши щенки живут по всему миру. Мы осуществляем доставку, как по России, так и в любую точку мира.</p>
                                </li>
                            </ul>
                        </div>
                        <div class="dogs-info-2 parent-animation">
                            <img src="https://alfabulls.com/assets/components/phpthumbof/cache/dogs-main-pic.54a7252e17ffb7d64cc000f65e92a7ae.webp">
                        </div>
                        <div class="dogs-info-3">
                            <ul class="dogs-info-ul parent-animation">
                                <li class="dogs-info-li">
                                    <p>Мы всегда поможем вам с воспитанием наших выпускников, но также у вас есть возможность приобрести уже воспитанного щенка.</p>
                                    <div class="dogs-info-li-img">
                                        <img src="/images/icons/dogs-icon-4.svg">
                                    </div>
                                </li>
                                <li class="dogs-info-li">
                                    <p>Наши щенки и их родители живут в идеальных условиях и мы никогда не экономим на их содержание.</p>
                                    <div class="dogs-info-li-img">
                                        <img src="/images/icons/dogs-icon-5.svg">
                                    </div>
                                </li>
                                <li class="dogs-info-li">
                                    <p>Вы всегда можете приехать и посмотреть родителей с щенком лично, чтобы убедиться в их эксклюзивности.</p>
                                    <div class="dogs-info-li-img">
                                        <img src="/images/icons/dogs-icon-6.svg">
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="dogs-edu-container">
                        <div class="dogs-edu">
                            <div class="dogs-edu-desc">
                                <p>Обучение<br>щенка с нуля,<br>где 400+ уроков</p>
                            </div>
                            <div class="dogs-edu-tg">
                                <p>В нашем<img src="/images/icons/telegram-icon.png"><br>Telegramm канале</p>
                                <a href="https://paywall.pw/gvozynmlxb6w" class="btn" target="_blank">Подписаться</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="dogs-catalog">
                <div class="wrapper">
                    <h2 class="anim-title">Наши щенки</h2>
                    <div class="dogs-catalog-items parent-animation">


                    	 @foreach ($products as $product)


                        <div class="dogs-catalog-item">
                            <div class="dogs-catalog-item-img">
                                <div class="dogs-scroll">
                                    <div class="dogs-scroll-container owl-carousel owl-theme" id="carousel-{{ $product->id }}">
                                        @foreach ($product->images as $img)
                                            <div class="item dogs-scroll-container-card">
                                                <a data-fancybox="gallery-{{ $product->id }}" href="{{ asset('storage/' . $img->path) }}">
                                                    <img src="{{ asset('storage/' . $img->path) }}" alt="">
                                                </a>
                                            </div>
                                        @endforeach

                                        @if ($product->videos)
                                            @foreach ($product->videos as $video)
                                                <div class="item dogs-scroll-container-card">
                                                    <a data-fancybox="gallery-{{ $product->id }}" data-type="video" href="{{ asset('storage/' . $video->path) }}">
                                                       <video width="100%" height="auto"
                                                            preload="metadata"
                                                            class="video-thumb"
                                                            data-video="{{ asset('storage/' . $video->path) }}"
                                                            style="cursor:pointer; border-radius: 8px;" muted>
                                                            <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                                            Ваш браузер не поддерживает видео.
                                                        </video> 
                                                    
                                                    <!-- <img src="/img/play-preview.jpg" alt="Видео превью"> -->
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif   
                                    
                                    
                                    
                                    <!-- <div class="scroll-buttons">
                                        <button class="scroll-left" onclick="scrollCarousel({{ $product->id }}, 'prev')">
                                            <img src="/images/icons/scroll-icon-left.svg">
                                        </button>
                                        <button class="scroll-right" onclick="scrollCarousel({{ $product->id }}, 'next')">
                                            <img src="/images/icons/scroll-icon-right.svg">
                                        </button>
                                    </div> -->
                                </div>
                            </div>
                            </div>
                            
                            <div class="dogs-catalog-item-desc">
                                <div class="dogs-catalog-item-desc-title">
                                    <p class="dogs-catalog-item-desc-title-name">{{$product->name}}</p>
                                    <p class="dogs-catalog-item-desc-title-type">Порода: {{$product->type}}</p>
                                </div>
                                <p class="dogs-catalog-item-desc-date">Дата рождения: {{$product->date}}</p>
                                <p class="dogs-catalog-item-desc-text">{{$product->opis}}</p>
                            </div>
                            <div class="dogs-catalog-item-footer">
                                <p class="dogs-catalog-item-footer-price">{{$product->pric}} ₽</p>
                                <a href="https://api.whatsapp.com/send/?phone=79807427894&text={{ urlencode('Здравствуйте! Хочу забронировать щенка: ' . $product->name) }}" class="btn" target="_blank">Забронировать</a>
                            </div>
                        </div>
                          @endforeach
                    </div>
                </div>
            </section>
            <div class="to-top" data-action="gotop">
                <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 8H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M6 13H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M8 18H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M17 20V4L20 8" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </div>
<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>

<script>    
    $(document).ready(function() {
        $('.owl-carousel').each(function() {
            $(this).owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                nav: true,              // включаем штатные стрелки
                navText: [
                    // левая стрелка
                    '<div class="scroll-left"><img src="/images/icons/scroll-icon-left.svg" alt="prev"></div>',
                    // правая стрелка
                    '<div class="scroll-right"><img src="/images/icons/scroll-icon-right.svg" alt="next"></div>'
                ],
                dots: false
            });
        });
    });
</script>
<style>
.owl-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 100%;
    top: calc(-278px / 2 - 40px);
    z-index: 1000;
    position: relative;
    width: 100%;
    margin-left: auto;
    margin-right: auto;
}
</style>
@endsection
