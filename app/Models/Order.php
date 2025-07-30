<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Stem\LinguaStemRu;

class Order extends Model {
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'comment',
        'amount',
        'status',
        'discount_type',
        'discount_amount',
    ];

    public const STATUSES = [
        0 => 'Новый',
        1 => 'Обработан',
        2 => 'Оплачен',
        3 => 'Доставлен',
        4 => 'Завершен',
    ];

    /**
     * Преобразует дату и время создания заказа из UTC в Europe/Moscow
     *
     * @param $value
     * @return \Carbon\Carbon|false
     */
    public function getCreatedAtAttribute($value) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->timezone('Europe/Moscow');
    }

    /**
     * Преобразует дату и время обновления заказа из UTC в Europe/Moscow
     *
     * @param $value
     * @return \Carbon\Carbon|false
     */
    public function getUpdatedAtAttribute($value) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->timezone('Europe/Moscow');
    }

    /**
     * Связь «один ко многим» таблицы `orders` с таблицей `order_items`
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Связь «заказ принадлежит» таблицы `orders` с таблицей `users`
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function delivery() {
        return $this->belongsTo(Delivery::class);
    }

    public function getPaymentLink()
    {
        $headers=Array();
        array_push($headers,'Content-Type: application/x-www-form-urlencoded');

        # Подготавливаем заголовок для авторизации
        array_push($headers,'Authorization: Basic YWRtaW46MGE1MWQ1NTRhNDNh');

        # Укажите адрес ВАШЕГО сервера PayKeeper, адрес demo.paykeeper.ru - пример!
        $server_paykeeper="https://alfabulls.server.paykeeper.ru/";

        # Параметры платежа, сумма - обязательный параметр
        # Остальные параметры можно не задавать
        $payment_data = array (
            "pay_amount" => round($this->amount + $this->delivery_amount, 2),
            // "pay_amount" => 1,
            "clientid" => $this->name,
            "orderid" => $this->id,
            "client_email" => $this->email,
            "service_name" => "Оплата заказа на сайте alfabulls.com",
            "client_phone" => $this->phone,
            
        );

        # Готовим первый запрос на получение токена безопасности
        $uri="/info/settings/token/";

        # Для сетевых запросов в этом примере используется cURL
        $curl=curl_init();

        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_URL,$server_paykeeper.$uri);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'GET');
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($curl,CURLOPT_HEADER,false);

        # Инициируем запрос к API
        $response=curl_exec($curl);
        $php_array=json_decode($response,true);


        # В ответе должно быть заполнено поле token, иначе - ошибка
        if (isset($php_array['token'])) $token=$php_array['token']; else die();


        # Готовим запрос 3.4 JSON API на получение счёта
        $uri="/change/invoice/preview/";

        # Формируем список POST параметров
        $request = http_build_query(array_merge($payment_data, array ('token'=>$token)));

        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_URL,$server_paykeeper.$uri);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($curl,CURLOPT_HEADER,false);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$request);


        $response=json_decode(curl_exec($curl),true);


        # В ответе должно быть поле invoice_id, иначе - ошибка
        if (isset($response['invoice_id'])) $invoice_id = $response['invoice_id']; else die();

        # В этой переменной прямая ссылка на оплату с заданными параметрами
//dd($this);
        if($this->payment == 'sbp'){
            $pstype = "?pstype=sbp_ab";
        }else if($this->payment == 'card'){
            $pstype = "?pstype=alfabank";
        }else{
            $pstype = "";
        }
        
        
        $link = "$server_paykeeper/bill/$invoice_id/$pstype";

        # Теперь её можно использовать как угодно, например, выводим ссылку на оплату
        $this->payment_link = $link;
        $this->save();
    }

    public function scopeSearch($query, $value)
    {
        return $query->where('id', $value)
            ->orWhere('customer_name', 'like', "%{$value}%")
            ->orWhere('phone', 'like', "%{$value}%");
    }
}
