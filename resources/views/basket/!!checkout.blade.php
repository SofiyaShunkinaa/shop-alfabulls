@extends('layout.site', ['title' => 'Оформить заказ'])

@section('content')
<style>
    .bonus-amount-inp::placeholder{
        color: #fff;
    }
</style>


         <section class="breadcrumbs">
    <div class="wrapper">
        <div class="breadcrumbs__inner">
            <ol class="breadcrumb"><li class="breadcrumb-item"><a href="/">Главная</a></li><span style="position: relative; top: -2px;"><svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2.5" r="2" fill="#B4B4B4"></circle></svg></span><li class="breadcrumb-item active">Оформить заказ</li></ol>
        </div>
    </div>
</section>
            <section class="order">
               <div class="wrapper">
                <h1 class="anim-title" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px); text-align: center;">Оформить заказ</h1>
                <div class="order__inner" id="msCart">


                  <div class="order-desc">
                      <div class="order-desc-item">
                          <div class="order-desc-item-title">
                              <p>1</p>
                              <h3>Товары в заказе</h3>
                          </div>

                          @if (count($products))

            <div class="order-desc-item-zakaz">
                 @foreach($products as $product)

                                    <!--  -->
                    <div class="order-desc-item-zakaz-item">
                        <div class="order-desc-item-zakaz-item-img">
                                                            <a href="{{ route('catalog.product', ['product' => $product->slug]) }}" style="display: block; height: 55px;">
    <img src="{{ url('storage/catalog/product/source/' . $product->image) }}"
         alt="{{ $product->name }}"
         title="{{ $product->name }}">
</a>
                        </div>
                        <div class="order-desc-item-zakaz-item-title">
                                                            <a href="{{ route('catalog.product', ['product' => $product->slug]) }}">{{ $product->name }}</a>
                        </div>

                        <div class="order-desc-item-zakaz-item-total" style="white-space: nowrap;">
                            <h5>Кол-во</h5>

                            <div style="
                                    display: flex;
                                    justify-content: center;
                                ">

                                            <span class="mx-1">{{ $product->quantity }} шт</span>

                                        </div>
                        </div>

                        <div class="order-desc-item-zakaz-item-cost">
                            <h5>Сумма</h5>
                            <p class="order-desc-item-zakaz-item-cost">{{ number_format($product->total_price, 2, '.', '') }} ₽</p>
                        </div>


                    </div>

                     @endforeach


                </div>


                  @else
        <p>Ваша корзина пуста</p>
    @endif


                      </div>


  <form method="post" action="{{ route('basket.saveorder') }}" id="checkout">
    <div class="order-desc-item">
        <div class="order-desc-item-title">
            <p>2</p>
            <h3>Адрес доставки</h3>
        </div>
        <div class="col-12 col-md-6" id="deliveries">
            <div class="form-group order-desc-form-deliveries">



                <div class="form-floating d-inline-block">
                    <input  list="character" id='adresserch' type="text" class="form-control" name="address" placeholder="Адрес доставки"
                   required maxlength="255" value="{{ old('address') ?? $profile->address ?? '' }}">
                   <datalist id="character">


                   </datalist>
                </div>
                    <input hidden id='adressCode' type="text" class="form-control" name="address_code" maxlength="255" value="{{ old('address') ?? $profile->address ?? '' }}">
                    <input hidden id='city' type="text" class="form-control" name="city" maxlength="255" value="">
                    <input hidden id='street' type="text" class="form-control" name="street" maxlength="255" value="">
                    <input hidden id='postalcode' type="text" class="form-control" name="postalcode" maxlength="255" value="">
            </div>
        </div>
        </div>
         <div class="order-desc-item">
        <div class="order-desc-item-title">
            <p>3</p>
            <h3>Расписание отправок</h3>
        </div>
        <div class="col-12 col-md-6" id="deliveries">
            <div class="form-group order-desc-form-deliveries">


            <img src="/images/dosita.png" style="
    width: 100%;
