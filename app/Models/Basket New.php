<?php
use App\Models\ProductVariant;

class Basket extends Model
{
    public function variants()
    {
        return $this->belongsToMany(ProductVariant::class, 'basket_product', 'basket_id', 'variant_id')
            ->withPivot('quantity');
    }

    public function promos()
    {
        return $this->belongsToMany(Promo::class, 'basket_promo');
    }

    public function increase($variantId, $count = 1)
    {
        $this->change($variantId, $count);
    }

    public function decrease($variantId, $count = 1)
    {
        $this->change($variantId, -1 * $count);
    }

    public function setQuantity($variantId, $count = 1)
    {
        if ($count < 1) {
            $count = 1;
        }

        $pivotRow = $this->variants()->where('variant_id', $variantId)->first()->pivot;
        $pivotRow->update(['quantity' => $count]);
    }

    private function change($variantId, $count = 1)
    {
        if ($count === 0) {
            return;
        }

        $variantId = (int)$variantId;

        if ($this->variants->contains($variantId)) {
            $pivotRow = $this->variants()->where('variant_id', $variantId)->first()->pivot;
            $quantity = $pivotRow->quantity + $count;

            if ($quantity > 0) {
                $pivotRow->update(['quantity' => $quantity]);
            } else {
                $pivotRow->delete();
            }
        } elseif ($count > 0) {
            $this->variants()->attach($variantId, ['quantity' => $count]);
        }

        $this->touch();
    }

    public function remove($variantId)
    {
        $this->variants()->detach($variantId);
        $this->touch();
    }

    public function clear()
    {
        $this->variants()->detach();
        $this->touch();
    }

    public function getAmount()
    {
        $amount = 0.0;

        foreach ($this->variants as $variant) {
            $amount += $variant->price * $variant->pivot->quantity;
        }

        return $amount;
    }

    public static function getCount()
    {
        $basket_id = request()->cookie('basket_id');
        if (empty($basket_id)) {
            return 0;
        }
        return self::getBasket()->variants->count();
    }

    public function totalWithDiscount()
    {
        return $this->total() - $this->discount();
    }

    public static function getBasket()
    {
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
