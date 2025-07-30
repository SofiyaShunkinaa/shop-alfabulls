<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Discount;
use Illuminate\Http\Request;
use Carbon\Carbon;


class OrderController extends Controller {
    /**
     * Просмотр списка заказов
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $orders = Order::orderBy('created_at', 'desc')->paginate(5);
        $statuses = Order::STATUSES;

        // Общая сумма и количество текущей выборки (страницы)
        $ordersAll = Order::orderBy('created_at', 'desc')->get();

    // Статистика по текущей выборке
    $totalVisibleOrders = $ordersAll->count();
    $totalVisibleAmount = $ordersAll->sum('amount');

        // Заказы выполненные за 30 дней
        $completedLast30Days = Order::where('status', 4)
            ->where('created_at', '>=', now()->subDays(30))
            ->get();

        $completedCount = $completedLast30Days->count();
        $completedAmount = $completedLast30Days->sum('amount');

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.order.part.table-rows', compact(
                    'orders', 'statuses',
                    'completedCount', 'completedAmount',
                    'totalVisibleOrders', 'totalVisibleAmount',
                ))->render(),
                'totalOrders' => $totalVisibleOrders,
                'totalAmount' => $totalVisibleAmount,
            ]);
        }

        return view('admin.order.index',compact('orders', 'statuses', 'totalVisibleOrders', 'totalVisibleAmount',
        'completedCount', 'completedAmount'));
    }

    /**
     * Просмотр отдельного заказа
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order) {
        $statuses = Order::STATUSES;
        return view('admin.order.show', compact('order', 'statuses'));
    }

    /**
     * Форма редактирования заказа
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order) {
        $statuses = Order::STATUSES;
        return view('admin.order.edit', compact('order', 'statuses'));
    }

    /**
     * Обновляет заказ покупателя
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order) {
        // Запоминаем текущий статус
        $old_status = $order->status;
        // Обновляем данные заказа
        $order->update($request->all());
        // Так как у статусов нет символьного обозначения, беру последний статус в списке статусов
        $funish_status = count(Order::STATUSES) - 1;
        // Если статус был изменён и это завершающий статус
        if ($old_status != $order->status && $order->status == $funish_status) {
            // Если заказ имеет юзера, то пересчитываем ему дисконт
            if ($order->user) {
                $orders_total_amount = $order->user->orders()->whereStatus($funish_status)->sum('amount');
                $discount = Discount::where('amount', '>=', $orders_total_amount)->orderBy('amount')->first();
                if ($discount) {
                    $order->user->discount_percent = $discount->percent;
                    $order->user->save();
                }
            }
        }
        return redirect()
            ->route('admin.order.show', ['order' => $order->id])
            ->with('success', 'Заказ был успешно обновлен');
    }

public function searchOrder(Request $request)
{
    $statuses = Order::STATUSES;

    $query = Order::query();

    // 🔎 Поиск по основному полю (универсальный текстовый поиск)
    if ($search = trim($request->input('id'))) {
        $query->where(function ($q) use ($search) {
            $q->where('id', 'like', "%{$search}%")
              ->orWhere('name', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%")
              ->orWhere('address', 'like', "%{$search}%")
              ->orWhereHas('items', function ($q2) use ($search) {
                  $q2->where('name', 'like', "%{$search}%");
              });
        });
    }
//dd($request->input('date_from')); 
    // 📆 Фильтрация по дате
    if ($request->filled('date_from')) {
        $from = Carbon::createFromFormat('d.m.Y', $request->input('date_from'))->startOfDay();
        $query->whereDate('created_at', '>=', $from);
    }

    if ($request->filled('date_to')) {
        $to = Carbon::createFromFormat('d.m.Y', $request->input('date_to'))->endOfDay();
        $query->whereDate('created_at', '<=', $to);
    }

    // 💰 Фильтрация по сумме
    if ($request->filled('amount_from')) {
        $query->where('amount', '>=', $request->input('amount_from'));
    }

    if ($request->filled('amount_to')) {
        $query->where('amount', '<=', $request->input('amount_to'));
    }

    // 📦 Фильтрация по статусу
    if ($request->filled('status') && is_numeric($request->input('status'))) {
        $query->where('status', $request->input('status'));
    }

$ordersAll = $query->with('items.product', 'delivery')
                    ->orderBy('created_at', 'desc');

    $orders = $query->with('items.product', 'delivery')
                    ->orderBy('created_at', 'desc')
                    ->paginate(5);

    
    
    

    // Статистика по текущей выборке
    $totalVisibleOrders = $ordersAll->count();
    $totalVisibleAmount = $ordersAll->sum('amount');

    if($totalVisibleAmount == 0.00) $totalVisibleAmount = 0;

    // Статистика по выполненным заказам за 30 дней
    $completedLast30Days = Order::where('status', 4)
        ->where('created_at', '>=', now()->subDays(30))
        ->get();

    $completedCount = $completedLast30Days->count();
    $completedAmount = $completedLast30Days->sum('amount');

    return response()->json([
        'html' => view('admin.order.part.table-rows', compact(
            'orders', 'statuses',
            'completedCount', 'completedAmount',
        ))->render(),
        'totalOrders' => $totalVisibleOrders,
        'totalAmount' => $totalVisibleAmount,
    ]);
}

public function details(Order $order)
{
    // все нужные связи лучше «жадно» подгрузить
    $order->load('items.product', 'delivery');
    return view('admin.order.part.details', compact('order'));
}

public function getOrderStats(Request $request)
{
    $query = Order::query();

    // Фильтры (при необходимости)
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // 💰 Фильтрация по сумме
    if ($request->filled('amount_from')) {
        $query->where('amount', '>=', $request->input('amount_from'));
    }

    if ($request->filled('amount_to')) {
        $query->where('amount', '<=', $request->input('amount_to'));
    }

    if ($request->filled('date_from')) {
        $query->whereDate('created_at', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('created_at', '<=', $request->date_to);
    }

    $totalVisibleOrders = $query->count();
    $totalVisibleAmount = $query->sum('amount');    

    return response()->json([
        'totalVisibleOrders' => $totalVisibleOrders,
        'totalVisibleAmount' => number_format($totalVisibleAmount, 2, '.', ' '),
        
    ]);
}
}