">

            </div>
        </div>
        </div>
        <div class="order-desc-item">
            <div class="order-desc-item-title">
                <p>4</p>
                <h3>Способ доставки</h3>
            </div>

            <div class="col-12 col-md-6" id="deliveries">
                <div class="form-group row">
                    <div class="col-12 deliveriesBox">

                        @foreach($deliveries as $delivery)
                            <div class="checkbox">
                                <label class="col-form-label delivery input-parent">
                                    <input type="radio" class="delivery" name="delivery" value="{{ $delivery->id }}"
                                           id="delivery_{{ $delivery->id }}" {{ $loop->first ? "checked='checked'" : '' }}>
                                        @php
                                            $deliveries = [
                                                1 => ['img' => '', 'name' => 'Пункт выдачи', 'desc' => 'Cамовывоз'],
                                                2 => ['img' => '/images/logo-sdek.png', 'name' => 'Пункт выдачи', 'desc' => 'СДЭК (самовывоз)'],
                                                3 => ['img' => '/images/logo-ya.png', 'name' => 'Пункт выдачи', 'desc' => 'Яндекс (самовывоз)'],
                                                4 => ['img' => '/images/logo-post.png', 'name' => 'Пункт выдачи', 'desc' => 'Почта России (самовывоз)'],
                                                5 => ['img' => '/images/logo-boxberry.png', 'name' => 'Пункт выдачи', 'desc' => 'Boxberry (самовывоз)'],
                                                6 => ['img' => '/images/logo-vozovoz.png', 'name' => 'Пункт выдачи', 'desc' => 'Возовоз (самовывоз)'],
                                                7 => ['img' => '/images/logo-sdek.png', 'name' => 'Курьером', 'desc' => 'СДЭК (Доставка курьером)'],
                                                8 => ['img' => '/images/logo-ya.png', 'name' => 'Курьером', 'desc' => 'Яндекс (Доставка курьером)'],
                                            ];

                                            $deliveryInfo = $deliveries[$delivery->id] ?? null;
                                        @endphp

                                        @if ($delivery->id == 1)
                                            <p style="height: 28px; margin-top:0px"></p>
                                        @elseif ($deliveryInfo)
                                            <img src="{{ $deliveryInfo['img'] }}" style="height: 28px;">
                                        @endif

                                        
                                            <p>{{ $deliveryInfo['name'] }}</p>
                                            <p class="desc">{{ $deliveryInfo['desc'] }}</p>
                                        
                                </label>
                                <div class="addData" style="display: none; padding-left: 100px;">
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>

            


        </div>

<div id="pvz-map" style="width: 100%; height: 436px; margin-top: 15px; margin-bottom: 15px; display: none">
    <h3>Выберите ПВЗ</h3><br><p id='pvz_curs'></p><br>
    <div id="map-pvz" style="width: 100%; height: 306px; margin-top: 15px;"></div>
    <div id="ecom-widget" style="width: 100%; height: 306px; margin-top: 15px;">
            
    </div>
