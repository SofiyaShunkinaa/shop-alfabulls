@extends('layout.site')


@section('content')
   <section class="breadcrumbs">
    <div class="wrapper">
        <div class="breadcrumbs__inner">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="../reviews.html">Главная</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4" /></svg></span><li class="breadcrumb-item active">Контакты и магазины</li></ol>
        </div>
    </div>
</section>
            <section class="contacts-page">
                <div class="contacts-page-bg-1"></div>
                <div class="contacts-page-bg-2"></div>
                <div class="wrapper">
                    <h1 class="anim-title">Контакты и магазины</h1>
                    <div class="contacts-page__inner">
                        <div class="contacts-page-info parent-animation">
                            <div class="contacts-page-info-title">
                                <h2>Контакты</h2>
                            </div>
                            <div class="contacts-page-info-card">
                                <div class="contacts-page-info-card-rec">
                                    <div class="contacts-page-info-card-rec-item">
                                        <h3>Реквизиты</h3>
                                        <p>ИП Сестров Дмитрий Викторович<br>
ИНН 760213318412 / ОГРНИП 322762700052672</p>
                                    </div>
                                    <div class="contacts-page-info-card-rec-item">
                                        <h3>Самовывоз в Ярославле</h3>
                                        <p>Вы можете заказать товары самовывозом <br>из любого близлежащего к вам магазина</p>
                                    </div>
                                </div>
                                <div class="contacts-page-info-card-desc">
                                    <div class="feedback-block">
                                        <div class="feedback-block-phone">
                                            <a href="tel:+7 980-742-78-94" class="feedback-block-phone-phone">+7 980-742-78-94</a>
                                            <div class="feedback-block-phone-socials">
                                                <a href="https://api.whatsapp.com/send/?phone=79807427894" target="_blank">
                                                    <img src="/images/icons/whatsapp-icon.png" alt="WhatsApp">
                                                </a>
                                                <a href="viber://chat?number=%2B79807427894" target="_blank">
                                                    <img src="/images/icons/viber-icon.png" alt="Viber">
                                                </a>
                                                <a href="https://paywall.pw/gvozynmlxb6w" target="_blank">
                                                    <img src="/images/icons/telegram-icon.png" style="max-width: 44px; position: relative; left: -5px;" alt="Telegram">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="feedback-block-society">
                                            <div class="feedback-block-society-title">Мы в соцсетях</div>
                                            <div class="feedback-block-society-socials">
                                                <a href="https://vk.com/alfabullskennel" target="_blank">
                                                    <img src="/images/icons/vk-icon.png" alt="Vk">
                                                </a>
                                                <a href="https://dzen.ru/alfabulls" target="_blank">
                                                    <img src="/images/icons/dzen-icon.png" alt="Dzen">
                                                </a>
                                                <a href="https://instagram.com/kseniiasestrova" target="_blank">
                                                    <img src="/images/icons/instagram-icon.png" alt="Inst">
                                                </a>
                                                <a href="https://www.tiktok.com/@alfabullskennel" target="_blank">
                                                    <img src="/images/icons/tiktok-icon.png" alt="TikTok">
                                                </a>

                                                <a href="https://www.youtube.com/@AlfaBulls" target="_blank">
                                                    <img src="/images/icons/youtube-icon.png" alt="YouTube">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="contacts-shops">
                <div class="contacts-shops-bg-1"></div>
                <div class="contacts-shops-bg-2"></div>
                <div class="wrapper">
                    <div class="contacts-shops__inner">
                        <h2 class="anim-title">наши Магазины</h2>
                         <div class='type_flex'>
                                <div class="activ_type" data-class='farsofca_1'><p>Ярославль</p></div>
                                <div class="" data-class='farsofca_2'><p>Москва</p></div>
                            </div>

                    <div class="farsofca_2">
                         <div class="contacts-shops-cards parent-animation">
                            <div class="contacts-shops-cards-item">
                                <div class="contacts-shops-cards-item-info">
                                    <div class="contacts-shops-cards-item-info__inner">
                                        <div class="contacts-shops-cards-item-info-subtitle">Адрес: Сельскохозяйственная 39</div>
                                    </div>
                                    <div class="contacts-shops-cards-item-info__inner">
                                        <div class="contacts-shops-cards-item-info-desc">Режим работы:<br>ежедневно с 10:00 - 19:00</div>
                                    </div>
                                </div>
                                <div class="contacts-scroll">
                                    <div class="contacts-scroll-container" id="contactContainer1">
                                        <div class="contacts-scroll-container-card"><a href="/images/contacts/contacts-shop-1-3.jpeg" data-fancybox><img src="/images/contacts/contacts-shop-1-3.jpeg"></a></div>
                                        <div class="contacts-scroll-container-card"><a href="/images/contacts/contacts-shop-1-1.jpeg" data-fancybox><img src="/images/contacts/contacts-shop-1-1.jpeg"></a></div>
                                        <div class="contacts-scroll-container-card"><a href="/images/contacts/contacts-shop-1-2.jpeg" data-fancybox><img src="/images/contacts/contacts-shop-1-2.jpeg"></a></div>
                                    </div>
                                    <div class="scroll-buttons">
                                        <button class="scroll-left" onclick="scrollContainer('contactContainer1', -1)">
                                            <img src="/images/icons/scroll-icon-left.svg">
                                        </button>
                                        <button class="scroll-right" onclick="scrollContainer('contactContainer1', 1)">
                                            <img src="/images/icons/scroll-icon-right.svg">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="contacts-shops-map anim-img-reverse" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            <div class="contacts__map" id="contacts__map2" style="height: 100%;">
                            </div>
                        </div>



                    </div>

                    <div class="farsofca_1">
                        <div class="contacts-shops-cards parent-animation">
                            <div class="contacts-shops-cards-item">
                                <div class="contacts-shops-cards-item-info">
                                    <div class="contacts-shops-cards-item-info__inner">
                                        <div class="contacts-shops-cards-item-info-subtitle">Адрес: ул. Нефтяников, 3к2</div>
                                    </div>
                                    <div class="contacts-shops-cards-item-info__inner">
                                        <div class="contacts-shops-cards-item-info-desc">Режим работы:<br>ежедневно с 10:00 - 19:00</div>
                                    </div>
                                </div>
                                <div class="contacts-scroll">
                                    <div class="contacts-scroll-container" id="contactContainer1">
                                        <div class="contacts-scroll-container-card"><a href="/images/contacts/contacts-shop-1-3.jpeg" data-fancybox><img src="/images/contacts/contacts-shop-1-3.jpeg"></a></div>
                                        <div class="contacts-scroll-container-card"><a href="/images/contacts/contacts-shop-1-1.jpeg" data-fancybox><img src="/images/contacts/contacts-shop-1-1.jpeg"></a></div>
                                        <div class="contacts-scroll-container-card"><a href="/images/contacts/contacts-shop-1-2.jpeg" data-fancybox><img src="/images/contacts/contacts-shop-1-2.jpeg"></a></div>
                                    </div>
                                    <div class="scroll-buttons">
                                        <button class="scroll-left" onclick="scrollContainer('contactContainer1', -1)">
                                            <img src="/images/icons/scroll-icon-left.svg">
                                        </button>
                                        <button class="scroll-right" onclick="scrollContainer('contactContainer1', 1)">
                                            <img src="/images/icons/scroll-icon-right.svg">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="contacts-shops-cards-item">
                                <div class="contacts-shops-cards-item-info">
                                    <div class="contacts-shops-cards-item-info__inner">
                                        <div class="contacts-shops-cards-item-info-subtitle">Адрес: ул. Саукова, 12</div>
                                    </div>
                                    <div class="contacts-shops-cards-item-info__inner">
                                        <div class="contacts-shops-cards-item-info-desc">Режим работы:<br>ежедневно с 10:00 - 19:00</div>
                                    </div>
                                </div>
                                <div class="contacts-scroll">
                                    <div class="contacts-scroll-container" id="contactContainer2">
                                        <div class="contacts-scroll-container-card"><a href="/images/contacts/contacts-shop-2.jpeg" data-fancybox><img src="/images/contacts/contacts-shop-2.jpeg"></a></div>
                                        <div class="contacts-scroll-container-card"><a href="/images/contacts/contacts-shop-1.jpeg" data-fancybox><img src="/images/contacts/contacts-shop-1.jpeg"></a></div>
                                        <div class="contacts-scroll-container-card"><a href="/images/contacts/contacts-shop-3.jpeg" data-fancybox><img src="/images/contacts/contacts-shop-3.jpeg"></a></div>
                                    </div>
                                    <div class="scroll-buttons">
                                        <button class="scroll-left" onclick="scrollContainer('contactContainer2', -1)">
                                            <img src="/images/icons/scroll-icon-left.svg">
                                        </button>
                                        <button class="scroll-right" onclick="scrollContainer('contactContainer2', 1)">
                                            <img src="/images/icons/scroll-icon-right.svg">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="contacts-shops-cards-item">
                                <div class="contacts-shops-cards-item-info">
                                    <div class="contacts-shops-cards-item-info__inner">
                                        <div class="contacts-shops-cards-item-info-subtitle">Адрес: ул. Батова, 6</div>
                                    </div>
                                    <div class="contacts-shops-cards-item-info__inner">
                                        <div class="contacts-shops-cards-item-info-desc">Режим работы:<br>ежедневно с 10:00 - 19:00</div>
                                    </div>
                                </div>
                                <div class="contacts-scroll">
                                    <div class="contacts-scroll-container" id="contactContainer3">
                                        <div class="contacts-scroll-container-card"><a href="/images/contacts/contacts-shop-2-1.jpeg" data-fancybox><img src="/images/contacts/contacts-shop-2-1.jpeg"></a></div>
                                        <div class="contacts-scroll-container-card"><a href="/images/contacts/contacts-shop-2-2.jpeg" data-fancybox><img src="/images/contacts/contacts-shop-2-2.jpeg"></a></div>
                                        <div class="contacts-scroll-container-card"><a href="/images/contacts/contacts-shop-2-3.jpeg" data-fancybox><img src="/images/contacts/contacts-shop-2-3.jpeg"></a></div>
                                    </div>
                                    <div class="scroll-buttons">
                                        <button class="scroll-left" onclick="scrollContainer('contactContainer3', -1)">
                                            <img src="/images/icons/scroll-icon-left.svg">
                                        </button>
                                        <button class="scroll-right" onclick="scrollContainer('contactContainer3', 1)">
                                            <img src="/images/icons/scroll-icon-right.svg">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="contacts-shops-cards-item">
                                <div class="contacts-shops-cards-item-info">
                                    <div class="contacts-shops-cards-item-info__inner">
                                        <div class="contacts-shops-cards-item-info-subtitle">Адрес: проспект Ленина 61</div>
                                    </div>
                                    <div class="contacts-shops-cards-item-info__inner">
                                        <div class="contacts-shops-cards-item-info-desc">Режим работы:<br>ежедневно с 10:00 - 19:00</div>
                                    </div>
                                </div>
                                <div class="contacts-scroll">
                                    <div class="contacts-scroll-container" id="contactContainer4">
                                        <div class="contacts-scroll-container-card"><a href="/images/contacts/contacts-shop-4-1.jpeg" data-fancybox><img src="/images/contacts/contacts-shop-4-1.jpeg"></a></div>
                                        <div class="contacts-scroll-container-card"><a href="/images/contacts/contacts-shop-4-2.jpeg" data-fancybox><img src="/images/contacts/contacts-shop-4-2.jpeg"></a></div>
                                        <div class="contacts-scroll-container-card"><a href="/images/contacts/contacts-shop-4-3.jpeg" data-fancybox><img src="/images/contacts/contacts-shop-4-3.jpeg"></a></div>
                                    </div>
                                    <div class="scroll-buttons">
                                        <button class="scroll-left" onclick="scrollContainer('contactContainer4', -1)">
                                            <img src="/images/icons/scroll-icon-left.svg">
                                        </button>
                                        <button class="scroll-right" onclick="scrollContainer('contactContainer4', 1)">
                                            <img src="/images/icons/scroll-icon-right.svg">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="contacts-shops-map anim-img-reverse" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
                            <div class="contacts__map" id="contacts__map" style="height: 100%;">
                            </div>
                        </div>

                    </div>

                        <script src="https://api-maps.yandex.ru/2.1/?apikey=c7c37881-1e0e-46b1-b1e1-8123041bcb22&amp;lang=ru_RU" type="text/javascript"></script>
                        <script>
