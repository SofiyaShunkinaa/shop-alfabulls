<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Profile;

class UserController extends Controller {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $user = auth()->user();

        // Если у пользователя ещё нет профилей — создаём первый
        if ($user->profiles()->count() === 0) {
            $user->profiles()->create([
                'name' => $user->name ?? '',
                'email' => $user->email ?? '',
                'phone' => $user->phone ?? '',
            ]);
        }
        $orders = Order::whereUserId(auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        $statuses = Order::STATUSES;
        $profiles = auth()->user()->profiles()->paginate(4);
        $user = auth()->user();
        return view('user.index', compact('orders', 'statuses','profiles', 'user'));
    }


      public function show(Order $order) {
        if (auth()->user()->id !== $order->user_id) {
            // можно просматривать только свои заказы
            abort(404);
        }
        $statuses = Order::STATUSES;
        return view('user.order.show', compact('order', 'statuses'));
    }
}