</div>

  <div class="order-desc-item">
        <div class="order-desc-item-title">
            <p>5</p>
            <h3>Информация</h3>
        </div>
        <div class="col-12 col-md-6" id="deliveries">
            <div class="form-group order-desc-form-deliveries">


        @csrf





                <div class="form-floating d-inline-block">
                    <input type="text" class="form-control" name="name" placeholder="Имя, Фамилия"
                   required maxlength="255" value="{{ old('name') ?? $profile->name ?? '' }}">
                </div>
                <br>
                <div class="form-floating d-inline-block">
                     <input type="email" class="form-control" name="email" placeholder="Адрес почты"
                   required maxlength="255" value="{{ old('email') ?? $profile->email ?? '' }}">
                </div>
                <br>
                <div class="form-floating d-inline-block">
                    <input type="text" class="form-control" name="phone" placeholder="Номер телефона"
                   required maxlength="255" value="{{ old('phone') ?? $profile->phone ?? '' }}">
                </div>

                <br>
                <div class="form-floating d-inline-block">
                   <input class="form-control" name="comment" placeholder="Комментарий"
                      maxlength="255" rows="2"  value="{{ old('comment') ?? $profile->comment ?? '' }}" >
                </div>
            </div>
        </div>
        </div>



                  </div>
                      <div class="order-total" style="display: grid;">
        <h3>Cумма заказа</h3>

        @if ($promo || $basket_bonus_points === 0)
                        <div class="cart-promocode" style="margin-bottom: 25px;" >
                    <div class="mspc2 [ js-mspc2 ]">
                        <div class="mspc2-form [ js-mspc2-form ] ">
                                <div style="position: relative;">
                                    <input class="mspc2-form__input [ js-mspc2-input ] checkout-promo-inp" 
                                    style="        
                                    width: 100%;
                                    padding: 10px 15px;
                                    border: 2px dashed #A2A2A2;
                                    border-radius: 6px;
                                    font-family: 'Buyan', sans-serif;
                                    font-size: 20px;
                                    font-weight: 700;
                                    color: #A2A2A2;
                                    letter-spacing: 0.05em;
                                    background: transparent;
                                    outline: none;
                                    text-align: center;
                                    " 
                                        type="text" name="mspc2_code" value="" placeholder="Введите промокод">
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
@endif

        <div class="cart-bonus-total">
                    </div>
        @if (!$promo || $basket_bonus_points === 0)
                <div style="margin-bottom: 14px; display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                    <div style="font-size: 16px; font-weight: 800;">Бонусов: <span style="color: #FFCC8F;">{{ $user_points }} ₽</span></div>
                    <input class="bonus-amount-inp" type="number" name="bonusPointAmount" id="bonusPointAmount"
                        style="width: 94px;
            padding: 5px !important;
            border: 2px dashed #fff;
            border-radius: 12px;
            font-family: 'Buyan', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.05em;
            background: transparent;
            outline: none;
            text-align: center;"
            placeholder="0 ₽"
                    >
                    <button type="button" style="    padding: 6px 20px; font-size: 16px; background: #fff; color: #5C5C5C; border-radius: 12px;  border: none; font-weight: 700;">Списать</button>
                </div>
                <input type="number" hidden name="bonusPointAmount" value="{{ $basket_bonus_points }}">
        @endif
        <div class="order-total-cost">
            <ol class="order-total-cost-pre-price">
                <li>
                  <div>Стоимость продуктов</div>
                  <div></div>
                  <div class="total_old_cost"><span id="total">{{ $total }}</span> ₽</div>
                </li>
                <li>
                  <div>Доставка</div>
                  <div></div>
                  <div><span class="order-total-cost-delivery">0</span> ₽</div>
                  <input hidden name="delivery_amount" id="deliveryAmount" value="0"> 
                </li>
                @if ($promo)
                <li>
                    <div><input hidden checked type="radio" name="discount_type" value="promo" /> Скидка</div>
                    <div></div>
                    <div>- <span class="[ js-mspc2-discount-amount ]" id="promo">
                        @if ($basket_products->count() === 0)
                        0

                        @else
                        {{ $promo->pric }}
                        @endif
                    
                    </span> ₽</div>
                </li>
                @elseif($basket_bonus_points !== 0)
                <li>
                    <div><input hidden checked type="radio" name="discount_type" value="bonus_points" /> Скидка</div>
                    <div></div>
                    <div>- <span class="[ js-mspc2-discount-amount ]" id="bonus_points">{{ $basket_bonus_points }}</span> ₽</div>
                </li>
                @else
                <li>
                    <div><input hidden checked type="radio" name="discount_type" value="discount_percent"/> Скидка {{ $discount ? $user_discount_percent . '%' : '' }}</div>
                    <div></div>
                    <div>- <span class="[ js-mspc2-discount-amount ]" id="discount_percent">{{ $discount }}</span> ₽</div>
                </li>
                @endif

              </ol>
              <div class="order-total-cost-total-price">
                  <p class="order-total-cost-total-price-1">Итого</p>
                  <p class="order-total-cost-total-price-2"><span id="result_total">
                    @if ($promo)
                    {{ $total - $promo->pric }}
                    @elseif ($basket_bonus_points)
                    {{ $total - $basket_bonus_points }}
                    @else
                    {{ $total - $discount }}
                    @endif
                </span> ₽</p>
              </div>
              <input hidden type="number" name="delivery_date" id="deliveryDate" value="0">
              <input type="hidden" name="pvz" id="selected-pvz">
              <div class="form-group">
                <button style="width: 100%;" type="submit" class="btn btn-success">Оформить</button>
            </div>
        </div>
    </div>