$(document).ready(function() {
    if ($(".contacts__map").length) {
        ymaps.ready(mapInit);
        function mapInit() {
            var myMap = new ymaps.Map("contacts__map", {
                center: [57.647017, 39.88462],
                zoom: 11,
                controls: ["zoomControl"],
            });
            var shop1 = new ymaps.Placemark(
                [57.577684, 39.840301],
                {
                    hintContent: "",
                    balloonContent: "",
                },
                {
                    iconLayout: "default#image",
                    iconImageHref: "/images/map-icon.svg",
                    iconImageSize: [78, 88],
                    iconImageOffset: [-39, -88],
                }
            );

            var shop2 = new ymaps.Placemark(
                [57.644834, 39.950291],
                {
                    hintContent: "",
                    balloonContent: "",
                },
                {
                    iconLayout: "default#image",
                    iconImageHref: "/images/map-icon.svg",
                    iconImageSize: [78, 88],
                    iconImageOffset: [-39, -88],
                }
            );

            var shop3 = new ymaps.Placemark(
                [57.691396, 39.780931],
                {
                    hintContent: "",
                    balloonContent: "",
                },
                {
                    iconLayout: "default#image",
                    iconImageHref: "/images/map-icon.svg",
                    iconImageSize: [78, 88],
                    iconImageOffset: [-39, -88],
                }
            );

            var shop4 = new ymaps.Placemark(
                [57.629407, 39.850191],
                {
                    hintContent: "",
                    balloonContent: "",
                },
                {
                    iconLayout: "default#image",
                    iconImageHref: "/images/map-icon.svg",
                    iconImageSize: [78, 88],
                    iconImageOffset: [-39, -88],
                }
            );

            myMap.geoObjects.add(shop1);
            myMap.geoObjects.add(shop2);
            myMap.geoObjects.add(shop3);
            myMap.geoObjects.add(shop4);
        }
    }
})
</script>



                        <script>
