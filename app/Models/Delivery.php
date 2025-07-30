<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model {

    protected $fillable = [
        'name', 'max_weight', 'api_data',
    ];

    public function getApiData()
    {
        switch ($this->name) {
            case 'Почта России':
                $api_data = explode(' ', $this->api_data);
                return [
                    'auth' => [
                        'otpravka' => [
                            'token' => $api_data[0],
                            'key' => $api_data[1],
                        ],
                    ],
                ];
                break;
            case 'СДЭК':
                return explode(' ', $this->api_data);
                break;
            case 'СДЭК Курьером':
                return explode(' ', $this->api_data);
                break;
            default:
                return $this->api_data;
                break;
        }
    }
}
