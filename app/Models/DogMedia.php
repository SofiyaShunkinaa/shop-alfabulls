<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DogMedia extends Model
{
    protected $fillable = ['dog_id', 'path', 'type'];

    public function dog()
    {
        return $this->belongsTo(Dogs::class, 'dog_id');
    }
}