</form>




                </div>
              </div>
            </section>

<script src="https://widget.pochta.ru/map/widget/widget.js"></script>
        <script> 
        $(function () {           
            function callbackPost(data) {
                console.log(data);
                $('#pvz_curs').text('Ваш ПВЗ: ' + data.cityTo + ', ' + data.addressTo);
                $('#selected-pvz').val(data.cityTo + ', ' + data.addressTo);
                $('.order-total-cost-delivery').html(Math.round(data.cashOfDelivery/100));
                $('#deliveryAmount').val(Math.round(data.cashOfDelivery/100));
                $('#adressCode').val(data.indexTo);
                updateTotalPrice();
            }
        

    /* --------- 1. Слушатели ------------------ */
    $('input[name="discount_type"]').on('change', updateTotalPrice);
    $('input.delivery').on('change',  handleDeliveryChange);
    $('#adresserch')      .on('keyup', debounce(dadataSuggest, 350))
                          .on('blur',  () => setTimeout(() => $('#suggestions').hide(), 200));
    $('#suggestions').on('click', '.suggestion', selectSuggestion);

    /* --------- 2. Пересчёт итоговой суммы ----- */
    function updateTotalPrice() {
        const discount = parseFloat($('#' + $('input[type=radio][name=discount_type]:checked').val()).html()) || 0;
        const total = parseFloat($('#total').html()) || 0;
        let delivery = parseFloat($('.order-total-cost-delivery').html()) || 0;

        // Если выбран самовывоз (id=1), доставка = 0
        const deliveryId = $('input.delivery:checked').val();
        if (Number(deliveryId) === 1) {
            delivery = 0;
            $('.order-total-cost-delivery').html('0');
            $('#deliveryAmount').val(0);
        }

        $('#result_total').html((total - discount + delivery).toFixed(2));
    }

    /* --------- 3. Смена доставки ------------- */
    function handleDeliveryChange () {
        const deliveryId = +$(this).val();

        // Скрыть оба виджета при переключении
        $('#pvz-map').hide();
        $('#map-pvz').hide();
        $('#ecom-widget').hide().html(''); // Сбросить контейнер и скрыть
        $('#pvz_curs').text('');
        $('.addData').empty();

        if (deliveryId === 1) {
            // Самовывоз — сразу выставляем 0 и обновляем итог
            $('.order-total-cost-delivery').html('0');
            $('#deliveryAmount').val(0);
            updateTotalPrice();
            return; // не делаем ajax-запрос
        }

        $.post('{{ route('delivery.calculate') }}', $('form').serialize())
         .done(res => res.success
                ? processSuccess(res, deliveryId)
                : processError  (res, deliveryId))
         .fail(() => alert('При выборе доставки произошла ошибка'));
    }

    /* --------- 4. Успешный ответ -------------- */
    function processSuccess (res, deliveryId) {
        $('.order-total-cost-delivery').text(res.delivery_price);
        $('#deliveryAmount').val(res.delivery_price);
        updateTotalPrice();

        if (deliveryId === 4) {
            startRussianPostWidget();
            return;
        }

        if (res.addData?.pvz_list && ![7,8].includes(deliveryId)) {
            if (res.addData.delivery_period)
                $('#deliveryDate').val(res.addData.delivery_period);

            showPvzMap(res.addData.pvz_list, res.addData.delivery_period);
        }
    }

    /* --------- 5. Ошибка от API --------------- */
    function processError (res, deliveryId) {
        if (deliveryId === 1) {
            // Не показываем ошибку, просто выходим
            return;
        }
        if (Number(deliveryId) === 4) {
            $('#pvz-map').show(); // скрыть карту Яндекса
            $('#map-pvz').hide();
            $('#ecom-widget').show().html(''); // Показать и очистить контейнер

            const addr = $('#adresserch').val();

            ecomStartWidget({
                id: 56665,
                start_location: addr,
                callbackFunction: callbackPost,
                containerId: 'ecom-widget',
                zoom: 14
            });
            return;
        }
        alert(res.error || 'Служба доставки вернула ошибку');
        $('#delivery_1').prop('checked', true).trigger('change');
    }

    /* --------- 6. Виджет Почты России --------- */
    function startRussianPostWidget () {
        const addr = $('#adresserch').val().trim() || 'Москва';

        $('#pvz-map, #ecom-widget').show();
        ecomStartWidget({
            id: 56665,
            start_location: addr,
            containerId: 'ecom-widget',
            callbackFunction: callbackPost,
            zoom: 14
        });
    }

    /* --------- 7. Яндекс-карта ПВЗ ------------ */
    function showPvzMap (pvzList, deliveryPeriod) {
        $('#pvz-map, #map-pvz').show();
        if (window.pvzMap?.geoObjects) window.pvzMap.geoObjects.removeAll();

        const city     = $('#adresserch').val();
        const firstPvz = Object.values(pvzList)[0];

        ymaps.ready(() =>
            ymaps.geocode(`${city}, ${firstPvz}`).then(g => {
                const center = g.geoObjects.get(0).geometry.getCoordinates();

                window.pvzMap ??= new ymaps.Map('map-pvz', {
                    center, zoom: 12, controls:['zoomControl', 'searchControl']
                });
                window.pvzMap.setCenter(center);

                for (const [code, addr] of Object.entries(pvzList)) {
                    ymaps.geocode(addr).then(r => {
                        const coords  = r.geoObjects.get(0).geometry.getCoordinates();


                        const content = deliveryPeriod ? `${addr}<br>Срок: ${deliveryPeriod} д. <br> <p class="mark" data-adrt="${addr}" data-cod="${code}">Выбрать этот пвз</p>` : `${addr}<br> <p class="mark" data-adrt="${addr}" data-cod="${code}">Выбрать этот пвз</p>`;

                        const mark = new ymaps.Placemark(
                            coords,
                            { balloonContent: content, hintContent: addr },
                            { preset:'islands#blueDotIcon' }
                        );

                        mark.events.add('click', e => {

                           /* $('#pvz_curs').text('Ваш ПВЗ: ' + addr);
                            $('#selected-pvz').val(addr);
                            $('#adressCode').val(code);
                            e.get('target').options.set('preset','islands#greenIcon');*/
                            $('.mark').html('Выбрать этот пвз');
                        });

                        window.pvzMap.geoObjects.add(mark);
                    });
                }
            })
        );
        $('#ecom-widget').hide(); // скрыть другой виджет, если он отображался
        $('#map-pvz').show();     // показать только карту
    }

    /* --------- 8. DaData ---------------------- */
    const DADATA_TOKEN = 'd3d021a1db380b7cc4a88b230c254c6d79d63c2f';

    function dadataSuggest () {
        const query = $(this).val();
        if (query.length < 3) { $('#suggestions').hide(); return; }

        fetch('https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address', {
            method : 'POST',
            mode   : 'cors',
            headers: {
                'Content-Type':'application/json',
                'Accept'      :'application/json',
                'Authorization':'Token ' + DADATA_TOKEN
            },
            body: JSON.stringify({ query, count:5 })
        })
        .then(r => r.json())
        .then(json => {
            const list = json.suggestions.map(s =>
                `<li class="list-group-item suggestion" data-value="${s.value}">${s.value}</li>`
            ).join('');
            $('#suggestions').html(list).show();
        })
        .catch(console.error);
    }

    function selectSuggestion () {
        const value = $(this).data('value');
        $('#adresserch').val(value);
        $('#suggestions').hide();

        /* если пользователь уже выбрал способ доставки,
           подменим адрес в виджете Почты России */
        if ($('input.delivery:checked').val() === '4') startRussianPostWidget();
    }

    /* --------- 9. Утилита debounce ------------ */
    function debounce (fn, ms = 300) {
        let t; return (...args) => { clearTimeout(t); t = setTimeout(() => fn.apply(this, args), ms); };
    }
});



   $(document).on('click', '.mark', function() {
      var addr = $(this).data('adrt');
      var code = $(this).data('cod');


      $('#pvz_curs').text('Ваш ПВЗ: ' + addr);
                            $('#selected-pvz').val(addr);
                            $('#adressCode').val(code);
    $(this).html('Пункт выбран!');
    });


