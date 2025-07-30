<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BasketBonusPoints extends Model {

    protected $fillable = ['basket_id', 'user_id', 'bonus_amount'];

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function baskets() {
        return $this->belongsToMany(Basket::class);
    }
}
