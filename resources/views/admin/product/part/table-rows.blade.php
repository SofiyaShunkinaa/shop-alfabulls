        <!-- Таблица товаров -->
        <table class="table-bordered" style="width: -webkit-fill-available;">
    <thead class="table-header">
        <tr style="background-color: #9A9A9A;">
            <th class="table-cell">Фото</th>
            <th class="table-cell">Наименование товара</th>
           <!-- <th class="table-cell">ЧПУ</th>
            <th class="table-cell">Бренд</th>
            <th class="table-cell">Категория</th>-->
            <th class="table-cell">Описание</th>
            <th class="table-cell">Габариты</th>
            <th class="table-cell">Вес</th>
            <th class="table-cell">Стикер</th>            
            <th class="table-cell">Кол-во</th>
            <th class="table-cell">Цена</th>
            <th class="table-cell">Старая цена</th>
            <th class="table-cell">Скидка</th>
            <th class="table-cell">Редактировать</th>
            <th class="table-cell">Архив</th>
        </tr>
    </thead>
    <tbody>   
        @foreach ($products as $product)
    @php
        $variant = $product->variants->first(); // Получаем первый вариант
    @endphp
    <tr class="table-row" id="row-{{ $product->id }}">
        <td class="table-cell" data-field="image">
            @if($variant && $variant->images->count())
                @foreach ($variant->images as $image)
                    <div class="w-12 h-12 bg-gray-200 rounded overflow-hidden mx-auto mb-1" style="display:flex; justify-content: center;">
                        <img src="{{ $image ? asset('storage/catalog/product/source/' . $image->path) : '/images/default.jpg' }}" 
                             alt="Изображение товара" 
                             class="h-full object-top"/>
                    </div>
                @endforeach
            @else
                <div class="w-12 h-12 bg-gray-200 rounded overflow-hidden mx-auto">
                    <img src="{{ asset('images/default.jpg') }}" 
                         alt="Изображение товара" 
                         class="w-full h-full object-cover object-top"/>
                </div>
            @endif
        </td>

        <td class="table-cell" data-field="name">
            <!-- <a href="{{ route('admin.product.show', ['product' => $product->id]) }}"> -->
                {{ $product->name }}
            <!-- </a> -->
        </td>

        <td class="table-cell text-sm text-break" data-field="content" style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            {{ iconv_substr($product->content, 0, 150) }}
        </td>

        <td class="table-cell">
            @if ($variant)
                <span data-field="width">{{ $variant->width }}</span>х
                <span data-field="height">{{ $variant->height }}</span>х
                <span data-field="length">{{ $variant->length }}</span>
            @else
                <span>-</span>
            @endif
        </td>

        <td class="table-cell" data-field="weight">
            {{ $variant->weight ?? '-' }}
        </td>

        <td class="table-cell" data-field="sticker">
            @if ($product->hit)
                <span data-sticker-type="hit">Хит</span>
            @endif
            @if ($product->new)
                <span data-sticker-type="new">Новый</span>
            @endif
            @if ($product->sale)
                <span data-sticker-type="sale">Распродажа</span>
            @endif
        </td>

        <td class="table-cell" data-field="col">
            {{ $variant->stock ?? '-' }} шт
        </td>

        <td class="table-cell" data-field="price">
            {{ $variant->price ?? '-' }} ₽
        </td>

        <td class="table-cell" data-field="oldprice">
            {{ $variant->oldprice ?? '-' }} ₽
        </td>

        <td class="table-cell">
            {{ $product->category->sale ?? 0 }}%
        </td>

        <td class="table-cell">
            <a href="{{ route('admin.product.edit', ['product' => $product->id]) }}" class="edit-button font-bold">
                Редактировать
            </a>
            <!-- <button class="edit-button font-bold" onclick="toggleEditMode({{ $product->id }})">Редактировать</button>
            <button class="save-button font-bold" onclick="saveChanges({{ $product->id }})" style="display: none;">Сохранить</button> -->
        </td>

        <td class="table-cell">
            <form class="d-flex"
                  action="{{ route('admin.product.archive', ['product' => $product->id]) }}"
                  method="POST"
                  onsubmit="return confirm('{{ $showArchived ? 'Переместить товар в архив?' : 'Восстановить товар из архива?' }}')">
                @csrf
                @method('PATCH')
                <button type="submit" class="delete-button w-8 h-8 flex items-center justify-center" style="margin:auto;">
                    <i class="ri-delete-bin-line ri-lg"></i>
                </button>
            </form>
        </td>
    </tr>
@endforeach
    </tbody>
</table>
        
        <!-- Пагинация (внутри блока, который обновляется AJAX'ом) -->
    @if ($products->hasPages())
        <div class="py-6">
            {{ $products->links() }}
        </div>
    @endif