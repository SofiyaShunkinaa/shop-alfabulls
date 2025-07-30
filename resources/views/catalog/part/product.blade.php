
<div class="ms2_product catalog-item" itemtype="http://schema.org/Product" itemscope>



        <input type="hidden" name="id" value="{{ $product->id }}">
        <input type="hidden" name="count" value="1">
        <input type="hidden" name="options" value="[]">
        <div class="catalog-item-img">
            <a href="{{ route('catalog.product', ['product' => $product->slug]) }}" style="
    overflow: hidden;
    display: flex;
    justify-content: center;
    border-radius: 26px;
">
            @php
                // Берём первую картинку из первого варианта, если есть, иначе основное изображение товара
                $firstVariant = $product->variants->first();
                $imagePath = null;
                if ($firstVariant && $firstVariant->images && $firstVariant->images->count() > 0) {
                    $imagePath = $firstVariant->images->first()->path;
                }
                $imageUrl = $imagePath
                    ? asset('storage/catalog/product/source/' . $imagePath)
                    : ($product->image ? asset('storage/catalog/product/source/' . $product->image) : null);
            @endphp

                   @if ($imageUrl)
                

                 <img src="{{ $imageUrl }}" alt="{{ $product->name }}" title="{{ $product->name }}" style="object-fit: contain;width: auto;" itemprop="image"/>
            @else

                <img src="https://via.placeholder.com/300x150" alt="{{ $product->name }}" title="{{ $product->name }}" style="object-fit: contain;" itemprop="image"/>
            @endif
            </a>
        </div>
        <div class="catalog-item-desc" itemtype="http://schema.org/AggregateOffer" itemprop="offers" itemscope>
            <meta itemprop="category" content="{{ $product->category->name ?? '' }}">
            <meta itemprop="name" content="{{ $product->name }}">
            <meta itemprop="offerCount" content="{{ $product->variants->count() }}">

            {{-- Цена будет минимальной среди вариантов (если нужно) --}}
            @php
                $minPrice = $product->variants->min('price') ?? $product->price;
                $minOldPrice = $product->variants->min('oldprice') ?? $product->oldprice;
            @endphp
            <meta itemprop="price" content="{{ number_format($minPrice, 2, '.', '') }}">
            <meta itemprop="lowPrice" content="{{ number_format($minPrice, 2, '.', '') }}">
            <meta itemprop="priceCurrency" content="RUR">

            <a href="{{ route('catalog.product', ['product' => $product->slug]) }}" class="catalog-item-desc-a">
                <h3 class="catalog-item-desc-title" title="{{ $product->name }}">{{ $product->name }}</h3>

                <div class='type_flex'>
                     @foreach($product->variants as $index => $variant)
                        <div class="{{ $index === 0 ? 'activ_type' : '' }} @if (count($product->variants) == 1) {{'dont_visibl'}} @endif" data-variantid="{{ $variant->id }}"  data-class="farsofca_{{ $index + 1 }}">
                            <p>{{ $variant->weight }}</p>
                        </div>
                     @endforeach
                                <!-- <div class="" data-class='farsofca_2'><p>3 КГ</p></div>
                                <div class="" data-class='farsofca_3'><p>ss</p></div> -->
                            </div>



                @foreach($product->variants as $index => $variant)
                    <span class="catalog-item-desc-price farsofca_{{ $index + 1 }}">
                        {{ number_format($variant->price, 2, '.', '') }} ₽
                    </span>
                @endforeach

            @if ($minOldPrice && $minOldPrice != 0)
                <span class="catalog-item-desc-old-price ml-md-3">{{ number_format($minOldPrice, 2, '.', '') }} ₽</span>
            @endif

                            </a>
<form action="{{ route('basket.add', ['id' => $product->id]) }}" method="post" class="form-inline add-to-basket" id="add-to-basket-form-{{ $product->id }}">
    @csrf
    <input type="hidden" name="variant_id" id="variant_id_input" value="{{ $product->variants->first()->id ?? '' }}">

    <button class="btn catalog-item-btn btn-cart-js" type="button" onclick="$('.cart').addClass('show').removeClass('hide');" style="display: none;">
                оформить заказ
            </button>
    <button class="btn catalog-item-btn btn-submit-js btn-success add-to-basket" type="submit" name="ms2_action" value="cart/add">
        Добавить в корзину
    </button>
</form>

        </div>

</div>

<script>
    /*document.querySelectorAll('.type_flex div').forEach((el, index) => {
        el.addEventListener('click', () => {
            // Снимаем класс 'activ_type' у всех
            document.querySelectorAll('.type_flex div').forEach(d => d.classList.remove('activ_type'));
            // Добавляем класс активному
            el.classList.add('activ_type');

            // Обновляем hidden input с id варианта
            const variantId = @json($product->variants->pluck('id'));
            document.getElementById('variant_id_input').value = variantId[index];
        });
    });*/
</script>

