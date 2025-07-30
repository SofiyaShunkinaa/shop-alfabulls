@extends('layout.admin', ['title' => 'Все пользователи'])

@section('content')
	<h1 class="dog-h1 mb-4">Пользователи</h1>

<div class="p-4 table-con" >

    <div class="d-flex gap-3 my-3" style="
    align-items: center;
    margin-top: 0px !important;
">

        <div class="lypa" style="
    position: relative;
">
            <input class="search-user px-3 py-2 placeholder-white" id="product-search" placeholder="Поиск"/>
            <img src="/img/lypa.png" style="
    position: absolute;
    right: 12px;
    top: 13px;
">
        </div>
        <div class="d-flex m-3" style="
    align-items: flex-end;
">
            <p class="p-c-u" style="max-width: 200px;">Всего пользователей:</p>
            <p class="p-c-u" style="font-size: 40px;line-height: 28px;">{{ $users->total() }}</p>
        </div>
    </div>
    <div style="overflow-x: auto; width: 100%;">
        <table class="table-bordered" style="min-width: 100%; white-space: nowrap;">
            <thead class="table-header">
                <tr style="background-color: #9A9A9A;">
                    <th class="table-cell">ФИО</th>
                    <th class="table-cell">Телефон</th>
                    <th class="table-cell">Почта</th>
                    <th class="table-cell">Дата Рождения</th>
                    <!--<th class="table-cell">Дата регистрации</th>-->
                    <th class="table-cell">Фото</th>
                    <th class="table-cell">Сумма покупок</th>
                    <th class="table-cell">Скидка</th>
                    <th class="table-cell">Бонусы</th>
                    <th class="table-cell">Редактировать</th>
                    <th class="table-cell">Архив</th>
                    
                </tr>
            </thead>

            <tbody>    
                @foreach ($users as $user)
                <tr class="table-row" id="row-{{ $user->id }}">
                    <td class="table-cell" data-field="name">{{ $user->name }}</td>
                    <td class="table-cell text-left text-sm" data-field="phone">{{ optional($user->profiles->first())->phone ?? '-' }}</td>
                    <td class="table-cell" data-field="email">{{ $user->email }}</td>
                     <!-- <td class="table-cell" style="white-space: nowrap;"></td> -->
                    <td class="table-cell" data-field="birthday" style="white-space: nowrap;">{{ optional($user->profiles->first())->birthday ?? '-' }}</td>
                    <td class="table-cell" @if ($user->profiles->first()) data-field="image" @endif>
                        <div class="w-12 h-12 bg-gray-200 rounded overflow-hidden mx-auto">
                            <img style="max-width: 100px; max-height:100px;"
                                 src="{{ optional($user->profiles->first())->avatar ? asset('/storage/' . $user->profiles->first()->avatar) : '/images/avatar-thumb.png' }}" 
                                 alt="Фото пользователя" 
                                 class="w-full h-full object-cover object-top"/>
                        </div>
                    </td>
                    <td class="table-cell" style="white-space: nowrap;" data-field="amount">{{ $user->orders()->get()->sum('amount') }} ₽</td>
                    <td class="table-cell" style="white-space: nowrap;" data-field="discount_percent">{{ $user->discount_percent }} %</td>
                    <td class="table-cell"style="white-space: nowrap;" data-field="bonus_points">{{ $user->bonus_points }} ₽</td>
                    <td class="table-cell">
                        <button class="edit-button" onclick="toggleEditMode({{ $user->id }})">Редактировать</button>
                        <div class="edit-controls" style="display: none;">
                            <button class="save-button" onclick="saveChanges({{ $user->id }})">Сохранить</button>
                        </div>
                    </td>
                     <td class="table-cell">
                    <form
                      method="post" onsubmit="return confirm('Удалить этого пользователя?')">

                        <button type="submit" class="delete-button"><i class="ri-delete-bin-line ri-lg"></i></button>
                    </form>
                </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Кнопка добавления -->
    <!-- <div class="flex justify-end mt-6">
        <button class="add-button whitespace-nowrap !rounded-button">Добавить</button>
    </div> -->
