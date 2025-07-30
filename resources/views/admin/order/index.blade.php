@extends('admin.layout.manage', ['title' => 'Покупки'])

@section('manage-content')


<style>

    ::-webkit-calendar-picker-indicator {
  color: transparent;
  opacity: 1;
  background: none;
  background-size: contain;
}

</style>


           <div>
            <br><br>
            <form id="filter-form"  style="margin-bottom: 20px;display: flex;gap: 30px;">
                <div style="display: flex;flex-wrap: wrap;gap: 1rem;flex-direction: column;">
                    <div style="
    display: flex;
    align-items: center;
    gap: 41px;
">
                        <h1 class=" dog-h1">Покупки</h1>

                        <div class="lypa" style="
    position: relative;
">
             <input class="placeholder-white" style="    padding: 7px 18px !important;align-self:  center;     width: 462px; background-color: #868686; color: #ffffff; border-radius: 7px;" type="text" name="id" id="search-query" placeholder="Поиск" />
            <img src="/img/lypa.png" style="
    position: absolute;
    right: 12px;
    top: 8px;
">
        </div>

                    </div>

                    <div style="display: flex; gap: 20px;">
                    <div>

                        <label style="
    display: flex;
    align-items: center;
">
                        <input type="text" class="date-input placeholder-white" style="    padding: 7px 18px !important;
    width: 190px;
    align-self: center;
    border-radius: 7px 0px 0px 7px;" name="date_from" placeholder='Выбрать заказы с'>
    <span class="calendar-trigger" style="
    display: block;
    width: 38px;
    align-items: center;
    background: #A6A6A6;
    text-align: center;
    padding: 10px 0px;
    border-radius: 0px 10px 10px 0px;
    cursor:pointer;
"><img style="
    margin: auto;
" src="/img/calenadr.png"></span>
                        </label>
                    <br>
                               <label style="
    display: flex;
    align-items: center;
">
                        <input type="text" name="date_to" class=" date-input placeholder-white" style="padding: 7px 18px !important;background-co;f;width: 190px;border-radius: 7px 0px 0px 7px;" placeholder='Выбрать заказы по'>
                      <span class="calendar-trigger" style="
    display: block;
    width: 38px;
    align-items: center;
    background: #A6A6A6;
    text-align: center;
    padding: 10px 0px;
    border-radius: 0px 10px 10px 0px;
    cursor:pointer;
"><img style="
    margin: auto;
" src="/img/calenadr.png"></span>
                        </label>
                    </div>

                    <div>

                        <input type="number" name="amount_from" step="0.01" class="placeholder-white" style="    padding: 7px 18px !important; width: 230px;align-self: center; background-color: #868686; color: #ffffff; border-radius: 7px; margin-bottom: 10px; " placeholder="Сумма от">
                    <br>

                        <input type="number" name="amount_to" step="0.01" class="placeholder-white" style="    padding: 7px 18px !important;width: 230px; align-self: center; background-color: #868686; color: #ffffff; border-radius: 7px;     margin-top: 12px;" placeholder="Сумма до">
                    </div>

                    <div>

                    <script>
document.addEventListener('DOMContentLoaded', function () {
    // Настройки по-русски
    flatpickr.localize(flatpickr.l10ns.ru);

    // Инициализация всех input с классом date-input
    document.querySelectorAll('.date-input').forEach(function (input) {
        flatpickr(input, {
            dateFormat: "d.m.Y",
            locale: "ru",
            allowInput: true,
            defaultHour: 12
        });
    });

    // Открытие календаря по клику на иконку
    document.querySelectorAll('.calendar-trigger').forEach(function (icon) {
        icon.addEventListener('click', function () {
            const inputName = this.getAttribute('data-target');
            const input = document.querySelector(`input[name="${inputName}"]`);
            if (input && input._flatpickr) {
                input._flatpickr.open();
            }
        });
    });
});
</script>

                        <select name="status" class="placeholder-white" style="width: 230px; padding: 10px 18px !important;
    padding: 14px 10px;align-self: center;background-color: #868686;color: #ffffff;border-radius: 7px; margin-bottom: 10px;">
                            <option value="">Статус</option>
                            @foreach($statuses as $key => $status)
                                <option value="{{ $key }}">{{ $status }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-primary" style="    width: 230px;
    background: #B1FF87;
    border: 0px;
    box-shadow: none;
    color: #000;
       margin-top: 12px;
    padding: 13px 32px;">Показать</button>
                    </div>

                </div>
                </div>


                   <div class="order-stats" style="gap:20px; display: flex;margin-bottom: 20px;flex-wrap: wrap;">
                        <p style=" width: 200px; display: flex; flex-direction: column; flex-wrap: wrap;">
                            <span id="zacCount" style="    font-size: 54px; font-weight: 800;    line-height: 1;">{{ $totalVisibleOrders }}</span>
                            <span style=" font-size: 17px;">выбрано заказов</span>
                        </p>
                        <p style=" width: 290px; display: flex; flex-direction: column; flex-wrap: wrap;">
                            <span id="zacSumm" style=" font-size: 54px; font-weight: 800;    line-height: 1;">{{ number_format($totalVisibleAmount, 0, '.', ' ') }}</span>
                            <span style=" font-size: 17px;">на сумму, руб</span>
                        </p>
                        <p style=" width: 200px; display: flex; flex-direction: column; flex-wrap: wrap;">
                            <span style=" font-size: 54px; font-weight: 800;    line-height: 1;">{{ $completedCount }}</span>
                            <span style=" font-size: 17px;">выполнено за 30 дней</span>
                        </p>
                        <p style="width: 290px; display: flex; flex-direction: column; flex-wrap: wrap;">
                            <span style=" font-size: 54px; font-weight: 800;    line-height: 1;">{{ number_format($completedAmount, 0, '.', ' ') }}</span>
                            <span style=" font-size: 17px;">на сумму, руб</span>
                        </p>
                    </div>
            </form>

        </div>


    <div id="tableBody">

    </div>



    <script>
document.addEventListener('DOMContentLoaded', function() {
    

});

$(window).on('load', function () {
    let debounceTimer;
loadOrders();
    // Поиск по тексту с debounce
    $('#search-query').on('input', function () {
        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(function () {
            $('#filter-form').submit(); // триггерим форму с фильтрами
        }, 500);
    });

    // Пагинация
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href'); 
        console.log(url);
        loadOrders(url);
    });


    function loadOrders(url = "{{ route('admin.order.search') }}") {
        const formData = $('#filter-form').serialize();

        $.ajax({
            url: url,
            type: "GET",
            data: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
                console.log(response);
                $('#tableBody').html(response.html); // Обновляем таблицу
                if(response.totalOrders != 0){
                    $('#zacCount').text(response.totalOrders); // Обновляем кол-во заказов
                }
                if(response.totalAmount != 0){
                    $('#zacSumm').text(response.totalAmount);  // Обновляем сумму заказов
                }
            },
            error: function (xhr) {
                console.error('Ошибка:', xhr.responseText);
            }
        });
    }

    // Обработка формы фильтров
    $('#filter-form').on('submit', function (e) {
        e.preventDefault();
        loadOrders();
        
    });

