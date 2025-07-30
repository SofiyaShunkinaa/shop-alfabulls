
       <div class="ms2_product catalog-item" itemtype="http://schema.org/Product" itemscope>



        <input type="hidden" name="id" value="31">
        <input type="hidden" name="count" value="1">
        <input type="hidden" name="options" value="[]">
        <div class="catalog-item-img">
            <a href="{{ route('catalog.product', ['product' => $product->slug]) }}" style="
    overflow: hidden;
    display: flex;
    justify-content: center;
    border-radius: 26px;
">
                   @if ($product->image)
                @php($url = url('storage/catalog/product/source/' . $product->image))

                 <img src="{{ asset('storage/catalog/product/source/' . $product->image) }}" alt="{{ $product->name }}" title="{{ $product->name }}" style="object-fit: contain;width: auto;" itemprop="image"/>
            @else

                <img src="https://via.placeholder.com/300x150" alt="{{ $product->name }}" title="{{ $product->name }}" style="object-fit: contain;" itemprop="image"/>
            @endif
            </a>
        </div>
        <div class="catalog-item-desc" itemtype="http://schema.org/AggregateOffer" itemprop="offers" itemscope>
            <meta itemprop="category" content="Влажные корма">
            <meta itemprop="name" content="Консерва для кошек (курица), 100г">
            <meta itemprop="offerCount" content="1">
            <meta itemprop="price" content="126">
            <meta itemprop="lowPrice" content="126">
            <meta itemprop="priceCurrency" content="RUR">

            <a href="{{ route('catalog.product', ['product' => $product->slug]) }}" class="catalog-item-desc-a">
                <h3 class="catalog-item-desc-title" title="Консерва для кошек (курица), 100г">{{ $product->name }}</h3>

                <div class='type_flex'>
                                <div class="activ_type" data-class='farsofca_1'><p>1.5 КГ</p></div>
                                <div class="" data-class='farsofca_2'><p>3 КГ</p></div>
                                <div class="" data-class='farsofca_3'><p>ss</p></div>
                            </div>



                <span class="catalog-item-desc-price farsofca_1">{{ number_format($product->price, 2, '.', '') }} ₽1</span>
                 <span class="catalog-item-desc-price farsofca_2">{{ number_format($product->price, 2, '.', '') }} ₽2</span>
                  <span class="catalog-item-desc-price farsofca_3">{{ number_format($product->price, 2, '.', '') }} ₽3</span>

                @if ($product->oldprice != 0)
                <span class="catalog-item-desc-old-price ml-md-3">{{ number_format($product->oldprice, 2, '.', '') }} ₽</span>
                @endif

                            </a>
<form action="{{ route('basket.add', ['id' => $product->id]) }}" method="post" class="form-inline add-to-basket" id="add-to-basket-form-{{ $product->id }}">
    @csrf

    <button class="btn catalog-item-btn btn-cart-js" type="button" onclick="$('.cart').addClass('show').removeClass('hide');" style="display: none;">
                оформить заказ
            </button>
    <button class="btn catalog-item-btn btn-submit-js btn-success add-to-basket" type="submit" name="ms2_action" value="cart/add">
        Добавить в корзину
    </button>
</form>

        </div>

</div>

