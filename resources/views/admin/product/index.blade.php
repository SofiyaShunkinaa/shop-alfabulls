@extends('admin.layout.manage', ['title' => 'Все товары каталога'])

@section('manage-content')
    <h1 class="mb-4 dog-h1">Товары</h1>
        <div class="table-con p-3" style="overflow-x: hidden;">
        <div class="mb-3">
            <div class="d-flex" style="background-color: #868686; width: max-content; border-radius: 10px;">
            <a href="{{ route('admin.product.index') }}" class="butn {{ $showArchived ? 'active' : '' }}"
            style="background-color: {{ $showArchived ? '#fff' : '#A6A6A6' }}; color: {{ $showArchived ? '#505050' : '#FFFFFF' }}; border-radius: 10px;">
                Активные
            </a>
            <a href="{{ route('admin.product.index', ['archived' => 0]) }}" class="butn {{ !$showArchived ? 'active' : '' }}"
            style="background-color: {{ !$showArchived ? '#fff' : '#868686' }}; color: {{ !$showArchived ? '#505050' : '#  ' }}; border-radius: 0 10px 10px 0;">
                Архив
            </a>
            </div>
        </div>
        
        <div style="width: max-content;">
            <!-- Фильтры и поиск -->
            <div class="d-flex gap-3 mb-4">
                <div class="d-grid gap-3">
                <div class="dog-h2 text-[25px] font-bold">Поиск</div>
                <input id="product-search"
                    style="align-self: center; background-color: #868686; color: #ffffff; border-radius: 7px;" 
                    class="px-3 py-2 placeholder-white" 
                    placeholder="Название товара">
                </div>
                
                <div class="d-grid gap-3">
                    <div class="dog-h2 text-[25px] font-bold">Скидка на всю категорию</div>
                <div class="d-flex gap-3">            
                    <div class="dropdown">
                        <button class="px-5 py-2 text-center dropdown-toggle align-self-center" 
                                style="background-color: #868686; border-radius: 10px;" 
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Выбрать категорию
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($roots as $root)
                                <li><a id="catList" class="dropdown-item" href="#" data-id="{{ $root->id }}">{{ $root->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                
                <input id="catSale" type="number" style="align-self: center; background-color: #868686; color: #ffffff; border-radius: 7px; max-width: 106px; text-align: center;" 
                       value="" class="px-3 py-2 placeholder-white" placeholder="0%"> 

                
                
                <button id="buttonCatSale" class="px-5 py-2 text-center align-self-center font-bold" style="background-color: #9CC3FF; border-radius: 10px; color: #695B4B;">
                    Редактировать
                </button>
                </div>
                </div>
            </div>
            
            <!-- Категории -->
            <div class="d-flex gap-2 pb-3 mb-1" style="overflow: auto;">
                @foreach ($roots as $root)
                <a href="{{ route('admin.product.category', ['category' => $root->id]) }}" class="category-btn">
                    {{ $root->name }}
                </a>
                @endforeach
            </div>
        </div>
        <div id="products-table">
            
@include('admin.product.part.table-rows', ['products' => $products])


</div>
        <!-- Кнопка добавления -->
        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.product.create') }}" class="add-button whitespace-nowrap !rounded-button">
                Добавить товар
            </a>
        </div>
    </div>

<script>
    // Функция переключения в режим редактирования
    function toggleEditMode(productId) {
        const row = document.getElementById(`row-${productId}`);
        const editButton = row.querySelector('.edit-button');
        const saveButton = row.querySelector('.save-button');
        
        editButton.style.display = 'none';
        saveButton.style.display = 'inline-block';
        
        row.querySelectorAll('[data-field]').forEach(cell => {
            const fieldName = cell.getAttribute('data-field');
            let currentValue = cell.textContent.trim();
            
            // Очистка значений от лишних символов
            if (fieldName === 'price' || fieldName === 'oldprice') {
                currentValue = currentValue.replace('₽', '').trim();
            } else if (fieldName === 'col') {
                currentValue = currentValue.replace('шт', '').trim();
            }

            if (fieldName === 'brand_id' || fieldName === 'category_id') {
                currentValue = cell.getAttribute('data-select-id');
            }
            
            switch(fieldName) {
                case 'name':
                case 'width':
                case 'height':
                case 'depth':
                case 'weight':
                case 'slug':
                case 'price':
                case 'oldprice':
                case 'col':
                    cell.innerHTML = `<input type="text" class="form-control" name="${fieldName}" value="${currentValue}">`;
                    break;

                case 'brand_id':
                    const brands = {!! json_encode($brands->pluck('name', 'id')) !!};
                    cell.innerHTML = `
                        <select class="form-control" name="brand_id">
                            <option value="">Выберите бренд</option>
                            ${Object.entries(brands).map(([id, name]) => `
                                <option value="${id}" ${id == currentValue ? 'selected' : ''}>${name}</option>
                            `).join('')}
                        </select>
                    `;
                    break;

                case 'category_id':
                    const categories = {!! json_encode($items->pluck('name', 'id')) !!};
                    cell.innerHTML = `
                        <select class="form-control" name="category_id">
                            <option value="">Выберите категорию</option>
                            ${Object.entries(categories).map(([id, name]) => `
                                <option value="${id}" ${id == currentValue ? 'selected' : ''}>${name}</option>
                            `).join('')}
                        </select>
                    `;
                    break;
                
                case 'sticker':
                    const hitChecked = cell.querySelector('[data-sticker-type="hit"]') !== null;
                    const newChecked = cell.querySelector('[data-sticker-type="new"]') !== null;
                    const saleChecked = cell.querySelector('[data-sticker-type="sale"]') !== null;
                    
                    cell.innerHTML = `
                        <div class="sticker-checkboxes" style="white-space: nowrap; display: flex; flex-direction: column; align-items: flex-start; gap: 10px;">
                            <label class="sticker-checkbox">
                                <input type="checkbox" name="hit" ${hitChecked ? 'checked' : ''}>
                                Хит
                            </label>
                            <label class="sticker-checkbox">
                                <input type="checkbox" name="new" ${newChecked ? 'checked' : ''}>
                                Новый
                            </label>
                            <label class="sticker-checkbox">
                                <input type="checkbox" name="sale" ${saleChecked ? 'checked' : ''}>
                                Распродажа
                            </label>
                        </div>
                    `;
                    break;

                case 'image': {
                    const imgElement = cell.querySelector('img');
                    const imgSrc = imgElement ? imgElement.src : '';
                    const hasExistingImage = imgSrc.includes('storage');
                    
                cell.innerHTML = `
                    <div class="product-image-upload-container">
                        <label for="product-upload-${productId}" class="product-image-upload-label">
                            <div class="product-image-wrapper w-12 h-12">
                                <img src="${imgSrc}" 
                                    alt="Фото товара" 
                                    class="product-image-preview"
                                    id="product-preview-${productId}"
                                    data-original-src="${imgSrc}"/>
                                
                                ${hasExistingImage ? `
                                <label for="product-remove-${productId}" class="product-image-remove-label">
                                    <i class="fas fa-trash-alt"></i>
                                </label>
                                <input type="checkbox" 
                                    hidden
                                    id="product-remove-${productId}" 
                                    class="product-image-remove-checkbox" 
                                    name="remove_image"
                                    onchange="handleRemoveProductImage(this, 'product-preview-${productId}')">
                                ` : ''}
                            </div>
                            <div class="product-image-upload-overlay">
                                <i class="fas fa-camera"></i>
                            </div>
                        </label>
                        <input type="file" 
                            id="product-upload-${productId}" 
                            class="d-none" 
                            name="image" 
                            accept="image/png,image/jpeg,image/jpg"
                            onchange="previewProductImage(this, 'product-preview-${productId}')">
                    </div>
                `;
                    break;
                }
                
                case 'content':
                    cell.innerHTML = `<textarea class="form-control" name="${fieldName}">${currentValue}</textarea>`;
                    break;
            }
        });
    }

    // Функции для работы с изображениями
    function handleRemoveProductImage(checkbox, previewId) {
        const preview = document.getElementById(previewId);
        if (checkbox.checked) {
            preview.src = '/images/default.jpg';
        } else {
            preview.src = preview.dataset.originalSrc;
        }
    }

    function previewProductImage(input, previewId) {
        const preview = document.getElementById(previewId);
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            const removeCheckbox = input.closest('.avatar-upload-container').querySelector('input[name="remove_image"]');
            if (removeCheckbox) {
                removeCheckbox.checked = false;
            }
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    // Функция сохранения изменений
    async function saveChanges(productId) {
        const row = document.getElementById(`row-${productId}`);
        const formData = new FormData();
        
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
        formData.append('_method', 'PUT');

        // Собираем данные из всех полей
        row.querySelectorAll('[data-field]').forEach(cell => {
            const fieldName = cell.getAttribute('data-field');
            
            if (fieldName === 'sticker') {
                // Обработка чекбоксов стикеров
                const checkboxes = cell.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach(checkbox => {
                    formData.append(checkbox.name, checkbox.checked ? '1' : '0');
                });
            } 
            else if (fieldName === 'image') {
                // Обработка изображения
                const fileInput = cell.querySelector('input[type="file"]');
                const removeCheckbox = cell.querySelector('input[name="remove_image"]');
                
                if (removeCheckbox && removeCheckbox.checked) {
                    formData.append('remove_image', '1');
                }
                if (fileInput && fileInput.files[0]) {
                    formData.append('image', fileInput.files[0]);
                }
            }
            else {
                // Обработка обычных полей
                const input = cell.querySelector('input, textarea, select');
                if (input) {
                    const value = input.type === 'checkbox' ? (input.checked ? '1' : '0') : input.value;
                    formData.append(input.name, value);
                }
            }
        });

        try {
            const response = await fetch(`/admin/product/${productId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            
            if (response.ok) {
                location.reload();
            } else {
                if (data.errors) {
                    alert(data.message || 'Ошибка при сохранении');
                } else {
                    alert(data.message || 'Ошибка при сохранении');
                }
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Ошибка сети при сохранении');
        }
    }

let debounceTimeout;

$('#product-search').on('input', function () {
    const $input = $(this);
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(function () {
        loadProducts(); // Загружаем с текущим поиском
    }, 500);
});

// Основная функция загрузки продуктов
function loadProducts(url = null) {
    const query = $('#product-search').val().trim();
    const showArchived = {{ $showArchived ? 1 : 0 }};

    // Если нет URL — формируем вручную
    if (!url) {
        url = `/admin/product/search?archived=${showArchived}`;
        if (query.length > 0) {
            url += `&name=${encodeURIComponent(query)}`;
        }
    } else {
        // Добавим параметры поиска в URL пагинации
        const urlObj = new URL(url, window.location.origin);
        urlObj.searchParams.set('archived', showArchived);
        if (query.length > 0) {
            urlObj.searchParams.set('name', query);
        } else {
            urlObj.searchParams.delete('name');
        }
        url = urlObj.toString();
    }

    $.ajax({
        url: url,
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function (html) {
            $('#products-table').html('');
            $('#products-table').html(html);
        },
        error: function (xhr) {
            console.error('Ошибка при загрузке продуктов:', xhr.responseText);
        }
    });
}

// Пагинация
$(document).on('click', '.pagination a', function (e) {
    e.preventDefault();
    const url = $(this).attr('href');
    loadProducts(url);
});
</script>

<script>
$(document).ready(function () {
    let selectedCategoryId = null;

    // При выборе категории
    $('.dropdown-item').on('click', function (e) {
        e.preventDefault();
        selectedCategoryId = $(this).data('id');
        let categoryName = $(this).text();
        $('.dropdown-toggle').text(categoryName); // Меняем надпись на кнопке

        // Получаем текущую скидку
        $.ajax({
            url: '/admin/category/get-category-sale/' + selectedCategoryId,
            method: 'GET',
            success: function (response) {
                $('#catSale').val(response.sale + '%');
                $('#catSale').attr('placeholder', response.sale + '%');
            },
            error: function () {
                alert('Ошибка при получении скидки');
            }
        });
    });

    // При клике на кнопку редактирования
    $('#buttonCatSale').on('click', function () {
        if (!selectedCategoryId) {
            alert('Выберите категорию');
            return;
        }

        let saleValue = $('#catSale').val().replace('%', '');

        $.ajax({
            url: '/admin/category/update-category-sale',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                category_id: selectedCategoryId,
                sale: saleValue
            },
            success: function () {
                alert('Скидка обновлена!');
            },
            error: function () {
                alert('Ошибка при обновлении скидки');
            }
        });
    });
});
</script>

<style>
.product-image-upload-container {
    position: relative;
    text-align: center;
    margin: 0 auto;
    width: fit-content;
}

.product-image-upload-label {
    position: relative;
    display: inline-block;
    cursor: pointer;
    border-radius: 6px;
}

.product-image-upload-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 6px;
}

.product-image-upload-label:hover .product-image-upload-overlay {
    opacity: 1;
}

.product-image-upload-overlay i {
    font-size: 20px;
    color: #fff;
    text-shadow: 0 1px 2px rgba(0,0,0,0.3);
}

.product-image-upload-overlay span {
    font-size: 12px;
    color: #fff;
    margin-top: 5px;
    text-shadow: 0 1px 2px rgba(0,0,0,0.3);
}

.product-image-remove-label {
    position: absolute;
    top: -8px;
    right: -8px;
    background: rgba(255, 0, 0, 0.8);
    color: white;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    border: 2px solid #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    transition: all 0.2s ease;
}

.product-image-remove-label:hover {
    background: rgba(255, 50, 50, 1);
}

.product-image-remove-label i {
    font-size: 12px;
    color: #fff;
}

.product-image-remove-checkbox {
    display: none;
}

.product-image-wrapper {
    background-color: #f5f5f5;
    border-radius: 6px;
    position: relative;
}

.product-image-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
    border-radius: 6px;
}
</style>
@endsection
