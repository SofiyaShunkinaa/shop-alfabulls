<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GeoHelper
{
    public static function getClientCity(): ?string
    {
        $ip = request()->ip();

        return Cache::remember("geo_city_{$ip}", 3600, function () use ($ip) {
            try {
                $response = Http::get("https://ipapi.co/{$ip}/json/");
                if ($response->successful()) {
                    return $response->json()['city'] ?? null;
                }
            } catch (\Exception $e) {
                return null;
            }
        });
    }

    public static function isMoscowClient(): bool
    {
        return mb_strtolower(self::getClientCity()) === 'moscow';
    }
}
