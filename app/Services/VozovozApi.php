<?php

namespace App\Services;

class VozovozApi
{
    private $url = 'https://vozovoz.ru/api/?token=';
    private $timeout = 30;

    public function __construct($api_key)
    {
        $this->url .= $api_key;
    }

    public function getPrice($params)
    {
        $result = $this->request('price', 'get', $params);
        return $result['response'];
    }

    public function getTerminal($params)
    {
        $result = $this->request('terminal', 'get', $params);
        return $result['response']['data'];
    }

    public function request($object, $action, $params = [])
    {
        $headers = [
            'Content-Type: application/json',
        ];
        $data = compact('object', 'action', 'params');
        if (empty($data['params'])) {
            unset($data['params']);
        }
        $options = [
            CURLOPT_URL => $this->url,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => $this->timeout,
            CURLOPT_TIMEOUT => $this->timeout,
        ];

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
