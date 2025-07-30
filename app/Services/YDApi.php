<?php

namespace App\Services;

class YDApi
{
    private $api_key = '';
    private $url = 'https://b2b-authproxy.taxi.yandex.net/api/b2b/platform';
    private $timeout = 30;

    public function __construct($api_key)
    {
        $this->api_key = $api_key;
    }

    public function locationDetect($location)
    {
        $result = $this->request('/location/detect', ['location' => $location]);
        return $result['variants'];
    }

    public function pickupPointsList($geo_id)
    {
        $result = $this->request('/pickup-points/list', ['geo_id' => $geo_id, 'type' => 'pickup_point']);
        return $result['points'];
    }

    public function pricingСalculator($destination, $source, $tariff, $total_weight)
    {
        $result = $this->request('/pricing-calculator', compact('destination', 'source', 'tariff', 'total_weight'));
        return str_replace(' RUB', '', $result['pricing_total']);
    }

    public function offersCreate($order)
    {
        $result = $this->request('/offers/create', $order);

        \Log::info('Ответ от Яндекса offersCreate', ['response' => $result]);

        if (!isset($result['offers']) || !is_array($result['offers'])) {
            throw new \Exception('В ответе от Яндекса отсутствует ключ offers: ' . json_encode($result));
        }
        return $result['offers'];
    }

    public function offersConfirm($offer_id)
    {
        $result = $this->request('/offers/confirm', compact('offer_id'));
        return $result['request_id'];
    }

    public function requestInfo($offer_id)
    {
        $result = $this->request('/request/info', compact('offer_id'));
        return $result;
    }

    public function offersInfo($station_id, $self_pickup_id)
    {
        $result = $this->request('/offers/info', compact('station_id', 'self_pickup_id'), false);
        return $result;
    }

    public function request($endpoint, $data = [], $post = true)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->api_key,
        ];

        if (!$post) {
            $endpoint .= '?' . http_build_query($data);
        }
        $options = [
            CURLOPT_URL => $this->url . $endpoint,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => $this->timeout,
            CURLOPT_TIMEOUT => $this->timeout,
        ];
        if (!$post) {
            unset($options[CURLOPT_POST]);
            unset($options[CURLOPT_POSTFIELDS]);
        }
        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $response = json_encode(['curl_error' => curl_errno($ch), 'curl_message' => curl_error($ch)]);
        }
        curl_close($ch);
        return json_decode($response, true);
    }
}
