<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Stem\LinguaStemRu;
use App\Models\Profile;


class Otzv extends Model {

    protected $fillable = [
        'name',
        'rating',
        'text',
        'file',
        'status',
        'type',
        'is_video',
    ];

    protected $casts = [
        'is_video' => 'boolean'
    ];
    

    public function getFileUrlAttribute()
    {
        return $this->file ? Storage::url('public/' . $this->file) : null;
    }

    public function isVideo()
    {
        if (!$this->file) {
            return false;
        }

        // Получаем полный путь к файлу в storage
        $filePath = 'public/' . $this->file;

        if (!Storage::exists($filePath)) {
            return false;
        }

        $mimeType = Storage::mimeType($filePath);

        return str_starts_with($mimeType, 'video/');
    }

    public function profile() {
        return $this->belongsTo(Profile::class, 'user_id', 'user_id');
    }

}
