<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class YapayController extends Controller
{
    public function createOrder(Request $request)
    {
        // Подготовим данные корзины в формате RenderedCart
        $orderData = [
            "orderId" => "order-" . time(),
            "currencyCode" => "RUB",
            "availablePaymentMethods" => ["CARD", "SPLIT"],

            // Обязательно — корзина товаров
            "cart" => [
                "items" => [
                    [
                        "productId" => "item-1",
                        "quantity" => [
                            "count" => "1"
                        ],
                        "title" => "Товар 1",
                        "total" => "15980.00",
                        // другие поля можно добавить по необходимости
                    ],
                ],
                "total" => [
                    "amount" => "15980.00"
                ]
            ],

            // Обязательные редиректы (для онлайн-магазина)
            "redirectUrls" => [
                "onSuccess" => url('/thanks'),
                "onError" => url('/payment-error'),
                "onAbort" => url('/payment-abort'),
            ],

            // Опционально - телефон покупателя (без пробелов, в формате 71234567890)
            "billingPhone" => "71234567890",

            // Можно добавить другие поля (metadata, orderSource и т.п.)
            "orderSource" => "WEBSITE",
        ];

        // Авторизация — base64 строка: "merchantId:apiPassword"
        // Значение нужно получить из Яндекс.Кабинета
        $apiKey = config('services.yapay.api_token');

        $response = Http::withHeaders([
            'Authorization' => $apiKey,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Idempotence-Key' => uniqid(),
        ])->post('https://sandbox.pay.yandex.ru/api/merchant/v1/orders', $orderData);

        if ($response->successful()) {
            $data = $response->json('data');
            return response()->json([
                'payment_url' => $data['paymentUrl'] ?? null,
            ]);
        }

        return response()->json([
            'error' => 'Ошибка при создании заказа',
            'details' => $response->json(),
        ], $response->status());
    }
}