<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\BasketBonusPoints;
use App\Models\Order;
use App\Models\Delivery;
use App\Models\Promo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class BasketController extends Controller {

    private $basket;

    public function __construct() {
        $this->basket = Basket::getBasket();
    }

    /**
     * Показывает корзину покупателя
     */
    public function index() {
        $products = $this->basket->products;
        dd($products);
        $amount = $this->basket->getAmount();
        return view('basket.index', compact('products', 'amount'));
    }

    /**
     * Форма оформления заказа
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request) {
        $profile = null;

        // $products = $this->basket->products;
        // foreach($products as $product) {
        //     $product->quantity = $product->pivot->quantity;
        //     $product->total_price = $product->quantity * $product->price;
        // }
        // $total = $products->sum('total_price');
        $variants = $this->basket->variants()->with('product', 'images')->get();

        foreach ($variants as $variant) {
            if (!$variant || !$variant->pivot) continue;

            $variant->quantity = $variant->pivot->quantity;
            $variant->total_price = $variant->quantity * $variant->price;
            $variant->name = $variant->product->name ?? '';
            $variant->image = $variant->images->first()
                ? asset('storage/catalog/product/source/' . $variant->images->first()->path)
                : asset('images/no-image.png');
        }

        $total = $variants->sum('total_price');

        $user_discount_percent = 0;
        $discount = 0;
        $bonus_points = 0;
        $deliveries = Delivery::query()->orderBy('id')->get();
        $profiles = null;
        $promo = null;
        
        $basket_bonus_points_table = BasketBonusPoints::where('basket_id', $this->basket->id)->first();

        $basket_bonus_points = optional($basket_bonus_points_table)->bonus_amount ?? 0;

        $user_points = 0;
        
        if (auth()->check()) { // если пользователь аутентифицирован
            $user = auth()->user();
            $user_discount_percent = $user->discount_percent;
            // ...и у него есть профили для оформления
            $profiles = $user->profiles;
            // ...и был запрошен профиль для оформления
            $prof_id = (int)$request->input('profile_id');
            if ($prof_id) {
                $profile = $user->profiles()->whereIdAndUserId($prof_id, $user->id)->first();
            }

            $discount = self::calcDiscount('discount_percent', $total, $user);

            $bonus_points = self::calcDiscount('bonus_points', $total, $user);

            $user_points = $user->bonus_points;

            if (is_null($basket_bonus_points_table)) {
                $basketBonusPoints = BasketBonusPoints::create(['user_id' => $user->id, 'basket_id' => $this->basket->id, 'bonus_amount' => 0]);
            }
        }


        // Проверка на примененный промокод
        if ($this->basket->promos->count() > 0) {
            $promo = $this->basket->promos->first(); // Получаем первый примененный промокод
        }

        return view('basket.checkout', compact(
            'profiles', 'profile', 'variants', 'total', 'discount', 
            'bonus_points', 'user_discount_percent', 'deliveries', 'promo', 'user_points', 'basket_bonus_points',
        ));
    }

    static public function calcDiscount($type, $total, $user, $bonusPoints = 0)
    {
        $result = 0;
        switch ($type) {
            case 'discount_percent':
                if ($user->discount_percent) {
                    $result = round($total * ($user->discount_percent * 0.01));
                }
                break;
            case 'bonus_points':
                if ($user->bonus_points) {
                    $result = round($total * 0.3);
                    
                    if ($user->bonus_points < $bonusPoints) {
                        $result = $user->bonus_points;
                    } elseif ($user->bonus_points < $result) {
                        $result = $bonusPoints;
                    } 
                    

                }
                break;
            default:
                break;
        }
        return $result;
    }


    /**
     * Возвращает профиль пользователя в формате JSON
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request) {
        if ( ! $request->ajax()) {
            abort(404);
        }
        if ( ! auth()->check()) {
            return response()->json(['error' => 'Нужна авторизация!'], 404);
        }
        $user = auth()->user();
        $profile_id = (int)$request->input('profile_id');
        if ($profile_id) {
            $profile = $user->profiles()->whereIdAndUserId($profile_id, $user->id)->first();
            if ($profile) {
                return response()->json(['profile' => $profile]);
            }
        }
        return response()->json(['error' => 'Профиль не найден!'], 404);
    }

    /**
     * Сохранение заказа в БД
     */
    public function saveOrder(Request $request) {

        // проверяем данные формы оформления
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
        ]);

        $requestAddress = $request->input('address', '');

        $pvzAddress = $request->input('pvz', ''); 

   
        $fullAddress = trim($requestAddress);
        if ($pvzAddress) {
            if ($fullAddress !== '') {
                $fullAddress .= ', ';
            }
            $fullAddress .= $pvzAddress;
        }

        $discount_amount = 0;

        if (auth()->check() && $request->has('discount_type')) {
            $discount_amount = self::calcDiscount($request->input('discount_type'), $this->basket->getAmount(), auth()->user(), $request->input('bonusPointAmount'));
            if ($request->input('discount_type') === 'promo') {
                $discount_amount = $this->basket->promos()->first()->pric;
            }
            $request->merge([
                'discount_amount' => $discount_amount,
            ]);
            if ($request->input('discount_type') == 'bonus_points') {
                // Списываем балы, если скидка из них
                $basketBonusPoints = BasketBonusPoints::where('basket_id', $this->basket->id)->first();
                $basketBonusPoints->update(['user_id' => auth()->user()->id, 'basket_id' => $this->basket->id, 'bonus_amount' =>$request->input('bonusPointAmount')]);
                auth()->user()->update(['bonus_points' => auth()->user()->bonus_points - $basketBonusPoints->bonus_amount]);
            }
        }
        // валидация пройдена, сохраняем заказ
        $user_id = auth()->check() ? auth()->user()->id : null;
        $order = Order::create(
            $request->all() + ['amount' => $this->basket->getAmount() - $discount_amount, 'user_id' => $user_id, 'address' => $fullAddress, 'delivery_amount' => $request->input('delivery_amount') ?? 0]
        );

        $order->address = $fullAddress;
        $order->delivery_id = $request->input('delivery');
        $order->delivery_amount = $request->input('delivery_amount');
        $order->pvzcode = $request->input('address_code');
        $order->city = $request->input('city');
        $order->street = $request->input('street');
        $order->postalcode = $request->input('postalcode');
        

        // if ($order->delivery->name != 'Самовывоз') {
        //     (new DeliveryController)->create($order);
        //     $order->save();
        // }
        $order->save();
        $order->payment = $request->input('drone');

        foreach ($this->basket->variants as $variant) {
            if (!$variant) continue;

            $product = $variant->product;

            $order->items()->create([
                'product_id' => $product->id,
                'variant_id' => $variant->id,
                'name' => $product->name,
                'price' => $variant->price,
                'quantity' => $variant->pivot->quantity,
                'cost' => $variant->price * $variant->pivot->quantity,
            ]);
        }


        $order->getPaymentLink();

        // очищаем корзину
        $this->basket->clear();
        Cookie::queue(Cookie::forget('basket_id'));

        return redirect($order->payment_link);

        /*return redirect()
            ->route('basket.success')
            ->with('order_id', $order->id);*/
    }

    /**
     * Сообщение об успешном оформлении заказа
     */
    public function success(Request $request) {
        if ($request->session()->exists('order_id')) {
            // сюда покупатель попадает сразу после оформления заказа
            $order_id = $request->session()->pull('order_id');
            $order = Order::findOrFail($order_id);
            return view('basket.success', compact('order'));
        } else {
            // если покупатель попал сюда не после оформления заказа
            return redirect()->route('basket.index');
        }
    }

    /**
     * Сообщение об не успешном оформлении заказа
     */
    public function fail(Request $request) {
        if ($request->session()->exists('order_id')) {
            $order_id = $request->session()->pull('order_id');
            $order = Order::findOrFail($order_id);
            return view('basket.fail', compact('order'));
        } else {
            // если покупатель попал сюда не после оформления заказа
            return redirect()->route('basket.index');
        }
    }

    public function changeBonus(Request $request)
    {
        $user = auth()->user();
        $amount = (int) $request->input('bonusPointAmount');

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Требуется авторизация'], 401);
        }

        $availablePoints = $user->bonus_points;

        if ($amount < 0) {
            return response()->json(['success' => false, 'message' => 'Неверное значение']);
        }

        if ($amount > $availablePoints) {
            return response()->json(['success' => false, 'message' => 'Недостаточно бонусов']);
        }

        BasketBonusPoints::where('basket_id', $this->basket->id)->update(['user_id' => auth()->user()->id, 'basket_id' => $this->basket->id, 'bonus_amount' =>$amount]);

        return response()->json(['success' => true]);
    }

    /**
     * Добавляет товар с идентификатором $id в корзину
     */
    public function add(Request $request, $id) {

        //dd($request);
        //dd($id);
        //dd($request->variant_id);
        // Увеличиваем количество товара в корзине
        //$this->basket->increase($id, 1); //Старый вариант
        // Увеличиваем количество варианта товара
        $variant_id = $request->variant_id;
        $this->basket->increase($variant_id, 1);



        // Если запрос не AJAX, то выполняем редирект
        if (!$request->ajax()) {
            return back();
        }

        // Получаем информацию о корзине
        $basket = Basket::getBasket();
        //$products = $basket->products ?? collect(); //Старый вариант
        $variants = $basket->variants ?? collect();
        $variants->load(['product', 'images']);

        //dd($variants);

        // Обновляем количество и общую стоимость для каждого продукта в корзине
        // foreach ($products as $product) {
        //     if (!$product) {
        //         return;
        //     }
        //     $product->quantity = $product->pivot->quantity;
        //     $product->total_price = $product->quantity * $product->price;
        // }

        // // Суммируем общую стоимость всех товаров в корзине
        // $total = $products->sum('total_price');


        foreach ($variants as $variant) {
        if (!$variant) continue;

            $variant->quantity = $variant->pivot->quantity;
            $variant->total_price = $variant->quantity * $variant->price;
            $variant->name = $variant->product->name ?? '';
            $variant->image = $variant->images->first()->path;
                // ? asset('storage/catalog/product/source/' . $variant->images->first()->path)
                // : asset('images/no-image.png'); // запасной вариант
        }

        $total = $variants->sum('total_price');

        // Получаем информацию о текущем пользователе для расчета скидки
        $user = Auth::user();
        $discount = 0;

        // Если пользователь авторизован, рассчитываем скидку
        if ($user) {
            $discount = BasketController::calcDiscount('discount_percent', $total, $user);
        }

        // Рассчитываем итоговую сумму с учетом скидки
        $total_with_discount = $total - $discount;
        

        // Возвращаем обновленные данные корзины в формате JSON
        return response()->json([
            'success' => true,
            'products' => $variants,
            'total' => number_format($total, 2, '.', ''),
            'discount' => number_format($discount, 2, '.', ''),
            'total_with_discount' => number_format($total_with_discount, 2, '.', ''),
            'positions' => $variants->count(),
        ]);
    }



    /**
     * Увеличивает кол-во товара $id в корзине на единицу
     */
    public function plus($id) {
        $this->basket->increase($id);
        // выполняем редирект обратно на страницу корзины
        return back()->with('success', 'Количество товара изменено');
    }

    /**
     * Уменьшает кол-во товара $id в корзине на единицу
     */
    public function minus($id) {
        $this->basket->decrease($id);
        // выполняем редирект обратно на страницу корзины
        return back()->with('success', 'Количество товара изменено');
    }

    /**
     * Изменяет количество варианта товара в корзине (AJAX)
     */
    public function changeAjax(Request $request, $variantId)
    {
         \Log::info('changeAjax called', [
        'variantId' => $variantId,
        'quantity' => $request->quantity,
        'action' => $request->action
    ]);
    
        $validated = $request->validate([
            'quantity' => 'required|integer',
            'action' => 'sometimes|in:plus,minus,set'
        ]);

        $quantity = (int) $validated['quantity'];
        $action = $validated['action'] ?? 'set';

        switch ($action) {
            case 'plus':
                $this->basket->increase($variantId);
                break;
            case 'minus':
                $this->basket->decrease($variantId);
                break;
            default:
                $this->basket->setQuantity($variantId, $quantity);
        }

        $variantInBasket = $this->basket->variants()->find($variantId);
        if ($variantInBasket && $variantInBasket->pivot->quantity <= 0) {
            $this->basket->variants()->detach($variantId);
        }

        $basket = Basket::getBasket();
        $variants = $basket->variants ?? collect();

        foreach ($variants as $variant) {
            if (!$variant || !$variant->pivot) continue;

            $variant->quantity = $variant->pivot->quantity;
            $variant->total_price = $variant->quantity * $variant->price;
        }

        $total = $variants->sum('total_price');
        $user = Auth::user();
        $discount = 0;

        $variant = $basket->variants()->find($variantId);

        if ($variant && $variant->pivot) {
            $quantity = $variant->pivot->quantity;
            $price = $variant->price;
            $old_price = $variant->oldprice ?? $price; // на случай отсутствия oldprice
            $total_item = $quantity * $price;
            $total_item_old = $quantity * $old_price;
        } else {
            $quantity = 0;
            $total_item = 0;
            $total_item_old = 0;
        }

        if ($user) {
            $discount = BasketController::calcDiscount('discount_percent', $total, $user);
        }

        return response()->json([
            'success' => true,
            'variants' => $variants,
            'total' => number_format($total, 2, '.', ''),
            'discount' => number_format($discount, 2, '.', ''),
            'total_with_discount' => number_format($total - $discount, 2, '.', ''),
            'quantity' => $quantity,
            'total_item_price' => number_format($total_item, 2, '.', ''),
            'total_item_old_price' => number_format($total_item_old, 2, '.', ''),
        ]);
    }



    /**
 * Удаляет вариант товара с идентификатором $variantId из корзины
 */
