@extends('layout.admin', ['title' => 'Все Промокода каталога'])

@section('content')
    <h1 class="dog-h1 mb-4">Промокоды</h1>

    <div class="p-4 table-con">
        <div class="mb-3">
            <div class="d-flex" style="background-color: #868686; width: max-content; border-radius: 10px;">
            <a href="{{ route('admin.promo.index') }}" class="butn {{ !$showArchived ? 'active' : '' }}"
            style="background-color: {{ !$showArchived ? '#fff' : '#A6A6A6' }}; color: {{ !$showArchived ? '#505050' : '#FFFFFF' }}; border-radius: 10px;">
                Активные
            </a>
            <a href="{{ route('admin.promo.index', ['archived' => 1]) }}" class="butn {{ !$showArchived ? 'active' : '' }}"
            style="background-color: {{ $showArchived ? '#fff' : '#868686' }}; color: {{ $showArchived ? '#505050' : '#  ' }}; border-radius: 0 10px 10px 0;">
                Архив
            </a>
            </div>
        </div>
        
        <div style="overflow-x: auto; width: 100%;">
            <table class="table-bordered" style="min-width: 100%; white-space: nowrap;">
                <thead class="table-header">
                    <tr style="background-color: #9A9A9A;">
                        <th class="table-cell">Промокод</th>
                        <th class="table-cell">Начальная дата</th>
                        <th class="table-cell">Конечная дата</th>
                        <th class="table-cell">Скидка</th>

                       @if(!$showArchived)
                        <th class="table-cell">Редактировать</th>
                        <th class="table-cell">Активация</th>
                        <th class="table-cell">Архив</th>
                      @endif

                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    @php
                        $startDate = \Carbon\Carbon::parse($product->datastart);
                        $endDate = \Carbon\Carbon::parse($product->datastop);
                    @endphp
                    <tr class="table-row" id="row-{{ $product->id }}">
                        <td class="table-cell" data-field="name">{{ $product->name }}</td>
                        <td class="table-cell" data-field="datastart">{{ $startDate->format('d.m.Y') }}</td>
                        <td class="table-cell" data-field="datastop">{{ $endDate->format('d.m.Y') }}</td>
                        <td class="table-cell" data-field="pric">{{ $product->pric }} ₽</td>

                         @if(!$showArchived)
                        <td class="table-cell">
                            <button class="edit-button" onclick="toggleEditMode({{ $product->id }})">Редактировать</button>
                            <div class="edit-controls" style="display: none;">
                                <button class="save-button" onclick="saveChanges({{ $product->id }})">Сохранить</button>
                            </div>
                        </td>
                        <td class="table-cell">
                            <form action="{{ route('admin.promo.active', ['promo' => $product->id]) }}"
                                method="post">
                                @csrf
                                @method('PATCH')

                                @if($product->active == 0)
                                <button class="edit-button" style="background-color:rgba(156, 255, 214, 1)">Активировать</button>
                                @else  
                                <button class="edit-button" style="background-color:rgba(255, 189, 156, 1)">Остановить</button>
                                @endif
                            </form>
                            
                            
                        </td>
                        <td class="table-cell">
                            <form action="{{ route('admin.promo.archive', ['promo' => $product->id]) }}"
                                method="post"
                                    @if (!$showArchived)
                                        onsubmit="return confirm('Переместить промокод в архив?')"
                                    @else
                                        onsubmit="return confirm('Восстановить промокод из архива?')"
                                    @endif
                                >
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="delete-button">
                                    <i class="ri-delete-bin-line ri-lg"></i>
                                </button>
                            </form>
                        </td>
                         @endif

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

         @if(!$showArchived)
        <div class="flex justify-end mt-6">
            <button id="add-row-button" class="add-button whitespace-nowrap !rounded-button">Добавить</button>
        </div>
        @endif
    </div>
    
    @if ($products->links())
        <div class="py-6">
            {{ $products->links() }}
        </div>
    @endif
@endsection

@section('scripts')
<script>
    function toggleEditMode(productId) {
        const row = document.getElementById(`row-${productId}`);
        const cells = row.querySelectorAll('[data-field]');
        const editButton = row.querySelector('.edit-button');
        const editControls = row.querySelector('.edit-controls');

        cells.forEach(cell => {
            const fieldName = cell.getAttribute('data-field');
            let currentValue = cell.textContent.trim();
            
            if (fieldName === 'pric') {
                currentValue = currentValue.replace('₽', '').trim();
            }
            
            switch(fieldName) {
                case 'name':
                case 'pric':
                    cell.innerHTML = `<input type="text" class="form-control" name="${fieldName}" value="${currentValue}">`;
                    break;
                case 'datastart':
                case 'datastop':
                    // Преобразуем дату из формата d.m.Y в Y-m-d для input[type="date"]
                    const dateParts = currentValue.split('.');
                    const formattedDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                    cell.innerHTML = `<input type="date" class="form-control" name="${fieldName}" value="${formattedDate}">`;
                    break;
            }
        });

        editButton.style.display = 'none';
        editControls.style.display = 'block';
    }

    async function saveChanges(productId) {
        const row = document.getElementById(`row-${productId}`);
        const formData = new FormData();
        
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
        formData.append('_method', 'PUT');

        row.querySelectorAll('[data-field]').forEach(cell => {
            const fieldName = cell.getAttribute('data-field');
            const input = cell.querySelector('input');
            
            if (input) {
                // Для дат преобразуем обратно в формат Y-m-d
                if (fieldName === 'datastart' || fieldName === 'datastop') {
                    const date = new Date(input.value);
                    const formattedDate = date.toISOString().split('T')[0];
                    formData.append(fieldName, formattedDate);
                } else {
                    formData.append(fieldName, input.value);
                }
            }
        });

        formData.append('id', productId);

        try {
            const response = await fetch(`/admin/promo/${productId}`, {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                location.reload();
            } else {
                alert('Ошибка при сохранении');
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#add-row-button').on('click', function () {
        const newRow = `
        <tr class="table-row new-row">
            <td class="table-cell"><input type="text" name="name" class="form-control input-name" /></td>
            <td class="table-cell"><input type="date" name="datastart" class="form-control input-datastart" /></td>
            <td class="table-cell"><input type="date" name="datastop" class="form-control input-datastop" /></td>
            <td class="table-cell"><input type="number" name="pric" class="form-control input-pric" /></td>
            <td class="table-cell">
                <button class="save-button save-new-button" style="background-color: #baffc9;">Сохранить</button>
            </td>
            <td colspan="2"></td>
        </tr>`;
        $('table tbody').prepend(newRow);
    });

    $(document).on('click', '.save-new-button', function () {
        const row = $(this).closest('tr');
        const data = {
            name: row.find('.input-name').val(),
            datastart: row.find('.input-datastart').val(),
            datastop: row.find('.input-datastop').val(),
            pric: row.find('.input-pric').val(),
            _token: '{{ csrf_token() }}'
        };

        console.log(data);

        $.ajax({
            url: '{{ route("admin.promo.store") }}',
            type: 'POST',
            data: data,
            success: function (response) {
                location.reload(); // можно заменить на обновление DOM
            },
            error: function (xhr) {
                alert('Ошибка при сохранении');
                console.log(xhr.responseText);
            }
        });
    });
});
</script>