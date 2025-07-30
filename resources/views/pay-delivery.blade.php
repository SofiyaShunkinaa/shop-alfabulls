@extends('layout.site')


@section('content')
<section class="breadcrumbs">
    <div class="wrapper">
        <div class="breadcrumbs__inner">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="../reviews.html">Главная</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4" /></svg></span><li class="breadcrumb-item active">Оплата и доставка</li></ol>
        </div>
    </div>
</section>
            <section class="paydelivery">
                <div class="paydelivery-bg-1"></div>
                <div class="paydelivery-bg-2"></div>
                <div class="wrapper parent-animation">
                    <h1>Оплата и доставка</h1>
                    <div class="paydelivery-block">
                        <div class="paydelivery-block-item">
                            <h2>
                                1. Доставка
                                <img src="/images/paydelivery/cdek.png" alt="">
                                <img src="/images/paydelivery/yandex.png" alt="">
                                <img src="/images/paydelivery/pochta.png" alt="">
                                <img src="/images/paydelivery/vozovoz.png" alt="">
                            </h2>
                            <ul>
                                <li>
                                    <p>Оплатить можно онлайн с помощью банковской карты. Наши товары могут быть доставлены в любую точку России с помощью транспортных компаний СДЭК, Яндекс Доставка, Возовоз и Почта России. В момент оформления заказа вы можете указать адрес доставки или выбрать пункт самовывоза, выбранной вами курьерской службой.</p>
                                </li>
                                <li>
                                    <p>Для оплаты (ввода реквизитов Вашей карты) Вы будете перенаправлены на платёжную страницу (платежный шлюз). Соединение с платёжным шлюзом и передача информации осуществляется в защищённом режиме с использованием протокола шифрования SSL. В случае если Ваш банк поддерживает технологию безопасного проведения интернет-платежей Verified By Visa, MasterCard SecureCode, MIR Accept, J-Secure для проведения платежа также может потребоваться ввод специального пароля.</p>
                                </li>
                                <li>
                                    <p>Настоящий сайт поддерживает 256-битное шифрование. Конфиденциальность сообщаемой персональной информации гарантируется. Введённая информация не сохраняется в нашей системе и не будет предоставлена третьим лицам за исключением случаев, предусмотренных законодательством РФ.</p>
                                </li>
                                <li>
                                    <p>Проведение платежей по банковским картам осуществляется в строгом соответствии с требованиями платёжных систем МИР, Visa Int., MasterCard Europe SPRL.</p>
                                </li>
                            </ul>
                        </div>
                        <div class="paydelivery-block-item">
                            <h2>2. Самовывоз в Ярославле</h2>
                            <ul>
                                <li>
                                    <p>Доступен самовывоз товара в Ярославле по предварительному согласованию по телефону. Вы можете оплатить товар при получении. Дату и время получения заказа необходимо согласовать по телефону <a href="tel:+79807427894">+7 980-742-78-94</a>.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <div class="to-top" data-action="gotop">
                <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 8H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M6 13H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M8 18H13" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M17 20V4L20 8" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </div>
        </main>


@endsection