let suggestionsData = []; // для хранения полученных подсказок
$('#adresserch').keyup(function(event) {
    var filterN = $(this).val();
    console.log("Нажата клавиша: " + event.key);

    if(event.key === undefined){
        return;
    }

  if(filterN.length >= 3){

            var url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address";
            var token = "d3d021a1db380b7cc4a88b230c254c6d79d63c2f";
            var query = $(this).val();

            var options = {
                method: "POST",
                mode: "cors",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "Authorization": "Token " + token
                },
                body: JSON.stringify({query: query})
            }

            fetch(url, options)
            .then((response) => {
                $('#character').html('');
                return response.json()
            })
            .then((json) => {
                suggestionsData = json.suggestions;

                $.each(json.suggestions, function(key, value) {
                $('#character').append('<option value="' + value.value  + '"></option>');
                 });


                //$('#character').append('<option value="' +  + '"></option>');
            })
            .catch(error => console.log("error", error));
        }

});

// Отслеживаем выбор пользователем подсказки из datalist (на input с list="character")
$('#adresserch').on('change', function() {
    const val = $(this).val();
    // Ищем объект с таким value в подсказках
    const selected = suggestionsData.find(item => item.value === val);

    if (selected) {
        const city = selected.data.city || '';
        const street = selected.data.street || '';
        const postal_code = selected.data.postal_code || '';

        console.log('Город:', city);
        console.log('Улица:', street);
        console.log('Почтовый индекс:', postal_code);

        // Здесь можно записать в нужные поля формы или куда угодно
        $('#city').val(city);
        $('#street').val(street);
        $('#postalcode').val(postal_code);

        console.log(city);
    }
});




