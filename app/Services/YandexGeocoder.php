<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class YandexGeocoder
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.yandex_geocoder.key');
    }

    public function getCoordinates(string $address): ?array
    {
        $url = 'https://geocode-maps.yandex.ru/1.x/';

        $response = Http::withHeaders([
            'User-Agent' => 'LaravelGeocoderApp/1.0'
        ])->get($url, [
            'format'   => 'json',
            'apikey'   => $this->apiKey,
            'geocode'  => $address,
        ]);
        //dd($response->status(), $response->body());

        if (!$response->successful()) {
            dd('Ошибка запроса:', $response->status(), $response->body(), $response->effectiveUri());
        }
        
        $data = $response->json();

        $pos = data_get($data, 'response.GeoObjectCollection.featureMember.0.GeoObject.Point.pos');
        
        if ($pos) {
            [$lon, $lat] = explode(' ', $pos);
            return [(float) $lon, (float) $lat];
        }

        return null;
    }
}
