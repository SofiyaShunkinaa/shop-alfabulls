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
                                                                 @php($url = url('storage/catalog/product/source/' . $product->image))
                                    <img src="{{ $url }}" alt="{{ $product->name }}" title="{{ $product->name }}">
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
                    <input type="text" class="form-control" name="address" placeholder="Адрес доставки"
                   required maxlength="255" value="{{ old('address') ?? $profile->address ?? '' }}">
                </div>
                <br>
                <div class="form-floating d-inline-block">
                   <input class="form-control" name="comment" placeholder="Комментарий"
                      maxlength="255" rows="2"  value="{{ old('comment') ?? $profile->comment ?? '' }}" >
                </div>
            </div>
        </div>
        </div>
        <div class="order-desc-item">
            <div class="order-desc-item-title">
                <p>3</p>
                <h3>Способ доставки</h3>
            </div>

            <div class="col-12 col-md-6" id="deliveries">
                <div class="form-group row">
                    <div class="col-12">

                        @foreach($deliveries as $delivery)
                            <div class="checkbox">
                                <label class="col-form-label delivery input-parent">
                                    <input type="radio" class="delivery" name="delivery" value="{{ $delivery->id }}"
                                           id="delivery_{{ $delivery->id }}" {{ $loop->first ? "checked='checked'" : '' }}>
                                        {{ $delivery->name }}
                                </label>
                                <div class="addData" style="display: none; padding-left: 100px;">
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>

            


        </div>

<div id="pvz-map" style="width: 100%; height: 300px; margin-top: 15px; margin-bottom: 15px; display: none">
    
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
                        style="width: 85px;
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
                    <button type="button" style="font-size: 16px; background: #fff; color: #5C5C5C; border-radius: 12px; padding: 6px; border: none; font-weight: 700;">Списать</button>
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
                  <input hidden type="number" name="delivery_amount" id="deliveryAmount">
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
                <button type="submit" class="btn btn-success">Оформить</button>
            </div>
        </div>
    </div>
</form>




                </div>
              </div>
            </section>


<script type="text/javascript">
    $(document).ready(function () {
        $('input[type=radio][name=discount_type]').change(function() {
            $('#result_total').html($('#total').html() - $('#' + this.value).html() + parseFloat($('.order-total-cost-delivery').html()));
        });
        $('input.delivery').change(function() {
            
            let self = $(this);
            $('.addData').html('');
            $.ajax({
                url: '{{ route('delivery.calculate') }}',
                type: 'post',
                data: $('form').serialize(),
                success: function(result) {
                    if (result.success) {
                        $('.order-total-cost-delivery').html(result.delivery_price);
                        $('#deliveryAmount').val(result.delivery_price);
                        $('#result_total').html($('#total').html() - $('#' + $('input[type=radio][name=discount_type]:checked').val()).html() + result.delivery_price);
                        if (result.addData) {
                            let addData = self.closest(".checkbox").find(".addData");
                            addData.show();
                            if (result.addData.pvz_list) {
                                if (result.addData.delivery_period) {
                                    // addData.html("Срок доставки: " + result.addData.delivery_period + "д.<br>");
                                    $('#deliveryDate').val(result.addData.delivery_period);

                                }
                                // const select = document.createElement("select");
                                // select.name = 'pvz';
                                // for(var k in result.addData.pvz_list) {
                                //     var option = document.createElement("option");
                                //     option.text = result.addData.pvz_list[k];
                                //     option.value = k;
                                //     select.add(option);
                                // }
                                // addData.append(select);
                            }
                        }
                        if (result.addData && result.addData.pvz_list) {
    let pvzList = result.addData.pvz_list;

    $('#pvz-map').show();

    // Очистить карту, если уже создана
    if (window.pvzMap && window.pvzMap.geoObjects) {
        window.pvzMap.geoObjects.removeAll();
    }

    // Инициализируем карту, если еще нет
    if (!window.pvzMap) {
        ymaps.ready(function () {
            initPvzMap(pvzList);
        });
    } else {
        initPvzMap(pvzList);
    }

    function initPvzMap(pvzList) {
        // Определим центр первого адреса через геокодер
        let firstAddress = Object.values(pvzList)[0];
        ymaps.geocode(firstAddress).then(function (res) {
            let centerCoords = res.geoObjects.get(0).geometry.getCoordinates();

            if (!window.pvzMap) {
                window.pvzMap = new ymaps.Map("pvz-map", {
                    center: centerCoords,
                    zoom: 12,
                    controls: ['zoomControl']
                });
            } else {
                window.pvzMap.setCenter(centerCoords);
            }

            // Добавляем все метки
            for (let key in pvzList) {
                let address = pvzList[key];

                ymaps.geocode(address).then(function (res) {
                    let coords = res.geoObjects.get(0).geometry.getCoordinates();
                    let placemark;

                    if (result.addData.delivery_period) {
                        placemark = new ymaps.Placemark(coords, {
                        balloonContent: `<div>
                        <div>${address}</div>
                        <br>
                        <div>Срок доставки: ${result.addData.delivery_period} Д.</div>
                        </div>`,
                        hintContent: address
                    }, {
                        preset: 'islands#blueDotIcon'
                    });
                    }
                    placemark = new ymaps.Placemark(coords, {
                        balloonContent: `<div>
                        <div>${address}</div>
                        </div>`,
                        hintContent: address
                    }, {
                        preset: 'islands#blueDotIcon'
                    });

                    placemark.events.add('click', function () {
                        $('#selected-pvz').val(address);
                    });
                    

                    window.pvzMap.geoObjects.add(placemark);
                });
            }
        });
    }
    
}

                    } else {
                        $('#delivery_1').prop('checked', 'checked');
                        if (result.error) {
                            alert(result.error);
                        }
                    }
                },
                error: function(result) {
                    alert('При выборе доставки произошла ошибка');
                },
            });
        });
    });
</script>

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
                location.reload(); // или обнови DOM, если хочешь без перезагрузки
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