public function remove($variantId)
{
    // Удаляем вариант из корзины
    $this->basket->variants()->detach($variantId);

    // Получаем обновлённую корзину и варианты
    $basket = Basket::getBasket();
    $variants = $basket->variants ?? collect();

    // Обновляем количество и сумму для каждого варианта
    foreach ($variants as $variant) {
        if (!$variant) continue;
        $variant->quantity = $variant->pivot->quantity;
        $variant->total_price = $variant->quantity * $variant->price;
    }

    $total = $variants->sum('total_price');
    $user = Auth::user();
    $discount = 0;

    if ($user) {
        $discount = BasketController::calcDiscount('discount_percent', $total, $user);
    }

    return response()->json([
        'status' => 'ok',
        'total' => number_format($total, 2, '.', ''),
        'discount' => number_format($discount, 2, '.', ''),
        'total_with_discount' => number_format($total - $discount, 2, '.', ''),
        'variant_id' => $variantId,
        'positions' => $variants->count(),
    ]);
}


    /**
     * Полностью очищает содержимое корзины покупателя
     */
    public function clear() {
        $this->basket->delete();
        // выполняем редирект обратно на страницу корзины
        return back()->with('success', 'Корзина очищена');
    }

    public function applyPromoCode(Request $request)
    {
        // Получаем введенный промокод из формы
        $promoCode = $request->input('mspc2_code');

        // Находим промокод по коду
        $promo = Promo::where('archived', false)->where('name', $promoCode)->first();

        if ($promo) {
            // Проверяем, не истек ли срок действия промокода
            $currentDate = Carbon::now();

            if ($currentDate->between($promo->datastart, $promo->datastop)) {
                // Применяем промокод к корзине
                $basket = Basket::find(Cookie::get('basket_id'));

                // Добавляем промокод в корзину, если его еще нет
                if ($basket) {
                    $basket->promos()->syncWithoutDetaching($promo->id);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Промокод применен!',
                        'pric' => $promo->pric,
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Корзина не найдена!',
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Промокод истек!',
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Неверный промокод!',
            ]);
        }
    }
}
