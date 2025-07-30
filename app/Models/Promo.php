<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Stem\LinguaStemRu;

class Promo extends Model {

    protected $fillable = [
        'name',
        'pric',
        'datastart',
        'datastop',
    ];


    public function baskets()
    {
        return $this->belongsToMany(Basket::class, 'basket_promo');
    }
}
