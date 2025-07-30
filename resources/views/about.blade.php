@extends('layout.site')


@section('content')
 <section class="breadcrumbs">
    <div class="wrapper">
        <div class="breadcrumbs__inner">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="../reviews.html">Главная</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http:/www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4" /></svg></span><li class="breadcrumb-item active">О магазине</li></ol>
        </div>
    </div>
</section>
            <section class="aboutpage page">
                <div class="aboutpage-bg-1"></div>
                <div class="aboutpage-bg-2"></div>
                <div class="aboutpage-bg-3"></div>
                <div class="aboutpage-bg-4"></div>
                <div class="aboutpage-bg-5"></div>
                <div class="wrapper">
                    <h1 class="anim-title">О магазине AlfaBulls</h1>
                    <div class="aboutpage__inner">
                        <div class="aboutpage-info parent-animation">
                            <h2>Alfabulls</h2>
                            <p>Alfabulls — это магазин Premium качества товаров для животных, где приоритет - забота о ваших любимцах и высокое качество продукции. Мы гордимся производством, основанным на многолетнем опыте питомника Alfabulls, и следуем принципу: «Если хочешь сделать что-то хорошо — сделай это сам!» Мы уверены, что каждый питомец заслуживает лучшего, и стремимся сделать заботу о них простой и приятной.<br><br></p>
                            <div class="aboutpage-info-quotes">
                                <div class="aboutpage-info-quotes-item" style="margin-left: 0px;">
                                    <div class="aboutpage-info-quotes-item-title">Доставка</div>
                                    <div class="aboutpage-info-quotes-item-text">Доставим товар в<br>любую точку России</div>
                                    <img src="/images/icons/icon-delivery.svg">
                                </div>
                                <div class="aboutpage-info-quotes-item">
                                    <div class="aboutpage-info-quotes-item-title">8+ лет</div>
                                    <div class="aboutpage-info-quotes-item-text">Более 8 лет мы<br>существуем на рынке</div>
                                    <img src="/images/icons/icon-age.svg">
                                </div>
                                <div class="aboutpage-info-quotes-item">
                                    <div class="aboutpage-info-quotes-item-title">Premium</div>
                                    <div class="aboutpage-info-quotes-item-text">Производим товары<br>только premium качества</div>
                                    <img src="/images/icons/icon-premium.svg">
                                </div>
                                <a href="/catalog/index" class="aboutpage-info-quotes-item aboutpage-info-quotes-item-catalog btn">Каталог</a>
                            </div>
                        </div>
                        <div class="aboutpage-image img-container ">
                            <img src="/images/about/about-main.png" alt="">
                        </div>
                    </div>
                    <div class="aboutpage-scroll">
                        <div class="aboutpage-scroll-container" id="videosContainer">
                            <div class="aboutpage-scroll-container-card"><img src="/images/about/about-pic-1.jpeg"></div>
                            <div class="aboutpage-scroll-container-card"><img src="/images/about/about-pic-2.jpeg"></div>
                            <div class="aboutpage-scroll-container-card"><img src="/images/about/about-pic-3.jpeg"></div>
                            <div class="aboutpage-scroll-container-card"><img src="/images/about/about-pic-4.png"></div>
                            <div class="aboutpage-scroll-container-card"><img src="/images/about/about-pic-5.jpeg"></div>
                            <div class="aboutpage-scroll-container-card"><img src="/images/about/about-pic-6.png"></div>
                        </div>
                        <div class="scroll-buttons">
                            <button class="scroll-left" onclick="scrollContainer('videosContainer', -1)">
                                <img src="/images/icons/scroll-icon-left.svg">
                            </button>
                            <button class="scroll-right" onclick="scrollContainer('videosContainer', 1)">
                                <img src="/images/icons/scroll-icon-right.svg">
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <section class="block-variable block-variable-shop">
                <div class="block-variable-info-bg-1"></div>
                <div class="block-variable-info-bg-1 block-variable-info-bg-1-2"></div>
                <div class="block-variable-info-bg-1 block-variable-info-bg-1-3"></div>
                <div class="block-variable-info-bg-2"></div>
                <div class="block-variable-info-bg-2 block-variable-info-bg-2-2"></div>
                <div class="block-variable-info-bg-2 block-variable-info-bg-2-3"></div>
                <div class="block-variable-info-bg-3"></div>
                <div class="block-variable-info-bg-3 block-variable-info-bg-3-2"></div>
                <div class="block-variable-info-bg-3 block-variable-info-bg-3-3"></div>
                <div class="wrapper">
                    <h2>Наши ценности</h2>
                    <div class="block-variable-info block-variable-info-1 parent-animation">
                        <div class="block-variable-info-img" style="--block-variable-info-img-content: '1'; --block-variable-info-img-content-top: -33%; --block-variable-info-img-content-left: -18%;">
                            <img src="/images/about/about-pic-1.jpeg">
                        </div>
                        <div class="block-variable-info-desc">
                            <h3>Хочешь сделать что-то хорошо, сделай это сам!</h3>
                            <p>Поскольку наш питомник является одним из самых известных в разведении собак породы американский булли, мы столкнулись с особенностями, связанными с выращиванием этой породы. Одной из сложностей стал подбор подходящего корма, который удовлетворял бы все потребности этих собак. Именно поэтому мы решили углубиться в производство кормов и создать собственный высококачественный продукт, который подойдет собаке любой породы!</p>
                        </div>
                    </div>
                     <p class='mb'>Поскольку наш питомник является одним из самых известных в разведении собак породы американский булли, мы столкнулись с особенностями, связанными с выращиванием этой породы. Одной из сложностей стал подбор подходящего корма, который удовлетворял бы все потребности этих собак. Именно поэтому мы решили углубиться в производство кормов и создать собственный высококачественный продукт, который подойдет собаке любой породы!</p>
                    <div class="block-variable-info block-variable-info-2 block-variable-info-re parent-animation">
                        <div class="block-variable-info-desc block-variable-info-re-desc">
                            <h3>Реальный контроль качества</h3>
                            <p>Мы гордимся тем, что наш корм зарегистрирован в системе "Честный Знак" и соответствует всем необходимым стандартам, включая сертификаты ГОСТ и ветеринарную систему "Меркурий". Но главное наше преимущество — это тестирование каждой партии корма теми, для кого он создан.<br><br>В нашем питомнике живут более 30 собак редкой и чувствительной к питанию породы. Именно они первыми пробуют каждую партию корма, и только после их одобрения продукт поступает в продажу.<br><br>Мы доверяем тем, для кого создаем наш продукт, и гарантируем: ваш питомец получит только лучшее!</p>
                        </div>
                        <div class="block-variable-info-img block-variable-info-re-img" style="--block-variable-info-img-content: '2'; --block-variable-info-img-content-top: -20%; --block-variable-info-img-content-right: -20%;">
                            <img src="/images/about/about-pic-2.jpeg">
                        </div>
                    </div>
                     <p class='mb'>Мы гордимся тем, что наш корм зарегистрирован в системе "Честный Знак" и соответствует всем необходимым стандартам, включая сертификаты ГОСТ и ветеринарную систему "Меркурий". Но главное наше преимущество — это тестирование каждой партии корма теми, для кого он создан.<br><br>В нашем питомнике живут более 30 собак редкой и чувствительной к питанию породы. Именно они первыми пробуют каждую партию корма, и только после их одобрения продукт поступает в продажу.<br><br>Мы доверяем тем, для кого создаем наш продукт, и гарантируем: ваш питомец получит только лучшее!</p>
                    <div class="block-variable-info block-variable-info-3 parent-animation">
                        <div class="block-variable-info-img" style="--block-variable-info-img-content: '3'; --block-variable-info-img-content-top: -28%; --block-variable-info-img-content-left: -29%;">
                            <img src="/images/about/about-pic-3.jpeg">
                        </div>
                        <div class="block-variable-info-desc">
                            <h3>Забота о каждом клиенте</h3>
                            <p>Мы знаем, что многие продавцы говорят о бережном отношении к клиентам. Но для нас это не просто пункт в списке — это наша философия. Мы искренне заботимся о каждом, кто к нам обращается, и готовы предложить индивидуальный подход.<br><br>Наша служба поддержки всегда поможет подобрать линейку корма, которая идеально подойдет именно вашему питомцу. Мы понимаем, что каждый любимец уникален, и стремимся сделать его жизнь лучше</p>
                        </div>
                    </div>
                    <p class='mb'>Мы гордимся тем, что наш корм зарегистрирован в системе "Честный Знак" и соответствует всем необходимым стандартам, включая сертификаты ГОСТ и ветеринарную систему "Меркурий". Но главное наше преимущество — это тестирование каждой партии корма теми, для кого он создан.<br><br>В нашем питомнике живут более 30 собак редкой и чувствительной к питанию породы. Именно они первыми пробуют каждую партию корма, и только после их одобрения продукт поступает в продажу.<br><br>Мы доверяем тем, для кого создаем наш продукт, и гарантируем: ваш питомец получит только лучшее!</p>


                    <div class="block-variable-info block-variable-info-4 block-variable-info-re parent-animation">
                        <div class="block-variable-info-desc block-variable-info-re-desc">
                            <h3>Не подошла кормовая линейка?<br>Не беда!</h3>
                            <p>Мы ценим ваше доверие и заботимся о каждом, кто выбирает наш корм. Если по каким-либо причинам выбранная линейка корма AlfaBulls не подошла вашему питомцу, наши специалисты бесплатно подберут другую, более подходящую, и заменят её без дополнительных затрат с вашей стороны!</p>
                        </div>
                        <div class="block-variable-info-img block-variable-info-re-img" style="--block-variable-info-img-content: '4'; --block-variable-info-img-content-top: -26%; --block-variable-info-img-content-right: -32%;">
                            <img src="/images/about/about-pic-4.png">
                        </div>
                    </div>
                    <p class='mb'>Мы ценим ваше доверие и заботимся о каждом, кто выбирает наш корм. Если по каким-либо причинам выбранная линейка корма AlfaBulls не подошла вашему питомцу, наши специалисты бесплатно подберут другую, более подходящую, и заменят её без дополнительных затрат с вашей стороны!</p>



                    <div class="block-variable-info block-variable-info-5 parent-animation">
                        <div class="block-variable-info-img" style="--block-variable-info-img-content: '5'; --block-variable-info-img-content-top: -21%; --block-variable-info-img-content-left: -22%;">
                            <img src="/images/about/about-pic-5.jpeg">
                        </div>
                        <div class="block-variable-info-desc">
                            <h3>Мы не сотрудничаем с посредниками, торговыми сетями и маркетплейсами</h3>
                            <p>Мы стремимся сохранять уникальность нашей продукции, поэтому приобрести ее можно только на нашем сайте или в официальных торговых точках<br><br>Наши корма хранятся исключительно на современных складах, оснащенных всем необходимым для правильного хранения сухого корма. Это гарантирует, что ваш заказ всегда будет максимально свежим и качественным.</p>
                        </div>
                    </div>
                    <p class='mb'>Мы стремимся сохранять уникальность нашей продукции, поэтому приобрести ее можно только на нашем сайте или в официальных торговых точках<br><br>Наши корма хранятся исключительно на современных складах, оснащенных всем необходимым для правильного хранения сухого корма. Это гарантирует, что ваш заказ всегда будет максимально свежим и качественным.</p>



                    <div class="block-variable-info block-variable-info-6 block-variable-info-re parent-animation">
                        <div class="block-variable-info-desc block-variable-info-re-desc">
                            <h3>Все всегда самое свежее, идеальные сроки годности</h3>
                            <p>Мы производим корм с учетом спроса для того, чтобы каждая партия была максимально свежей. Наши объемы производства рассчитаны так, чтобы корм быстро находил своего покупателя, и только после этого мы готовим новые партии<br><br>Мы не храним корм годами — обычно он находится на складе не больше месяца, а новые партии выпускаем не реже одного раза в 30 дней. Это гарантирует, что ваш питомец получит только свежий и качественный продукт.</p>
                        </div>
                        <div class="block-variable-info-img block-variable-info-re-img" style="--block-variable-info-img-content: '6'; --block-variable-info-img-content-top: -27%; --block-variable-info-img-content-right: -29%;">
                            <img src="/images/about/about-pic-6.png">
                        </div>
                    </div>
                    <p class='mb'>Мы производим корм с учетом спроса для того, чтобы каждая партия была максимально свежей. Наши объемы производства рассчитаны так, чтобы корм быстро находил своего покупателя, и только после этого мы готовим новые партии<br><br>Мы не храним корм годами — обычно он находится на складе не больше месяца, а новые партии выпускаем не реже одного раза в 30 дней. Это гарантирует, что ваш питомец получит только свежий и качественный продукт.</p>



                    <div class='cabargini' style="">
                        <a href="/catalog/index" class="btn btn-aboutme-1" style="margin-right: 20px; margin-left: auto;">Каталог</a>
                        <a href="/dogs" class="btn btn-aboutme-2" style="margin-right: auto;">Щенки</a>
                    </div>
                </div>
            </section>
            <div class="to-top" data-action="gotop">
                <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http:/www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 8H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M6 13H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M8 18H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M17 20V4L20 8" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </div>


            <style type="text/css">

                .cabargini{
                    display: flex; margin: auto; margin-top: 120px;
                }


                .mb{
                    display: none;
                }

                @media screen and (max-width: 515px) {

                    .cabargini{
                    display: flex; margin: auto; margin-top: 50px;
                }


                    .mb{
                    display: block;
                    font-size: 12px;
                    margin-top: -28px;
                        margin-bottom: 20px;
                    }



                        .block-variable-info .block-variable-info-desc p {
                            display: none;
                        }

                            .block-variable-info-desc {
                                padding-bottom: 0px;
                            }

                                .block-variable-shop .block-variable-info-6 {
        margin-bottom: 25px;
    }
                }
            </style>


@endsection
