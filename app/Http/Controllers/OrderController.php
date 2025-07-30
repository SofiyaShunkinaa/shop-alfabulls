<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller {

    public function index() {
        $orders = Order::whereUserId(auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        $statuses = Order::STATUSES;
        return view('user.order.index', compact('orders', 'statuses'));
    }

    public function show(Order $order) {
        if (auth()->user()->id !== $order->user_id) {
            // можно просматривать только свои заказы
            abort(404);
        }
        $statuses = Order::STATUSES;
        return view('user.order.show', compact('order', 'statuses'));
    }

    public function paymentReceive(Request $request)
    {
        
//return response('OK', 200);

        $order = Order::find($request->input('orderid'));

        
        if ($order && $order->status == 0) {
            // Обновляем статус заказа
            if($order->id != 108){//Для проверки
                $order->status = 2; // 2 - оплачен
                $order->save();
            }
            
            
            // Создаем доставку, если не самовывоз
            if ($order->delivery->name != 'Самовывоз') {
                try {
                    (new DeliveryController)->create($order);
                    $order->save();
                } catch (\Exception $e) {
                    \Log::error('Ошибка создания доставки для заказа '.$order->id.': '.$e->getMessage());
                }
            }
            
            return 'ok';
        }
        
        return 'error';
    }
}
