<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Stem\LinguaStemRu;

class Dogs extends Model {

    protected $fillable = [
        'name',
        'slug',
        'date',
        'opis',
        'pric',
        'type',
        'oldprice',
        'sale',
        'baseprice',
    ];

    public function media()
    {
        return $this->hasMany(DogMedia::class, 'dog_id');
    }

    public function images()
    {
        return $this->media()->where('type', 'image');
    }

    public function videos()
    {
        return $this->media()->where('type', 'video');
    }


}
