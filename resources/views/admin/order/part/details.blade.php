<div style="padding: 1rem;">
    <strong>Комментарий:</strong> {{ $order->comment ?? 'нет данных' }} <br>
    <strong>Состав заказа:</strong>
    <ul>
        @foreach ($order->items as $item)
            <li>{{ $item->name }} — {{ $item->quantity }} шт.</li>
        @endforeach
    </ul>
</div>
