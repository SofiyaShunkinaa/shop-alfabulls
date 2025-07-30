jQuery(document).ready(function($) {
    /*
     * Общие настройки ajax-запросов, отправка на сервер csrf-токена
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*
     * Раскрытие и скрытие пунктов меню каталога в левой колонке
     */
    $('#catalog-sidebar > ul ul').hide();
    $('#catalog-sidebar .badge').on('click', function () {
        var $badge = $(this);
        var closed = $badge.siblings('ul') && !$badge.siblings('ul').is(':visible');

        if (closed) {
            $badge.siblings('ul').slideDown('normal', function () {
                $badge.children('i').removeClass('fa-plus').addClass('fa-minus');
            });
        } else {
            $badge.siblings('ul').slideUp('normal', function () {
                $badge.children('i').removeClass('fa-minus').addClass('fa-plus');
            });
        }
    });
    /*
     * Получение данных профиля пользователя при оформлении заказа
     */
    $('form#profiles button[type="submit"]').hide();
    // при выборе профиля отправляем ajax-запрос, чтобы получить данные
    $('form#profiles select').change(function () {
        // если выбран элемент «Выберите профиль»
        if ($(this).val() == 0) {
            // очищаем все поля формы оформления заказа
            $('#checkout').trigger('reset');
            return;
        }
        var data = new FormData($('form#profiles')[0]);
        $.ajax({
            url: '/basket/profile',
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                if (data.profile === undefined) {
                    console.log('data undefined');
                }
                $('input[name="name"]').val(data.profile.name);
                $('input[name="email"]').val(data.profile.email);
                $('input[name="phone"]').val(data.profile.phone);
                $('input[name="address"]').val(data.profile.address);
                $('textarea[name="comment"]').val(data.profile.comment);
            },
            error: function (reject) {
                alert(reject.responseJSON.error);
            }
        });
    });
    /*
     * Добавление товара в корзину с помощью ajax-запроса без перезагрузки
     */
$('form.add-to-basket').submit(function (e) {
    // отменяем отправку формы стандартным способом
    e.preventDefault();
    
    // получаем данные этой формы добавления в корзину
    var $form = $(this);
    var data = new FormData($form[0]);
    console.log($form.attr('action'));
    $.ajax({
        url: $form.attr('action'),
        data: data,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'json',
        success: function(response) {            
            if (response.success) {
                // Обновляем количество позиций в корзине
                if (response.positions > 0) {
                    $('.ms2_total_count').text(response.positions);
                    $('.discontrol-discounts').show();
                    $('.msMiniCart.full').show();
                    $('.ms2_total_count').show();
                    $('.cart-promocode').show();
                    
                } else {
                    $('.ms2_total_count').hide();
                    $('.discontrol-discounts').hide();
                    $('.msMiniCart.full').hide();
                    $('.ms2_total_count').hide();
                    $('.cart-promocode').hide();
                }

                // Обновляем стоимость и скидку
                $('#total-cost').text(response.total_with_discount + " ₽");
                $('#discount').text(response.discount + " ₽");

                // Обновляем список товаров в корзине
                var $cartItems = $('.cart-items');
                $cartItems.empty();  // Очищаем текущий список товаров в корзине
                
                console.log(response.products);
                // Добавляем новые товары в корзину
                $.each(response.products, function(index, product) {
                    var productHTML = `
                        <div class="cart-item" data-product-item-id="${product.id}">
                            <div class="cart-item-img">
                                <a href="/catalog/product/${product.slug}" style="width: 150px;
                                        display: block;
                                        border-radius: 14px;
                                        text-align: center;
                                        overflow: hidden;">
                                    <img src="/storage/catalog/product/source/${product.image}" alt="${product.name}" title="${product.name}">
                                </a>
                            </div>
                            <div class="cart-item-title">
                                <a href="/catalog/product/${product.slug}">${product.name}, ${product.weight}</a>
                                <div class="order-desc-item-zakaz-item-total">
                                    <div style="display: flex;">
                                        <div class="input-group input-group-sm product-qty-wrapper" data-product-id="${product.id}">
                                            <button onclick="changeQuantity(${product.id}, 'minus')" class="btn-qty">-</button>
                                            <input type="number" min="1" value="${product.quantity}" oninput="changeQuantity(${product.id}, 'set', this.value)" class="form-control text-center product-qty">
                                            <button onclick="changeQuantity(${product.id}, 'plus')" class="btn-qty plus-btn">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-item-price">
                                    <div style="display: flex;">
                                        <p class="old_price" id="product-total-old-${product.id}">${parseFloat(product.oldprice).toFixed(2)} ₽</p>
                                        <p class="mr-2" id="product-total-${product.id}">${product.price} ₽</p>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-item-remove">
                                <button class="btn-sm btn-danger delete-item-btn" style="background: transparent; border: none;" data-id="${product.id}" type="button">
                                    <img src="/images/icons/icon-basket-delete.svg" alt="Delete">
                                </button>
                            </div>
                        </div>
                    `;
                    $cartItems.append(productHTML);

                    $('#total_basket').text(response.total); // Стоимость продуктов
                    $('#discount_percent_basket').text(response.discount); // Скидка
                    $('#result_total_basket').text(response.total_with_discount); // Итоговая стоимость
                });
            }
        }
    });
});




var animateButton = function(e) {

  e.preventDefault;
  //reset animation
  e.target.classList.remove('animate');

  e.target.classList.add('animate');
  setTimeout(function(){
    e.target.classList.remove('animate');
  },700);
};

var bubblyButtons = document.getElementsByClassName("btn");

for (var i = 0; i < bubblyButtons.length; i++) {
  bubblyButtons[i].addEventListener('click', animateButton, false);
}

});