</div>
    <div class="py-6">
        {{ $users->links() }}
    </div>

    <script>
    function toggleEditMode(userId) {
        const row = document.getElementById(`row-${userId}`);
        const cells = row.querySelectorAll('[data-field]');
        const editButton = row.querySelector('.edit-button');
        const editControls = row.querySelector('.edit-controls');

        // Switch to edit mode
        cells.forEach(cell => {
            const fieldName = cell.getAttribute('data-field');
            const currentValue = cell.textContent.trim()
                .replace('₽', '').trim()
                .replace('%', '').trim();
            
            switch(fieldName) {
                case 'name':
                case 'email':
                case 'phone':
                case 'birthday':
                case 'discount_percent':
                case 'bonus_points':
                    cell.innerHTML = `<input type="text" class="form-control" name="${fieldName}" value="${currentValue}">`;
                    break;
                case 'date':
                    cell.innerHTML = `<input type="date" class="form-control" name="${fieldName}" value="${currentValue}">`;
                    break;
case 'image':
    const currentImgSrc = cell.querySelector('img').src;
    const hasExistingImage = currentImgSrc.includes('storage');
    
    cell.innerHTML = `
        <div class="avatar-upload-container">
            <label for="avatar-upload-${userId}" class="avatar-upload-label">
                <div class="w-12 h-12 bg-gray-200 rounded mx-auto position-relative">
                    <img style="max-width: 100px; max-height:100px;" 
                         src="${currentImgSrc}" 
                         alt="Фото пользователя" 
                         class="w-full h-full object-cover object-top"
                         id="avatar-preview-${userId}"/>
                    
                    ${hasExistingImage ? `
                    <label for="avatar-remove-${userId}" class="avatar-remove-label">
                        <i class="fas fa-trash-alt"></i>
                    </label>
                    <input type="checkbox" 
                           id="avatar-remove-${userId}" 
                           class="d-none" 
                           name="remove_image"
                           onchange="handleRemoveAvatar(this, 'avatar-preview-${userId}')">
                    ` : ''}
                </div>
                <div class="avatar-upload-overlay">
                    <i class="fas fa-camera"></i>
                </div>
            </label>
            <input type="file" 
                   id="avatar-upload-${userId}" 
                   class="d-none" 
                   name="image" 
                   accept="image/png, image/jpeg"
                   onchange="previewAvatar(this, 'avatar-preview-${userId}')">
        </div>
    `;
    break;
            }
        });

        // Toggle buttons visibility
        editButton.style.display = 'none';
        editControls.style.display = 'block';
    }

    function handleRemoveAvatar(checkbox, previewId) {
    const preview = document.getElementById(previewId);
    if (checkbox.checked) {
        preview.src = '/images/avatar-thumb.png';
    } else {
        preview.src = preview.dataset.originalSrc;
    }
}


function previewAvatar(input, previewId) {
    const preview = document.getElementById(previewId);
    const file = input.files[0];
    const reader = new FileReader();

    // Сохраняем оригинальный src
    if (!preview.dataset.originalSrc) {
        preview.dataset.originalSrc = preview.src;
    }

    reader.onload = function(e) {
        preview.src = e.target.result;
        // Сбрасываем чекбокс удаления при загрузке нового изображения
        const removeCheckbox = input.closest('.avatar-upload-container').querySelector('input[name="remove"]');
        if (removeCheckbox) {
            removeCheckbox.checked = false;
        }
    }

    if (file) {
        reader.readAsDataURL(file);
    }
}

    async function saveChanges(userId) {
        const row = document.getElementById(`row-${userId}`);
        const formData = new FormData();
        
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('_method', 'PUT');

        row.querySelectorAll('[data-field]').forEach(cell => {
            const fieldName = cell.getAttribute('data-field');
            const input = cell.querySelector('input:not([type="file"]), textarea, select');
            
            if (input) {
                // Для чекбоксов передаем '1' или '0'
                if (input.type === 'checkbox') {
                    formData.append(input.name, input.checked ? '1' : '0');
                } else if (input.type !== 'file') {
                    formData.append(input.name, input.value);
                }
            }
            
            // Обрабатываем файл отдельно
            const fileInput = cell.querySelector('input[type="file"]');
            if (fileInput && fileInput.files[0]) {
                formData.append('image', fileInput.files[0]);
            }
        });

        try {
            const response = await fetch(`/admin/user/${userId}`, {
                method: 'POST',
                body: formData,
            });

            if (response.ok) {
                location.reload();
            } else {
                alert('Ошибка при сохранении');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Ошибка при сохранении');
        }
    }

    let debounceTimeout;

document.getElementById('product-search').addEventListener('input', function () {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => {
        const query = this.value.trim();

        // Формируем URL — если пусто, просто запросим без параметров, чтобы вернуть все
        let url = "{{ route('admin.user.search') }}";
        if (query.length > 0) {
            url += `?name=${encodeURIComponent(query)}`;
        }

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.text())
        .then(html => {
            document.querySelector('tbody').innerHTML = html;
        })
        .catch(error => {
            console.error('Ошибка при поиске:', error);
        });
    }, 500);
});
</script>

<style>
.avatar-upload-container {
    position: relative;
    text-align: center;
}

.avatar-upload-label {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

.avatar-upload-overlay {
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
    transition: opacity 0.3s;
    border-radius: 6px;
    margin: auto;
}

.avatar-upload-overlay img{
    border-radius: 6px;
}

.avatar-upload-label:hover .avatar-upload-overlay {
    opacity: 1;
}

.avatar-upload-overlay i {
    font-size: 20px;
    margin-bottom: 5px;
}

.avatar-upload-overlay span {
    font-size: 12px;
}

.form-group.form-check {
    margin-top: 10px;
}
.avatar-remove-label {
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

.avatar-remove-label:hover {
    background: rgba(255, 0, 0, 0.9);
}
</style>
@endsection



