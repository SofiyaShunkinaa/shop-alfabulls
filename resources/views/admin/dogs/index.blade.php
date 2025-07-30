@extends('layout.admin', ['title' => 'Все Промокода каталога'])

@section('content')
    <h1 class="dog-h1 mb-6">ЩЕНКИ</h1>
    <div class="p-4 table-con" style="overflow-x: auto; width: 100%;">
    <table class="table-bordered" style="width:100%">
        <thead class="table-header">
            <tr style="background-color: #9A9A9A;">
				<th class="table-cell">Фото</th>
                <th class="table-cell">Название</th>
                <th class="table-cell">Описание</th>

                <th class="table-cell">Порода</th>

                <th class="table-cell">Цена</th>

                <th class="table-cell">Редактировать</th>
                <th class="table-cell">Архив</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr class="table-row" id="row-{{ $product->id }}">
				<td class="table-cell" data-field="image">
                    <div class="w-12 h-12 bg-gray-200 rounded overflow-hidden mx-auto"style="display: flex; align-items: center; justify-content: center;">
                        @php
                        
                            $firstImage = $product->images->first();
                        @endphp

                        @if ($firstImage)
                            <img src="{{ asset('storage/' . $firstImage->path) }}" alt="Фото щенка" style="max-width: 100px; max-height: 100px;">
                        @else
                            <img src="/images/default.jpg" alt="Фото по умолчанию" style="max-width: 100px; max-height: 100px;">
                        @endif
                    </div>
                </td>
                <td class="table-cell" data-field="name">{{ $product->name }}</td>
                
                <td class="table-cell text-left text-sm" data-field="opis">
                     {{ iconv_substr($product->opis, 0, 150) }}</td>
                

                
                <td class="table-cell" data-field="type">{{ $product->type }}</td>
                


                
                <td class="table-cell" style="white-space: nowrap;" data-field="pric">{{ $product->pric }} ₽</td>

                
                <td class="table-cell">
                    <a href="{{ route('admin.dogs.edit', ['dog' => $product->id]) }}" class="edit-button">Редактировать</a>
                    <!-- <button class="edit-button" onclick="toggleEditMode({{ $product->id }})">Редактировать</button>
                    <div class="edit-controls" style="display: none;">
                        <button class="save-button" onclick="saveChanges({{ $product->id }})">Сохранить</button>
                    </div> -->
                </td>
                
                <td class="table-cell">
                    <form action="{{ route('admin.dogs.destroy', ['dog' => $product->id]) }}"
                      method="post" onsubmit="return confirm('Удалить этого щенка?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button"><i class="ri-delete-bin-line ri-lg"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
		<div class="flex justify-end mt-6" style="display: flex; margin-top:26px">
			<a href="{{ route('admin.dogs.create') }}" class="add-button" style="margin-left: auto;">Добавить щенка</a>
		</div>
	</div>
    <div class="py-6">
        {{ $products->links() }}
    </div>
@endsection


