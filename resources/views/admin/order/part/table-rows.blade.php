 <div class="table-con p-3" style="overflow-x: auto;">        

        
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
                    <th class="table-cell">Адрес</th>
                    <th class="table-cell">Сумма доставки</th>
                    <th class="table-cell">Скидка</th>

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
                        {{ $order->address }}
                    </td>
                    <td class="table-cell">
                        {{ $order->delivery_amount }} ₽
                    </td>
                    <td class="table-cell">
                        {{ $order->discount_amount ?? '0' }} ₽
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
        {{ $orders->appends(request()->query())->links() }}
    </div>                   
    

