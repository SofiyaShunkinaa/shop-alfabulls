@extends('layout.site')


@section('content')
   <section class="breadcrumbs">
    <div class="wrapper">
        <div class="breadcrumbs__inner">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="../reviews.html">Главная</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4" /></svg></span><li class="breadcrumb-item active">О питомнике</li></ol>
        </div>
    </div>
</section>

<style>
    .aboutpage-info p {
    margin-bottom: 20px;
}
</style>

            <section class="aboutpage page aboutpage-nursery">
                <div class="aboutpage-bg-1"></div>
                <div class="aboutpage-bg-2"></div>
                <div class="aboutpage-bg-3"></div>
                <div class="aboutpage-bg-4"></div>
                <div class="aboutpage-bg-5"></div>
                <div class="wrapper">
                    <h1 class="anim-title">О питомнике Alfabulls</h1>
                    <div class="aboutpage__inner">
                        <div class="aboutpage-info-block">
                            <div class="aboutpage-info parent-animation">
                                <h2>О нас</h2>
                                <p>Питомник AlfaBulls — это место, где исключительный внешний вид и выдающиеся породные качества американских булей становятся реальностью. Мы строго подбираем пары, чтобы обеспечить здоровье генетического древа. Все щенки проходят кардиолога, ортопеда и терапевта, вакцинацию и обработку, что гарантирует их здоровье.<br>Мы не только продаем собак, но и обучаем владельцев, как правильно воспитывать их и создавать комфортные условия для жизни. Также предлагаем доставку в любую точку мира.</p>
                            </div>
                            <div class="aboutpage-image img-container parent-animation">
                                <img src="/images/nursery-main123.png" alt="">
                            </div>
                        </div>
                        <div class="aboutpage-info-quotes parent-animation">
                            <div class="aboutpage-info-quotes-item" style="margin-left: 0px;">
                                <div class="aboutpage-info-quotes-item-title">Доставка</div>
                                <div class="aboutpage-info-quotes-item-text">Доставим щенка в<br>любую точку мира</div>
                                <img src="/images/icons/icon-delivery.svg">
                            </div>
                            <div class="aboutpage-info-quotes-item">
                                <div class="aboutpage-info-quotes-item-title">8+ лет</div>
                                <div class="aboutpage-info-quotes-item-text">Более 8 лет мы<br>существуем на рынке</div>
                                <img src="/images/icons/icon-age.svg">
                            </div>
                            <div class="aboutpage-info-quotes-item">
                                <div class="aboutpage-info-quotes-item-title">150 + щенков</div>
                                <div class="aboutpage-info-quotes-item-text">150+ щенков мы<br>воспитали и передали в семьи</div>
                                <img src="/images/icons/icon-dogs.svg">
                            </div>
                            <a href="/catalog/index" class="aboutpage-info-quotes-item aboutpage-info-quotes-item-catalog btn">Каталог</a>
                        </div>
                    </div>
                    <div class="aboutpage-scroll">
                        <div class="aboutpage-scroll-container" id="videosContainer">
                            <div class="aboutpage-scroll-container-card"><img src="/images/nursery/nursery-pic-7.jpg"></div>
                            <div class="aboutpage-scroll-container-card"><img src="/images/nursery/nursery-pic-8.jpg"></div>
                            <div class="aboutpage-scroll-container-card"><img src="/images/nursery/nursery-pic-9.jpeg"></div>
                            <div class="aboutpage-scroll-container-card"><img src="/images/nursery-pic-11.png"></div>
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
            <section class="block-variable block-variable-nursery">
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
                        <div class="block-variable-info-img" style="--block-variable-info-img-content: '1'; --block-variable-info-img-content-top: -23%; --block-variable-info-img-content-left: -26%;">
                            <img src="/images/nursery/nursery-pic-1.jpeg" style="max-height: 390px;">
                        </div>
                        <div class="block-variable-info-desc">
                            <h3>Эксклюзивный внешний вид</h3>
                            <p>Все наши производители имеют эксклюзивный внешний вид, выдающиеся породные качества — это огромная мышечная масса и гигантская голова. Мы тщательно подходим к подбору пары и делаем так, чтобы все самые выдающиеся черты родителей передались их потомству.<br><br>Проходя с нашим щенком по улице, люди будут оборачиваться, как будто вы едете на дорогом автомобиле. Наших щенков ни с кем не спутаешь!</p>
                        </div>
                    </div>
                     <p class='mb'>Все наши производители имеют эксклюзивный внешний вид, выдающиеся породные качества — это огромная мышечная масса и гигантская голова. Мы тщательно подходим к подбору пары и делаем так, чтобы все самые выдающиеся черты родителей передались их потомству.<br><br>Проходя с нашим щенком по улице, люди будут оборачиваться, как будто вы едете на дорогом автомобиле. Наших щенков ни с кем не спутаешь!</p>




                    <div class="block-variable-info block-variable-info-2 block-variable-info-re parent-animation">
                        <div class="block-variable-info-desc block-variable-info-re-desc">
                            <h3>Ответственный дорогостоящий подход<br>к разведению</h3>
                            <p>Приобретая щенка у нас, вы можете быть уверены в том, что из него вырастет здоровая собака именно того типа, который вы хотите. То есть, приобретая тип "покет", вырастет именно он и никто другой!</p>
                        </div>
                        <div class="block-variable-info-img block-variable-info-re-img" style="--block-variable-info-img-content: '2'; --block-variable-info-img-content-top: -20%; --block-variable-info-img-content-right: -20%;">
                            <img src="/images/nursery/nursery-pic-2.jpeg">
                        </div>
                    </div>
                     <p class='mb'>Приобретая щенка у нас, вы можете быть уверены в том, что из него вырастет здоровая собака именно того типа, который вы хотите. То есть, приобретая тип "покет", вырастет именно он и никто другой!</p>




                    <div class="block-variable-info block-variable-info-3 parent-animation">
                        <div class="block-variable-info-img" style="--block-variable-info-img-content: '3'; --block-variable-info-img-content-top: -28%; --block-variable-info-img-content-left: -29%;">
                            <img src="/images/nursery/nursery-pic-3.jpeg">
                        </div>
                        <div class="block-variable-info-desc">
                            <h3>Мы никогда не экономим</h3>
                            <p>Наша отличительная черта в том, что у нас есть возможность выбирать для своих собак лучшее. Все наши щенки выращены на кормах собственного производства в комбинации с лучшими натуральными прикормами (телятина, лосятина, лосось, ягненок). Все наши щенки и собаки обследуются только лучшими ветеринарными врачами и специалистами в своей области.</p>
                        </div>
                    </div>
                     <p class='mb'>Наша отличительная черта в том, что у нас есть возможность выбирать для своих собак лучшее. Все наши щенки выращены на кормах собственного производства в комбинации с лучшими натуральными прикормами (телятина, лосятина, лосось, ягненок). Все наши щенки и собаки обследуются только лучшими ветеринарными врачами и специалистами в своей области.</p>




                    <div class="block-variable-info block-variable-info-4 block-variable-info-re parent-animation">
                        <div class="block-variable-info-desc block-variable-info-re-desc">
                            <h3>Здоровье имеет огромное значение</h3>
                            <p>Все наши производители прошли тестирование на генетические заболевания, к которым предрасположена порода американский булли. Кроме того, каждому из них сделан рентген под наркозом с правильной раскладкой, что гарантирует отсутствие суставных патологий. Когда щенки переезжают к вам, они уже полностью привиты, с купированными ушами (если это необходимо), обработаны от паразитов и готовы к прогулкам на улице. В комплекте с щенком вы получаете: Эхокардиограмму с заключением кардиолога; УЗИ брюшной полости всех органов с заключением; Осмотр и заключение ортопеда. Мы заботимся о здоровье и благополучии наших щенков, чтобы вы могли быть уверены в их отличном состоянии!</p>
                        </div>
                        <div class="block-variable-info-img block-variable-info-re-img" style="--block-variable-info-img-content: '4'; --block-variable-info-img-content-top: -26%; --block-variable-info-img-content-right: -32%;">
                            <img src="/images/nursery/nursery-pic-4.jpeg">
                        </div>
                    </div>
                     <p class='mb'>Все наши производители прошли тестирование на генетические заболевания, к которым предрасположена порода американский булли. Кроме того, каждому из них сделан рентген под наркозом с правильной раскладкой, что гарантирует отсутствие суставных патологий. Когда щенки переезжают к вам, они уже полностью привиты, с купированными ушами (если это необходимо), обработаны от паразитов и готовы к прогулкам на улице. В комплекте с щенком вы получаете: Эхокардиограмму с заключением кардиолога; УЗИ брюшной полости всех органов с заключением; Осмотр и заключение ортопеда. Мы заботимся о здоровье и благополучии наших щенков, чтобы вы могли быть уверены в их отличном состоянии!</p>





                    <div class="block-variable-info block-variable-info-5 parent-animation">
                        <div class="block-variable-info-img" style="--block-variable-info-img-content: '5'; --block-variable-info-img-content-top: -21%; --block-variable-info-img-content-left: -22%;">
                            <img src="/images/nursery/nursery-pic-5.jpeg">
                        </div>
                        <div class="block-variable-info-desc">
                            <h3>Воспитание залог всего</h3>
                            <p>Только в нашем питомнике, покупая собаку, вас научат с ней обращаться и расскажут, как сделать её удобной и комфортной для всех членов семьи и других животных. Если у вас есть маленькие дети или другие домашние животные, это не станет помехой — мы научим вас, как создать гармонию между ними.</p>
                        </div>
                    </div>
                     <p class='mb'>Только в нашем питомнике, покупая собаку, вас научат с ней обращаться и расскажут, как сделать её удобной и комфортной для всех членов семьи и других животных. Если у вас есть маленькие дети или другие домашние животные, это не станет помехой — мы научим вас, как создать гармонию между ними.</p>




                    <div class="block-variable-info block-variable-info-6 block-variable-info-re parent-animation">
                        <div class="block-variable-info-desc block-variable-info-re-desc">
                            <h3>Доставка в любую точку мира</h3>
                            <p>Мы доставляем щенков любыми путями- самолетом, железной дорогой, автомобилем — практически в любую точку мира. Наши щенки живут практически в каждой стране.</p>
                        </div>
                        <div class="block-variable-info-img block-variable-info-re-img" style="--block-variable-info-img-content: '6'; --block-variable-info-img-content-top: -27%; --block-variable-info-img-content-right: -29%;">
                            <img src="/images/nursery/nursery-pic-6.jpeg">
                        </div>
                    </div>
                     <p class='mb'>Мы доставляем щенков любыми путями- самолетом, железной дорогой, автомобилем — практически в любую точку мира. Наши щенки живут практически в каждой стране.</p>




                    <div class="nursery-book">
                        <div class="wrapper">
                            <div class="nursery-book-block">
                                <div class="nursery-book-block-img">
                                    <img src="/images/nursery/nursery-book-pic.png">
                                </div>
                                <div class="nursery-book-block-desc">
                                    <h3>Забронируй щенка</h3>
                                    <p>Переходи в раздел “Щенки”, выбирай понравившегося и бронируй. Щенков разбирают быстро, поэтому успевай. Доставим в любую точку мира</p>
                                </div>
                                <div class="nursery-book-block-link">
                                <a href="dogs" class="btn">Щенки</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="to-top" data-action="gotop">
                <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 8H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M6 13H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M8 18H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M17 20V4L20 8" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </div>



            <style type="text/css">
                .mb{
                    display: none;
                }

                @media screen and (max-width: 515px) {


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
