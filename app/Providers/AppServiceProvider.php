<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Blade::directive('icon', function($expression) {
            $name = str_replace("'", '', $expression);
            return '<i class="fas fa-' . $name . '"></i>';
        });
        Blade::directive('price', function($expression) {
            return "<?php echo number_format($expression, 2, '.', ''); ?>";
        });
        Blade::if('admin', function() {
            return ! auth()->check() && auth()->user()->admin;
        });
        Blade::directive('money', function ($amount) {
            return "<?php echo number_format($amount, 2, '.', ' ') . ' руб.'; ?>";
        });

        View::composer('*', function ($view) {
            $basket = \App\Models\Basket::getBasket();
            $variants = $basket->variants ?? collect();

            foreach ($variants as $variant) {
                $variant->quantity = $variant->pivot->quantity;
                $variant->total_price = $variant->quantity * $variant->price;
            }

            $total = $variants->sum('total_price');

            $user = Auth::user();
            $discount = 0;
            $user_discount_percent = 0;

            if ($user) {
                $user_discount_percent = $user->discount_percent;
                $discount = \App\Http\Controllers\BasketController::calcDiscount('discount_percent', $total, $user);
            }

            $view->with([
                'basket_variants' => $variants,
                'basket_total' => $total,
                'basket_discount' => $discount,
                'basket_total_with_discount' => $total - $discount,
            ]);
        });
    }
}