// Обработчики для кнопок редактирования
    $(document).on('click', '.edit-button', function(e) {
        e.preventDefault();
        const orderId = $(this).data('order-id');
        toggleEditMode(orderId);
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

// function updateOrderStats() {
//     const formData = $('#filter-form').serialize(); // если хочешь учитывать фильтры

//     $.ajax({
//         url: "{{ route('admin.order.stats') }}",
//         type: "GET",
//         data: formData,
//         headers: {
//             'X-Requested-With': 'XMLHttpRequest',
//             'X-CSRF-TOKEN': '{{ csrf_token() }}'
//         },
//         success: function (data) {
//             $('#zacCount').text(data.totalVisibleOrders);
//             $('#zacSumm').text(data.totalVisibleAmount);

//         },
//         error: function (xhr) {
//             console.error('Ошибка при получении статистики:', xhr.responseText);
//         }
//     });
// }


// // или при фильтрации:
// $('#filter-form').on('submit', function (e) {
//     e.preventDefault();
//     updateOrderStats(); // после отправки фильтра — обновим статистику
// });



</script>

<!-- Раскрытие дополнительной информации -->
 <script>
document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.querySelector('tbody');

    // Делегируем клики всему <tbody>
    tbody.addEventListener('click', async (e) => {
        const row = e.target.closest('tr.table-row');
        if (!row) return;                       // кликнули мимо строк заказа

        const orderId = row.dataset.orderId;
        const next = row.nextElementSibling;

        // Если соседняя строка ‒ уже блок деталей → просто свернуть/развернуть
        if (next && next.classList.contains('details-row')) {
            next.style.display = next.style.display === 'none' ? 'table-row' : 'none';
            return;
        }

        // Первый клик: создаём <tr>, загружаем контент и вставляем
        const detailsRow = document.createElement('tr');
        detailsRow.className = 'details-row';         // для возможного оформления

        // единая ячейка на всю ширину таблицы
        const cell = document.createElement('td');
        cell.colSpan = row.children.length;
        cell.innerHTML = '<div style="padding:1rem">Загрузка…</div>';
        detailsRow.appendChild(cell);
        row.after(detailsRow);

        try {
            const resp = await fetch(`{{ url('/admin/orders') }}/${orderId}/details`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            if (!resp.ok) throw new Error(resp.statusText);
            cell.innerHTML = await resp.text();       // подменяем «Загрузка…» реальными данными
        } catch (err) {
            cell.innerHTML = '<div style="color:#d00">Ошибка загрузки деталей</div>';
            console.error(err);
        }
    });
});
</script>
<style>
    .details-row td {
    background:rgb(43, 40, 40);
    border-top: none;          /* чтобы визуально «слиялось» с основной строкой */
    }

    .table-row:hover {
        cursor: pointer;           /* подсказываем, что строка кликабельна */
        background: rgb(238 238 255 / 25%);          /* лёгкий ховер-эффект */
    }

    .flatpickr-current-month .flatpickr-monthDropdown-months {
        background:transparent !important;
        color:black !important;
    }
    .flatpickr-current-month input.cur-year {
        padding:0px !important;
        background:transparent !important;
        color:black !important;
    }
</style>



<script type="text/javascript">
//     const input = document.querySelector('.date-input');

// input.addEventListener('focus', function(){
//   this.type = 'date';
//   $(this).trigger('click');
// });
// input.addEventListener('blur', function(){
//   if(this.value === '') {
//     this.type = 'text';
//   }
// });
</script>
@endsection