</script>
<style>
    .mark{
        padding: 4px 0px;
    width: 100%;
    text-align: center;
    line-height: 1;
    color: #584D3E;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.07em;
    border: none;
    border-radius: 15px;
    opacity: 1 !important;
    background: linear-gradient(263.56deg, #FFE9C8 -4.53%, #FFD9AD 18.44%, #FFDDB5 51.46%, #FFDDB5 76.6%, #FFCC8F 111.92%), radial-gradient(55.13% 55.13% at 50% 2.23%, rgba(255, 255, 255, 0.5) 0%, rgba(255, 255, 255, 0) 100%);
    box-shadow: 0px 1.8px 0px 0px rgba(216, 168, 110, 1);
    text-transform: uppercase;
    font-family: 'Montserrat';
    cursor: pointer;
    }
</style>
<script>
let debounceTimeout;

const input = document.querySelector('.checkout-promo-inp');

function applyPromoCode() {
    const promoCode = input.value.trim();
    if (!promoCode) return;

    fetch("{{ route('basket.apply.promo') }}", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ mspc2_code: promoCode })
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
}

// Обработчик ввода с дебаунсом
input?.addEventListener('input', () => {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        applyPromoCode();
    }, 500); 
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const applyBtn = document.querySelector('button[type="button"]');
    const bonusInput = document.getElementById('bonusPointAmount');

    applyBtn.addEventListener('click', function () {
        const amount = bonusInput.value;

        fetch('{{ route('user.basket.change_bonus') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ bonusPointAmount: amount })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Ошибка списания баллов');
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
        });
    });
});
</script>



@endsection
