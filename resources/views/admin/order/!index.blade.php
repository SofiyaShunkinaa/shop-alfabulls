@extends('admin.layout.manage', ['title' => 'Покупки'])

@section('manage-content')
        <h1 class="mb-4 dog-h1">Покупки</h1>

    <div class="table-con p-3" style="overflow-x: auto;">        
        <div>
            <!-- Фильтры и поиск -->
            <div class="d-flex gap-3 mb-3">
                <input id="product-search"
                    style="align-self: center; background-color: #868686; color: #ffffff; border-radius: 7px;" 
                    class="px-3 py-2 placeholder-white" 
                    placeholder="Поиск по номеру">

            
                
                <div class="px-5 py-2 text-center align-self-center" style="background-color: #868686; border-radius: 10px;">
                    Всего: {{ $orders->total() }}
                </div>
                
            </div>
        </div>
        
        <!-- Таблица заказов -->
        <table class="table-bordered" style="width: -webkit-fill-available;">
            <thead class="table-header">
                <tr style="background-color: #9A9A9A;">
                    <th class="table-cell">№ заказа</th>
                    <th class="table-cell">Дата и время</th>
                    <th class="table-cell">Статус</th>
                    <th class="table-cell">ФИО</th>
                    <th class="table-cell">Телефон</th>
                    <th class="table-cell">Товары</th>
                    <th class="table-cell">Сумма покупки</th>
                    <th class="table-cell">Вес</th>
                    <th class="table-cell">Вид доставки</th>
                    <th class="table-cell">Сумма доставки</th>
                    <th class="table-cell">Скидка</th>
                    <th class="table-cell">Просмотр</th>
                    <th class="table-cell">Редактировать</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)

                <tr class="table-row" data-order-id="{{ $order->id }}">
                    <td class="table-cell">{{ $order->id }}</td>
                    <td class="table-cell">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td class="table-cell" data-field="status" data-value="{{ $order->status }}">
                        @php
                            $statusClasses = [
                                0 => 'orders-new',
                                1 => 'orders-processed',
                                2 => 'orders-paid',
                                3 => 'orders-delivered',
                                4 => 'orders-completed'
                            ];
                        @endphp
                       @if (isset($statusClasses[$order->status]))
                            <div class="orders-status {{ $statusClasses[$order->status] }}">{{ $statuses[$order->status] }}</div>
                        @else
                            {{ $statuses[$order->status] }}
                        @endif
                    </td>
                    <td class="table-cell" data-field="name" data-value="{{ $order->name }}">{{ $order->name }}</td>
                    <td class="table-cell" data-field="phone" data-value="{{ $order->phone }}">{{ $order->phone }}</td>
                    <td class="table-cell">
                        {{ $order->items->pluck('name')->implode(', ') }}
                    </td>
                    <td class="table-cell">
                        {{ $order->amount }} ₽
                    </td>
                    <td class="table-cell">
                        {{ $order->items->sum(function($item) {
                            // Проверяем наличие товара и его веса
                            $weight = $item->product && $item->product->weight !== null 
                                ? $item->product->weight 
                                : 0;
                            
                            // Проверяем количество
                            $quantity = $item->quantity ?? 0;
                            
                            return $quantity * $weight;
                        }) }}
                    </td>
                    <td class="table-cell">
                        {{ optional($order->delivery)->name ?? '-' }}
                    </td>
                    <td class="table-cell">
                        {{ $order->delivery_amount }} ₽
                    </td>
                    <td class="table-cell">
                        {{ $order->discount_amount ?? '0' }} ₽
                    </td>
                    <td class="table-cell">
                        <a href="{{ route('admin.order.show', ['order' => $order->id]) }}" 
                           class="view-button">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>
                    <td class="table-cell">
                        <a href="{{ route('admin.order.edit', ['order' => $order->id]) }}" 
                        class="edit-button" data-order-id="{{ $order->id }}">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
            
    </div>
    <div class="flex justify-center mt-6">
        {{ $orders->links() }}
    </div>



    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Обработчики для кнопок редактирования
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const orderId = this.getAttribute('data-order-id');
            toggleEditMode(orderId);
        });
    });

    // Функция переключения в режим редактирования
    function toggleEditMode(orderId) {
        const row = document.querySelector(`tr[data-order-id="${orderId}"]`);
        
        row.querySelector('.edit-button').style.display = 'none';
        
        if (!row.querySelector('.save-button')) {
            const saveButton = document.createElement('button');
            saveButton.className = 'save-button btn btn-sm btn-success edit-button';
            saveButton.innerHTML = '<i class="fas fa-save"></i>';
            saveButton.style.cssText = `
                margin: auto;
            `;
            saveButton.addEventListener('click', () => saveChanges(orderId));
            
            const td = row.querySelector('.table-cell:last-child');
            td.insertBefore(saveButton, td.firstChild);
        } else {
            row.querySelector('.save-button').style.display = 'inline-block';
        }
        const fields = [
            { name: 'status', type: 'select', options: {!! json_encode($statuses) !!} },
            { name: 'name', type: 'text' },
            { name: 'phone', type: 'text' },
            { name: 'email', type: 'email' },
            { name: 'address', type: 'text' },
            { name: 'comment', type: 'textarea' }
        ];

        fields.forEach(field => {
            const cell = row.querySelector(`[data-field="${field.name}"]`);
            if (!cell) return;

            const currentValue = cell.getAttribute('data-value') || cell.textContent.trim();
            
            switch(field.type) {
                case 'select':
                    cell.innerHTML = `
                        <select class="form-control form-control-sm" name="${field.name}">
                            ${Object.entries(field.options).map(([key, value]) => `
                                <option value="${key}" ${key == currentValue ? 'selected' : ''}>${value}</option>
                            `).join('')}
                        </select>
                    `;
                    break;
                    
                case 'textarea':
                    cell.innerHTML = `<textarea class="form-control form-control-sm" name="${field.name}">${currentValue}</textarea>`;
                    break;
                    
                default:
                    cell.innerHTML = `<input type="${field.type}" class="form-control form-control-sm" name="${field.name}" value="${currentValue}">`;
            }
        });
    }


    async function saveChanges(orderId) {
        const row = document.querySelector(`tr[data-order-id="${orderId}"]`);
        const formData = new FormData();
        
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
        formData.append('_method', 'PUT');

        row.querySelectorAll('[data-field]').forEach(cell => {
            const fieldName = cell.getAttribute('data-field');
            const input = cell.querySelector('input, textarea, select');
            
            if (input) {
                formData.append(fieldName, input.value);
            }
        });

        try {
            const response = await fetch(`/admin/order/${orderId}`, {
                method: 'POST',
                body: formData,
                headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });


            
            if (response.ok) {

                location.reload();
            } else {
                alert('Ошибка при сохранении: ' + (data.message || 'Неизвестная ошибка'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Ошибка сети при сохранении');
        }
    }

});

let debounceTimeout;

document.getElementById('product-search').addEventListener('input', function () {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => {
        const query = this.value.trim();

        // Формируем URL — если пусто, просто запросим без параметров, чтобы вернуть все
        let url = "{{ route('admin.order.search') }}";
        if (query.length > 0) {
            url += `?id=${encodeURIComponent(query)}`;
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
@endsection