<script>
    function toggleEditMode(productId) {
        const row = document.getElementById(`row-${productId}`);
        const cells = row.querySelectorAll('[data-field]');
        const editButton = row.querySelector('.edit-button');
        const editControls = row.querySelector('.edit-controls');

        cells.forEach(cell => {
            const fieldName = cell.getAttribute('data-field');
            const currentValue = cell.textContent.trim().replace('₽', '').trim();
            
            switch(fieldName) {
                case 'name':
                case 'type':
                case 'pric':
                case 'discount':
                    cell.innerHTML = `<input type="text" class="form-control" name="${fieldName}" value="${currentValue}">`;
                    break;
                case 'date':
                    cell.innerHTML = `<input type="date" class="form-control" name="${fieldName}" value="${currentValue}">`;
                    break;
                case 'opis':
                    cell.innerHTML = `<textarea class="form-control" name="${fieldName}" rows="4">${currentValue}</textarea>`;
                    break;
                case 'image':
                    const imgElement = cell.querySelector('img');
                    const imgSrc = imgElement ? imgElement.src : '';
                    const hasExistingImage = imgSrc.includes('storage');
                    
                    cell.innerHTML = `
                        <div class="puppy-image-upload-container">
                            <label for="puppy-upload-${productId}" class="puppy-image-upload-label">
                                <div class="puppy-image-wrapper w-12 h-12">
                                    <img src="${imgSrc}" 
                                         alt="Фото щенка" 
                                         class="puppy-image-preview"
                                         id="puppy-preview-${productId}"
                                         data-original-src="${imgSrc}"/>
                                    
                                    ${hasExistingImage ? `
                                    <label for="puppy-remove-${productId}" class="puppy-image-remove-label">
                                        <i class="fas fa-trash-alt"></i>
                                    </label>
                                    <input type="checkbox" 
                                           id="puppy-remove-${productId}" 
                                           hidden
                                           class="puppy-image-remove-checkbox" 
                                           name="remove_image"
                                           onchange="handleRemovePuppyImage(this, 'puppy-preview-${productId}')">
                                    ` : ''}
                                </div>
                                <div class="puppy-image-upload-overlay">
                                    <i class="fas fa-camera"></i>
                                </div>
                            </label>
                            <input type="file" 
                                   id="puppy-upload-${productId}" 
                                   class="d-none" 
                                   name="image" 
                                   accept="image/png,image/jpeg"
                                   onchange="previewPuppyImage(this, 'puppy-preview-${productId}')">
                        </div>
                    `;
                    break;
                case 'video':
                    cell.innerHTML = `<textarea class="form-control" name="${fieldName}" rows="4">${currentValue}</textarea>`;
                    break;
            }
        });

        editButton.style.display = 'none';
        editControls.style.display = 'block';
    }

    // Функции для работы с изображениями щенков
    function handleRemovePuppyImage(checkbox, previewId) {
        const preview = document.getElementById(previewId);
        if (checkbox.checked) {
            preview.src = '/images/default-puppy.jpg';
        } else {
            preview.src = preview.dataset.originalSrc;
        }
    }

    function previewPuppyImage(input, previewId) {
        const preview = document.getElementById(previewId);
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            const removeCheckbox = input.closest('.puppy-image-upload-container').querySelector('input[name="remove_image"]');
            if (removeCheckbox) {
                removeCheckbox.checked = false;
            }
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    async function saveChanges(productId) {
        const row = document.getElementById(`row-${productId}`);
        const formData = new FormData();
        
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('_method', 'PUT');

        // Собираем данные из всех полей
        row.querySelectorAll('[data-field]').forEach(cell => {
            const fieldName = cell.getAttribute('data-field');
            const input = cell.querySelector('input:not([type="file"]), textarea, select');
            
            if (input) {
                formData.append(input.name, input.value);
            }
            
            // Обрабатываем файл изображения отдельно
            const fileInput = cell.querySelector('input[type="file"]');
            if (fileInput && fileInput.files[0]) {
                formData.append('image', fileInput.files[0]);
            }
            
            // Обрабатываем чекбокс удаления изображения
            if (fieldName === 'image') {
                const removeCheckbox = cell.querySelector('input[name="remove_image"]');
                if (removeCheckbox && removeCheckbox.checked) {
                    formData.append('remove_image', '1');
                }
            }
        });

        try {
            const response = await fetch(`/admin/dogs/${productId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            if (response.ok) {
                location.reload();
            } else {
                if (data.errors) {
                    showValidationErrors(data.errors);
                } else {
                    alert(data.message || 'Ошибка при сохранении');
                }
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Ошибка сети при сохранении');
        }
    }

    function cancelEdit(productId) {
        location.reload();
    }
</script>

<style>
.puppy-image-upload-container {
    position: relative;
    text-align: center;
    margin: 0 auto;
    width: fit-content;
}

.puppy-image-upload-label {
    position: relative;
    display: inline-block;
    cursor: pointer;
    border-radius: 6px;
}

.puppy-image-wrapper {
    background-color: #f5f5f5;
    border-radius: 6px;
    position: relative;
}

.puppy-image-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.puppy-image-upload-overlay {
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

.puppy-image-upload-label:hover .puppy-image-upload-overlay {
    opacity: 1;
}

.puppy-image-upload-overlay i {
    font-size: 20px;
    color: #fff;
    text-shadow: 0 1px 2px rgba(0,0,0,0.3);
}

.puppy-image-upload-overlay span {
    font-size: 12px;
    color: #fff;
    margin-top: 5px;
    text-shadow: 0 1px 2px rgba(0,0,0,0.3);
}

.puppy-image-remove-label {
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

.puppy-image-remove-label:hover {
    background: rgba(255, 50, 50, 1);
}

.puppy-image-remove-label i {
    font-size: 12px;
    color: #fff;
}

.puppy-image-remove-checkbox {
    display: none;
}
</style>