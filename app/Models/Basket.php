<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cookie;

class Basket extends Model {

    /**
     * Связь «многие ко многим» таблицы `baskets` с таблицей `products`
     */
    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function promos()
    {
        return $this->belongsToMany(Promo::class, 'basket_promo');
    }

    public function variants()
    {
        return $this->belongsToMany(ProductVariant::class, 'basket_product', 'basket_id', 'variant_id')
            ->withPivot('quantity');
    }

    /**
     * Увеличивает кол-во товара $id в корзине на величину $count
     */
    // public function increase($id, $count = 1) {
    //     $this->change($id, $count);
    // }
    public function increase($variantId, $count = 1)
    {
        $this->change($variantId, $count);
    }

    /**
     * Уменьшает кол-во товара $id в корзине на величину $count
     */
    // public function decrease($id, $count = 1) {
    //     $this->change($id, -1 * $count);
    // }
    public function decrease($variantId, $count = 1)
    {
        $this->change($variantId, -1 * $count);
    }

    /**
     * Устанавливает точное количество товара
     */
    // public function setQuantity($id, $count = 1) 
    // {
    //     if ($count < 1) {
    //         $count = 1;
    //     }
        
    //     $pivotRow = $this->products()->where('product_id', $id)->first()->pivot;
    //     $pivotRow->update(['quantity' => $count]);
    // }
    public function setQuantity($variantId, $count = 1)
    {
        if ($count < 1) {
            $count = 1;
        }

        $pivotRow = $this->variants()->where('variant_id', $variantId)->first()->pivot;
        $pivotRow->update(['quantity' => $count]);
    }

    /**
     * Изменяет количество товара $id в корзине на величину $count;
     * если товара еще нет в корзине — добавляет этот товар; $count
     * может быть как положительным, так и отрицательным числом
     */
    // private function change($id, $count = 1) {
    //     if ($count === 0) {
    //         return;
    //     }
    //     $id = (int)$id;
    //     // если товар есть в корзине — изменяем кол-во
    //     if ($this->products->contains($id)) {
    //         // получаем объект строки таблицы `basket_product`
    //         $pivotRow = $this->products()->where('product_id', $id)->first()->pivot;
    //         $quantity = $pivotRow->quantity + $count;
    //         if ($quantity > 0) {
    //             // обновляем количество товара $id в корзине
    //             $pivotRow->update(['quantity' => $quantity]);
    //         } else {
    //             // кол-во равно нулю — удаляем товар из корзины
    //             $pivotRow->delete();
    //         }
    //     } elseif ($count > 0) { // иначе — добавляем в корзину
    //         $this->products()->attach($id, ['quantity' => $count]);
    //     }
    //     // обновляем поле `updated_at` таблицы `baskets`
    //     $this->touch();
    // }
    private function change($variantId, $count = 1)
    {
        if ($count === 0) {
            return;
        }

        $variantId = (int)$variantId;

        $variant = ProductVariant::findOrFail($variantId);

        $query = $this->variants()->where('variant_id', $variantId);

        if ($query->exists()) {
            $pivotRow = $query->first()->pivot;
            $quantity = $pivotRow->quantity + $count;

            if ($quantity > 0) {
                $pivotRow->update(['quantity' => $quantity]);
            } else {
                $pivotRow->delete();
            }
        } elseif ($count > 0) {
            $this->variants()->attach($variantId, [
                'quantity' => $count,
                'product_id' => $variant->product_id, // 🔥 Важно: добавляем product_id явно
            ]);
        }

        $this->touch();
    }

    /**
     * Удаляет вариант товара с идентификатором $variantId из корзины покупателя
     */
    public function remove($variantId)
    {
        // Удаляем вариант из корзины (разрушаем связь по variant_id)
        $this->variants()->detach($variantId);

        // Обновляем поле `updated_at` в таблице `baskets`
        $this->touch();
    }

    /**
     * Удаляет все товары из корзины покупателя
     */
    public function clear() {
        // удаляем товар из корзины (разрушаем все связи)
        $this->products()->detach();
        // обновляем поле `updated_at` таблицы `baskets`
        $this->touch();
    }

    /**
     * Возвращает стоимость всех товаров в корзине
     */
    public function getAmount() {
        $amount = 0.0;
        foreach ($this->products as $product) {
            $amount = $amount + $product->price * $product->pivot->quantity;
        }
        return $amount;
    }

    /**
     * Возвращает количество позиций в корзине
     */
    public static function getCount() {
        $basket_id = request()->cookie('basket_id');
        if (empty($basket_id)) {
            return 0;
        }
        return self::getBasket()->products->count();
    }

    /**
     * Получаем общую стоимость товаров с учетом скидки
     */
    public function totalWithDiscount()
    {
        return $this->total() - $this->discount();
    }

    /**
     * Возвращает объект корзины; если не найден — создает новый
     */
    public static function getBasket() {
        $basket_id = (int)request()->cookie('basket_id');
        if (!empty($basket_id)) {
            try {
                $basket = Basket::findOrFail($basket_id);
            } catch (ModelNotFoundException $e) {
                $basket = Basket::create();
            }
        } else {
            $basket = Basket::create();
        }
        Cookie::queue('basket_id', $basket->id, 525600);
        return $basket;
    }
}