$(document).ready(function() {
    if ($(".contacts__map").length) {
        ymaps.ready(mapInit);
        function mapInit() {
            var myMap = new ymaps.Map("contacts__map2", {
                center: [55.851939, 37.621676],
                zoom: 11,
                controls: ["zoomControl"],
            });
            var shop1 = new ymaps.Placemark(
                [55.851939, 37.621676],
                {
                    hintContent: "",
                    balloonContent: "",
                },
                {
                    iconLayout: "default#image",
                    iconImageHref: "/images/map-icon.svg",
                    iconImageSize: [78, 88],
                    iconImageOffset: [-39, -88],
                }
            );



            myMap.geoObjects.add(shop1);
        }
    }
})
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






          changeCount();


             $('.type_flex div').click(function(){
                 $('.type_flex div').removeClass("activ_type");
                 $(this).addClass("activ_type");

                  changeCount();
             })
    </script>


                            <style>
                                .type_flex{
                                    display: flex;
                                    align-items: center;
                                    gap: 22px;
                                        margin-bottom: 47px;
                                    flex-wrap: wrap;
                                }

                                .type_flex div{
                                        min-width: 219px;
                                        text-align: center;
                                        border: 1px solid #fff;
                                        color: #fff;
                                        font-size: 30px;
                                        font-weight: 700;
                                        text-transform: uppercase;
                                        padding: 18px 0px;
                                        font-family: 'Buyan';
                                        border-radius: 14px;
                                        cursor: pointer;

                                }

                                 .type_flex div.activ_type{
                                    background: #fff;
                                        color: #000;
                                 }


                                 .nonvisibl{
                                    display: none;
                                 }
                            </style>


                    </div>
                </div>
            </section>
            <div class="to-top" data-action="gotop">
                <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 8H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M6 13H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M8 18H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M17 20V4L20 8" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </div>


@endsection
