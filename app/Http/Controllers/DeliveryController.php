<?php
namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Basket;
use App\Models\Order;
use Illuminate\Http\Request;
use Symfony\Component\HttpClient\Psr18Client;
use App\Traits\PackageParamCalc;
use LapayGroup\RussianPost\Providers\OtpravkaApi;
use LapayGroup\RussianPost\ParcelInfo;
use LapayGroup\RussianPost\AddressList;
use LapayGroup\RussianPost\Entity\Order as RussianPostOrder;
use CdekSDK2\BaseTypes\Tarifflist;
use CdekSDK2\BaseTypes\Tariff;
use CdekSDK2\BaseTypes\Location;
use CdekSDK2\Constraints\Currencies;
use CdekSDK2\BaseTypes\Package;
use CdekSDK2\BaseTypes;
use YDeliverySDK\ClientBuilder;
use YDeliverySDK\Requests;
use App\Services\YDApi;
use App\Services\VozovozApi;
use App\Services\YandexGeocoder;
use GuzzleHttp\Client;

class DeliveryController extends Controller
{
    use PackageParamCalc;

    private $clearedAddress;

    private $Length;
    private $Width;
    private $Height;
    private $Weight;
    private $Amount; // Сумма заказа

    private $addData = [];

    public function __construct()
    {
        $this->PackageParamCalc(Basket::getBasket());
    }

    static public function clearAddress($address)
    {
        $rp_delivery = Delivery::whereName('Почта России')->first();
        $otpravkaApi = new OtpravkaApi($rp_delivery->getApiData());
        $addressList = new AddressList();
        $addressList->add($address);

        $result = $otpravkaApi->clearAddress($addressList)[0];
        if (empty($result['place'])) {
            // подставляем "г." чтобы нашёлся город, если пользователь ввёл только название города
            $addressList = new AddressList();
            $addressList->add('г. '.$address);
            $result = $otpravkaApi->clearAddress($addressList)[0];
            if (empty($result['place'])) {
                return '';
            }
        }
        $result['_city'] = explode(' ', $result['place']);
        $result['_city'] = $result['_city'][1];
        return $result;
    }

    public function calculate(Request $request)
    {
        // dd($request);
        $result = [
            'success' => false,
            'delivery_price' => 0,
        ];
        if (empty($request->input('address'))) {
            $result['error'] = 'Укажите адрес доставки';
        } else {
            $delivery = Delivery::find($request->input('delivery'));
            if ($delivery->name != 'Самовывоз') {
                $this->clearedAddress = self::clearAddress($request->input('address'));
                
                //dd($this->clearedAddress);
                if (!empty($this->clearedAddress)) {
                    $result['delivery_price'] = (float)$this->{'calculate' . $delivery->id}($delivery);
                    if ($result['delivery_price']) {
                        $result['success'] = true;
                        if (!empty($this->addData)) {
                            $result['addData'] = $this->addData;
                        }
                    } else {
                        $result['error'] = 'ПВЗ не найдены в указанном городе.';
                    }
                } else {
                    $result['error'] = 'Неудалось найти адрес или ПВЗ';
                }
            }
        }
        
        return $result;
    }

    // Цифра после calculate - id метода доставки
    // СДЭК
    public function calculate2($delivery)
    {
        $authData = $delivery->getApiData();
        $cdek = new \CdekSDK2\Client(new Psr18Client(), $authData[0], $authData[1]);
//dd($authData);
        $result = $cdek->cities()->getFiltered(['country_codes' => 'RU', 'city' => $this->clearedAddress['_city']]);
        $cities = $cdek->formatResponseList($result, \CdekSDK2\Dto\CityList::class);


        //$tariff = TariffList::create([]); //для получения списка тарифов
        $tariff = Tariff::create([]);
        $tariff->tariff_code = 368; //Номер тарифа: склад-постамат
        $tariff->date = (new \DateTime())->format(\DateTime::ISO8601);
        $tariff->type = Tarifflist::TYPE_ECOMMERCE;
        $tariff->currecy = Currencies::RUBLE;
        $tariff->lang = Tarifflist::LANG_RUS;
        $tariff->from_location = Location::create([
            'address' => 'Ярославль, пр-т Московский, 115',
            'code' => 146,
            'country_code' => 'RU'
        ]);
        $tariff->to_location = Location::create([
            'code' => $cities->items[0]->code,
            'country_code' => 'RU'
        ]);
        $tariff->packages = [
            Package::create([
                'weight' => $this->Weight,
                'length' => $this->Length,
                'width' => $this->Width,
                'height' => $this->Height,
            ])
        ];

        $result = $cdek->calculator()->add($tariff);
        if ($result->hasErrors()) {
            \Debugbar::info($result);
        }

        if ($result->isOk()) {
            //Запрос успешно выполнился
            //$response = $cdek->formatResponseList($result, \CdekSDK2\Dto\TariffList::class);
            $response_Tariff = $cdek->formatBaseResponse($result, \CdekSDK2\Dto\Tariff::class);
        }

        $this->addData['delivery_period'] = $response_Tariff->period_min != $response_Tariff->period_max ?
                                                                            $response_Tariff->period_min . '-' . $response_Tariff->period_max :
                                                                            $response_Tariff->period_min;
        $result = $cdek->offices()->getFiltered(['country_code' => 'ru', 'city_code' => $cities->items[0]->code, 'type' => 'PVZ']);
        if ($result->isOk()) {
            //Запрос успешно выполнился
            $pickupPointsList = $cdek->formatResponseList($result, \CdekSDK2\Dto\PickupPointList::class);
            $pickupPointsList = collect($pickupPointsList->items)->mapWithKeys(function ($item) {
                return [$item->code => $item->location->address];
            });
            

            $this->addData['pvz_list'] = $pickupPointsList->toArray();
        }

        return $response_Tariff->total_sum;
    }

    // СДЭК Курьером
    public function calculate7($delivery)
    {
        
        $authData = $delivery->getApiData();
        //dd($authData);
        $cdek = new \CdekSDK2\Client(new Psr18Client(), $authData[0], $authData[1]);
        

        $result = $cdek->cities()->getFiltered(['country_codes' => 'RU', 'city' => $this->clearedAddress['_city']]);
        $cities = $cdek->formatResponseList($result, \CdekSDK2\Dto\CityList::class);


        //$tariff = TariffList::create([]); //для получения списка тарифов
        //dd($tariff);
        $tariff = Tariff::create([]);
        
        $tariff->tariff_code = 137; //Номер тарифа: склад-адрес
        $tariff->date = (new \DateTime())->format(\DateTime::ISO8601);
        $tariff->type = Tarifflist::TYPE_ECOMMERCE;
        $tariff->currecy = Currencies::RUBLE;
        $tariff->lang = Tarifflist::LANG_RUS;
        $tariff->from_location = Location::create([
            'address' => 'Ярославль, пр-т Московский, 115',
            'code' => 146,
            'country_code' => 'RU'
        ]);
        $tariff->to_location = Location::create([
            'code' => $cities->items[0]->code,
            'country_code' => 'RU'
        ]);
        $tariff->packages = [
            Package::create([
                'weight' => $this->Weight,
                'length' => $this->Length,
                'width' => $this->Width,
                'height' => $this->Height,
            ])
        ];

        $result = $cdek->calculator()->add($tariff);


        if ($result->hasErrors()) {
            \Debugbar::info($result);
        }

        if ($result->isOk()) {
            //Запрос успешно выполнился
            //$response = $cdek->formatResponseList($result, \CdekSDK2\Dto\TariffList::class);
            $response_Tariff = $cdek->formatBaseResponse($result, \CdekSDK2\Dto\Tariff::class);
        }

        $this->addData['delivery_period'] = $response_Tariff->period_min != $response_Tariff->period_max ?
                                                                            $response_Tariff->period_min . '-' . $response_Tariff->period_max :
                                                                            $response_Tariff->period_min;
        $result = $cdek->offices()->getFiltered(['country_code' => 'ru', 'city_code' => $cities->items[0]->code, 'type' => 'PVZ']);
        if ($result->isOk()) {
            //Запрос успешно выполнился
            $pickupPointsList = $cdek->formatResponseList($result, \CdekSDK2\Dto\PickupPointList::class);
            $pickupPointsList = collect($pickupPointsList->items)->mapWithKeys(function ($item) {
                return [$item->code => $item->location->address];
            });
            $this->addData['pvz_list'] = $pickupPointsList->toArray();
        }

        return $response_Tariff->total_sum;
    }

    // Яндекс доставка
    public function calculate3($delivery)
    {
        $yd_api = new YDApi($delivery->getApiData());

        $response = $yd_api->locationDetect($this->clearedAddress['_city']);
        $response = $yd_api->pickupPointsList($response[0]['geo_id']);

        $pickupPointsList = collect($response)->mapWithKeys(function ($item) {
            $address = explode(' ', $item['address']['full_address']);
            unset($address[0]);
            return [$item['id'] => implode(' ', $address)];
        });
        
        $destination = ['platform_station_id' => $pickupPointsList->keys()[0]];
        $source = ['platform_station_id' => '77cc1f81-b5f0-46dd-949b-0a5b0c109b9b'];

        $price = $yd_api->pricingСalculator($destination, $source, 'self_pickup', $this->Weight);
        $this->addData['pvz_list'] = $pickupPointsList->toArray();

        return $price;
    }


    // Яндекс Курьером
    public function calculate8($delivery)
    {

//dd(config('services.yandex_geocoder.key'));
        $fullAddress = $this->clearedAddress['original-address'] ?? '';
        
        $geocoder = app(YandexGeocoder::class);
        
        $coordinates = $geocoder->getCoordinates($fullAddress);
        

        if (!$coordinates) {
            throw new \Exception('Не удалось получить координаты адреса');
        }
        

        $yd_api = new YDApi($delivery->getApiData());       

        

        // Формируем destination для курьерской доставки
        $destination = [
            'address' => $fullAddress,
            'coordinates' => $coordinates,
        ];

        // Источник — станция (или адрес склада)
        $source = [
            'platform_station_id' => '77cc1f81-b5f0-46dd-949b-0a5b0c109b9b', // лучше хранить в конфиге
        ];
//dd($source);
        // Тип доставки — курьер
        try {
            $price = $yd_api->pricingСalculator($destination, $source, 'time_interval', $this->Weight);
        } catch (\Throwable $e) {
            dd('Ошибка:', $e->getMessage(), $e->getTraceAsString());
        }
        return $price;
    }


    // Почта России
    public function calculate4($delivery)
    {
        //dd($delivery->getApiData());
        if (empty($this->clearedAddress['index'])) {
            return 0;
        }
        $otpravkaApi = new OtpravkaApi($delivery->getApiData());
        $list = $otpravkaApi->shippingPoints();

        $parcelInfo = new ParcelInfo();
        $parcelInfo->setIndexFrom($list[0]['operator-postcode']); // Индекс пункта сдачи из функции $otpravkaApi->shippingPoints()
        $parcelInfo->setIndexTo($this->clearedAddress['index']);
        $parcelInfo->setMailCategory('ORDINARY'); // https://otpravka.pochta.ru/specification#/enums-base-mail-category
        $parcelInfo->setMailType('ONLINE_PARCEL'); // https://otpravka.pochta.ru/specification#/enums-base-mail-type
        $parcelInfo->setLength($this->Length);
        $parcelInfo->setWidth($this->Width);
        $parcelInfo->setHeight($this->Height);
        $parcelInfo->setWeight($this->Weight);
        //$parcelInfo->setGoodsValue(10000);
        $parcelInfo->setFragile(false);
        $parcelInfo->setSmsNoticerecipient(false);


        $tariffInfo = $otpravkaApi->getDeliveryTariff($parcelInfo);
        return ($tariffInfo->getTotalRate() + $tariffInfo->getTotalNds()) / 100;
    }
    // Boxberry
    public function calculate5($delivery)
    {
        $bbClient = new \WildTuna\BoxberrySdk\Client(120, 'https://api.boxberry.ru/json.php');
        $bbClient->setToken('main', $delivery->getApiData()); // Заносим токен BB и присваиваем ему ключ main
        $bbClient->setCurrentToken('main');
        $result = $bbClient->getCityList();
        $result = collect($result)->where('Name', $this->clearedAddress['_city']);
        if ($result->isEmpty()) {
            return 0;
        }

        $city = $result->first();
        $pvz_list = $bbClient->getPvzList(true, false, $city['Code']);
        $calcParams = new \WildTuna\BoxberrySdk\Entity\CalculateParams();
        $calcParams->setWeight($this->Weight);
        $calcParams->setPvz($pvz_list[0]['Code']);
        $calcParams->setAmount($this->Amount);
        $calcParams->setDepth($this->Length);
        $calcParams->setWidth($this->Width);
        $calcParams->setHeight($this->Height);

        $calc = $bbClient->calcTariff($calcParams);
        $pvz_list = collect($pvz_list)->mapWithKeys(function ($item) {
            return [$item['Code'] => $item['AddressReduce']];
        });
        $this->addData['pvz_list'] = $pvz_list->toArray();
        $this->addData['delivery_period'] = $calc->getDeliveryPeriod();

        return $calc->getPrice();
    }
    // Vozovoz
    public function calculate6($delivery)
    {
        $api = new VozovozApi($delivery->getApiData());
        
        $cargo = [
            'dimension' => [
                "quantity" => 1, // количество мест
                "volume" => round(($this->Length / 100 ) * ($this->Width / 100 ) * ($this->Height / 100 ), 5), // общий объем
                "weight" => $this->Weight / 1000 // общий вес
            ],
        ];
        $gateway = [
            'dispatch' => [// откуда
                'point' => [
                    'location' => 'Ярославль, пр-т Московский, 115',
                    'terminal' => 'Ярославль, пр-т Московский, 115',
                ],
            ],
            'destination' => [// куда
                'point' => [
                    'location' => request()->input('address'),
                    'terminal' => request()->input('address'),
                ],
            ],
        ];
        $result = $api->getPrice(compact('cargo', 'gateway'));
        $price = $result['price'];
        $this->addData['delivery_period'] = implode('-', $result['deliveryTime']);
        $pvz_list = $api->getTerminal(['location' => $this->clearedAddress['_city']]);

        \Log::info('pvz_list', ['pvz_list' => $pvz_list]);

        $this->addData['pvz_list'] = collect($pvz_list)->mapWithKeys(function ($item) {
            return [$item['guid'] => $item['name']];
        });
        return $price;
    }

    public function create(Order &$order)
    {
        
        $this->clearedAddress = self::clearAddress($order->address);        
        $this->{'createDelivery' . $order->delivery->id}($order);
    }

    // CDEK
    public function createDelivery2(Order &$order)
    {
        $authData = $order->delivery->getApiData();
        $cdek = new \CdekSDK2\Client(new Psr18Client(), $authData[0], $authData[1]);

        $cart_items = [];

        $products = $order->items;

        foreach($products as $product) {
            $product->weight ?? 1000; // Заглушка, пока у товара нет этого свойства
            $cart_items[] =
                BaseTypes\Item::create([
                    'name' => $product->name,
                    'ware_key' => $product->id,
                    'payment' => BaseTypes\Money::create(['value' => 0]),
                    'cost' => $product->price,
                    'weight' => $product->weight ?? 1000,
                    'amount' => $product->quantity,
                ]);

        }

        $cdek_order = BaseTypes\Order::create([
            'number' => (string)$order->id,
            'tariff_code' => '368',
            'recipient' => BaseTypes\Contact::create([
                'name' => $order->name,
                'phones' => [
                    BaseTypes\Phone::create(['number' => $order->phone])
                ]
            ]),
            'shipment_point' => 'YARS4',
            // формат "KSD19"
            'delivery_point' => $order->pvzcode,
            //'delivery_point' => 'KSD19', // временно, для тестов

            
            'packages' => [
                BaseTypes\Package::create([
                    'number' => (string)$order->id,
                    'weight' => $this->Weight,
                    'length' => $this->Length,
                    'width' => $this->Width,
                    'height' => $this->Height,
                    'items' => $cart_items,
                ])
            ],
        ]);
        $result = $cdek->orders()->add($cdek_order);
        if (!$result->isOk()) {
            \Log::info('SDEK API ошибка', [
                'body' => $result->getBody(), // Это, видимо, строка с JSON-ответом от API
            ]);
        }
        if ($result->isOk()) {
            $response_order = $cdek->formatResponse($result, BaseTypes\Order::class);
            sleep(2);
            $result = $cdek->orders()->get($response_order->entity->uuid);
            if ($result->isOk()) {
                $response = $cdek->formatResponse($result, \CdekSDK2\Dto\OrderInfo::class);
                $order->delivery_tracknumber = $response->entity->cdek_number;
                $order->delivery_amount = $response->entity->delivery_detail->total_sum;
            }
        }
    }

    // CDEK курьер
    public function createDelivery7(Order &$order)
    {
        $authData = $order->delivery->getApiData();
        $cdek = new \CdekSDK2\Client(new Psr18Client(), $authData[0], $authData[1]);

        
       
    if ($order->id == 122) {
        $id = random_int(1000, 9999);
        $order->status = 0;
        $order->save();
    }else{
        $id =$order->id;
    }

        $city = $order->city; // например, "Москва"

        $result = $cdek->cities()->getFiltered(['country_codes' => 'RU', 'city' => $city]);
        $cities = $cdek->formatResponseList($result, \CdekSDK2\Dto\CityList::class);



        if (!$cities) {
            Log::error("Не удалось получить код города СДЭК для: " . $city);
            return;
        }

        $cart_items = [];
        $products = $order->items;

        foreach($products as $product) {
            $product->weight ?? 1000; // Заглушка, пока у товара нет этого свойства
            $cart_items[] =
                BaseTypes\Item::create([
                    'name' => $product->name,
                    'ware_key' => $product->id,
                    'payment' => BaseTypes\Money::create(['value' => 0]),
                    'cost' => $product->price,
                    'weight' => $product->weight ?? 1000,
                    'amount' => $product->quantity,
                ]);

        }

        $cdek_order = BaseTypes\Order::create([
            'number' => (string)$id,
            'tariff_code' => '137',
            'recipient' => BaseTypes\Contact::create([
                'name' => $order->name,
                'phones' => [
                    BaseTypes\Phone::create(['number' => $order->phone])
                ]
            ]),
            'shipment_point' => 'YARS4',
            'to_location' => Location::create([
                'code' => $cities->items[0]->code,
                'address' => $order->address,
                'country_code' => 'RU',
            ]),

            'packages' => [
                BaseTypes\Package::create([
                    'number' => (string)$order->id,
                    'weight' => $this->Weight,
                    'length' => $this->Length,
                    'width' => $this->Width,
                    'height' => $this->Height,
                    'items' => $cart_items,
                ])
            ],
        ]);
        $result = $cdek->orders()->add($cdek_order); 
        //\Log::info(['result'=>$result]);

        if ($result->isOk()) {
            $response_order = $cdek->formatResponse($result, BaseTypes\Order::class);
            sleep(2);
            $result = $cdek->orders()->get($response_order->entity->uuid);
            if ($result->isOk()) {
                $response = $cdek->formatResponse($result, \CdekSDK2\Dto\OrderInfo::class);
                $order->delivery_tracknumber = $response->entity->cdek_number;
                //\Log::info(['delivery_tracknumber'=>$order->delivery_tracknumber]);
                $order->delivery_amount = $response->entity->delivery_detail->total_sum;
            }
        }
    }

    // Яндекс
    public function createDelivery3(Order &$order)
    {
        $yd_api = new YDApi($order->delivery->getApiData());

        $billing_info = [
            'payment_method' => 'already_paid',
        ];
        $destination = [
            'type' => 'platform_station',
            'platform_station' => [
                'platform_id' => $order->pvzcode,
            ],
        ];
        $info = [
            'operator_request_id' => (string)$order->id,
        ];
        $items = [];
        $products = $order->items;
        if ($order->id == 132) {
            $id = random_int(1000, 9999);
            $order->status = 0;
            $order->save();
        }else{
            $id =$order->id;
        }

        foreach($products as $product) {
            $items[] = [
                'article' => (string)$product->id,
                'billing_details' => [
                    'assessed_unit_price' => $product->price * 100,
                    'unit_price' => $product->price * 100,
                ],
                'count' => $product->quantity,
                'name' => $product->name,
                'place_barcode' => (string)$id,
            ];
        }

        

        $places[] = [
            'barcode' => (string)$id,
            'physical_dims' => [
                'dx' => $this->Length,
                'dy' => $this->Height,
                'dz' => $this->Width,
                'weight_gross' => $this->Weight,
            ],
        ];
        $last_mile_policy = 'self_pickup';
        $recipient_info = [
            'first_name' => $order->name,
            'phone' => $order->phone,
        ];
        $source = [
            'platform_station' => [
                'platform_id' => '77cc1f81-b5f0-46dd-949b-0a5b0c109b9b',
            ],
        ];

        $yd_order = compact('billing_info', 'destination', 'info', 'items', 'last_mile_policy', 'places', 'recipient_info', 'source');

        try {
            \Log::info('Перед offersCreate', ['order_id' => $order->id, 'yd_order' => $yd_order]);

            $result = $yd_api->offersCreate($yd_order);

            \Log::info('YA result', ['result' => $result]);

            if (!isset($result[0]['offer_id'])) {
                throw new \Exception('offer_id отсутствует в ответе от Яндекса');
            }

            $order->delivery_tracknumber = $yd_api->offersConfirm($result[0]['offer_id']);
            $order->delivery_amount = str_replace(' RUB', '', $result[0]['offer_details']['pricing_total']);
        } catch (\Throwable $e) {
            \Log::error("Ошибка YA-доставки для заказа {$order->id}: " . $e->getMessage());
            \Log::error($e->getTraceAsString());
        }
        
    }
    public function createDelivery8(Order &$order)
    {
        $yd_api = new YDApi($order->delivery->getApiData());

        $billing_info = [
            'payment_method' => 'already_paid',
        ];

        $destination = [
            'type' => 2,
            'custom_location' => [
                'details' => [
                    'country' => 'Россия',
                    'full_address' => $order->address,
                    'locality' => $order->city,
                    'street' => $order->street ?? '',
                    'house' => $order->house ?? '1',
                    'apartment' => $order->apartment ?? '12',
                ],
            ],
        ];

        $info = [
            'operator_request_id' => (string)$order->id,
        ];

        $items = [];
        $products = $order->items;

        // Для заказа с id=133 генерируем уникальный id для place_barcode и сбрасываем статус
        if ($order->id == 133) {
            $id = (string)random_int(1000, 9999);
            $order->status = 0;
            $order->save();
        } else {
            $id = (string)$order->id;
        }

        foreach ($products as $product) {
            $items[] = [
                'article' => (string)$product->id,
                'billing_details' => [
                    'assessed_unit_price' => (int)($product->price * 100),
                    'unit_price' => (int)($product->price * 100),
                ],
                'count' => (int)$product->quantity,
                'name' => $product->name,
                'place_barcode' => $id,
            ];
        }

        $places = [
            [
                'barcode' => $id,
                'physical_dims' => [
                    'dx' => (int)$this->Length,
                    'dy' => (int)$this->Height,
                    'dz' => (int)$this->Width,
                    'weight_gross' => (int)$this->Weight,
                ],
            ],
        ];

        $last_mile_policy = 'time_interval';

        $recipient_info = [
            'first_name' => $order->name,
            'phone' => $order->phone,
        ];

        $source = [
            'platform_station' => [
                'platform_id' => '77cc1f81-b5f0-46dd-949b-0a5b0c109b9b',
            ],
        ];

        $yd_order = compact(
            'billing_info',
            'destination',
            'info',
            'items',
            'last_mile_policy',
            'places',
            'recipient_info',
            'source'
        );

        try {
            \Log::info('Перед offersCreate (курьер)', ['order_id' => $order->id, 'yd_order' => $yd_order]);

            $result = $yd_api->offersCreate($yd_order);

            \Log::info('YA result', ['result' => $result]);

            if (empty($result) || !isset($result[0]['offer_id'])) {
                throw new \Exception('offer_id отсутствует в ответе от Яндекса');
            }

            $order->delivery_tracknumber = $yd_api->offersConfirm($result[0]['offer_id']);
            $order->delivery_amount = str_replace(' RUB', '', $result[0]['offer_details']['pricing_total']);
        } catch (\Throwable $e) {
            \Log::error("Ошибка YA-доставки (курьер) для заказа {$order->id}: " . $e->getMessage());
            \Log::error($e->getTraceAsString());
        }
    }


    // Почта России
    public function createDelivery4(Order &$order)
    {
        $otpravkaApi = new OtpravkaApi($order->delivery->getApiData());
        $list = $otpravkaApi->shippingPoints();

        $orders = [];
        $rp_order = new RussianPostOrder();
        $rp_order->setIndexTo($this->clearedAddress['index']);
        $rp_order->setPostOfficeCode($list[0]['operator-postcode']);
        $rp_order->setHeight($this->Height);
        $rp_order->setLength($this->Length);
        $rp_order->setWidth($this->Width);
        $rp_order->setMass($this->Weight);
        $rp_order->setOrderNum($order->id);
        $rp_order->setRecipientName($order->name);
        $rp_order->setRegionTo($this->clearedAddress['region']);
        $rp_order->setPlaceTo($this->clearedAddress['place']);
        $rp_order->setStreetTo($this->clearedAddress['street']);
        $rp_order->setHouseTo($this->clearedAddress['house']);
        //$rp_order->setCorpusTo('3');
        //$rp_order->setRoomTo('1');

        $rp_order->setMailCategory('ORDINARY'); // https://otpravka.pochta.ru/specification#/enums-base-mail-category
        $rp_order->setMailType('ONLINE_PARCEL'); // https://otpravka.pochta.ru/specification#/enums-base-mail-type

        $orders[] = $rp_order->asArr();

        $result = $otpravkaApi->createOrdersV2($orders);
        \Log::info(['Почта result' => $result]);
        $order->delivery_tracknumber = $result['orders'][0]['barcode'];
        $result = $otpravkaApi->findOrderById($result['orders'][0]['result-id']);
        $order->delivery_amount = round($result['ground-rate-with-vat'] / 100, 2);


    }

    // Boxberry
    public function createDelivery5(Order &$order)
    {
        $bbClient = new \WildTuna\BoxberrySdk\Client(120, 'https://api.boxberry.ru/json.php');
        
        
        $bbClient->setToken('main', $order->delivery->getApiData()); // Заносим токен BB и присваиваем ему ключ main
        
        $bbClient->setCurrentToken('main');

        if ($order->id == 125) {
            $id = random_int(1000, 9999);
            $order->status = 0;
            $order->save();
        }else{
            $id =$order->id;
        }

        $bb_order = new \WildTuna\BoxberrySdk\Entity\Order();
        //$bb_order->setVid(\WildTuna\BoxberrySdk\Entity\Order::PVZ); // Тип доставки (1 - ПВЗ, 2 - КД, 3 - Почта России)
        $bb_order->setVid(1); // Тип доставки (1 - ПВЗ, 2 - КД, 3 - Почта России)
        $bb_order->setPvzCode($order->pvzcode);
        $bb_order->setOrderId((string)$id); // ID заказа в ИМ
        $bb_order->setValuatedAmount($order->amount); // Объявленная стоимость
        $bb_order->setPointOfEntry(76401); // Код пункта поступления

        $customer = new \WildTuna\BoxberrySdk\Entity\Customer();
        $customer->setFio($order->name); // ФИО получателя
        $customer->setPhone($order->phone); // Контактный номер телефона
        $customer->setEmail($order->email); // E-mail для оповещений


        //$customer->setIndex(115551); // Почтовый индекс получателя (не заполянется, если в ПВЗ)
        //$customer->setCity('Москва'); // (не заполянется, если в ПВЗ)
        //$customer->setAddress('Москва, ул. Маршала Захарова, д. 3а кв. 1'); // Адрес доставки (не заполянется, если в ПВЗ)
        //$customer->setTimeFrom('10:00'); // Время доставки от
        //$customer->setTimeTo('18:00'); // Время доставки до
        //$customer->setTimeFromSecond('10:00'); // Альтернативное время доставки от
        //$customer->setTimeToSecond('18:00'); // Альтернативное время доставки до
        //$customer->setDeliveryTime('С 10 до 19, за час позвонить'); // Время доставки текстовый формат

        $bb_order->setCustomer($customer);

        // Создаем места в заказе
        $place = new \WildTuna\BoxberrySdk\Entity\Place();
        $place->setWeight($this->Weight); // Вес места в граммах
        $bb_order->setPlaces($place);

        // Создаем товары
        $products = $order->items;

        foreach($products as $product) {
            $item = new \WildTuna\BoxberrySdk\Entity\Item();
            $item->setId($product->id); // ID товара в БД ИМ'
            $item->setName($product->name); // Название товара
            $item->setAmount($product->price); // Цена единицы товара
            $item->setQuantity($product->quantity); // Количество
            $item->setVat(20); // Ставка НДС
            $item->setUnit('шт'); // Единица измерения
            $bb_order->setItems($item);
        }
        $bb_order->setSenderName('ООО Ромашка'); // Наименование отправителя
        $bb_order->setIssue(\WildTuna\BoxberrySdk\Entity\Order::TOI_DELIVERY_WITH_OPENING_AND_VERIFICATION); // вид выдачи (см. константы класса)
        // \Log::info(['bb_order' => $bb_order]);
        // \Log::info(['bb_client' => $bbClient]);
        
        try {
            $response = $bbClient->createOrder($bb_order);
            \Log::info('Boxberry response raw: ' . json_encode($response));

            if (isset($response['track'])) {
                $order->delivery_tracknumber = $response['track'];
            } else {
                \Log::warning('Boxberry response does not contain "track"');
            }

        } catch (\Exception $e) {
            \Log::error('Boxberry Exception: ' . $e->getMessage());

            if (method_exists($e, 'getResponse') && $e->getResponse()) {
                $body = (string) $e->getResponse()->getBody();
                \Log::error('Boxberry response body: ' . $body);
            }

            throw $e;
        }

        //dd($bb_order);
        $order->delivery_tracknumber = $result['track'];
        //$result = $bbClient->createOrdersTransferAct([$result['track']]);
        $order->delivery_amount = $this->calculate5($order->delivery);
    }

    // Vozovozov
public function createDelivery6(Order &$order)
{
    $api = new VozovozApi($order->delivery->getApiData());
    // dd($order)
    

    $scheduleResponse = $api->request('schedule', 'get', [
        'dispatch' => [
            'terminal' => 'Ярославль, пр-т Московский, 115',
            'location' => 'Ярославль, пр-т Московский, 115',

        ],
        'destination' => [
             'terminal' => $order->address,
            'location' => $order->address,
        ]
    ]);
    $schedule = $scheduleResponse['response'];

    // Выбираем первую доступную дату отправки 
    $dispatchDate = array_key_first($schedule);
    $dispatchInfo = $schedule[$dispatchDate];

    // Выбираем первый доступный вариант доставки
    $deliveryOption = array_key_first($dispatchInfo['destination']);
    $deliveryDates = $dispatchInfo['destination'][$deliveryOption];

    // Выбираем первую доступную дату доставки
    $deliveryDate = array_key_first($deliveryDates);
    $deliveryTime = $deliveryDates[$deliveryDate];

    // Берем первую доступную дату отправки
    $firstAvailableDate = array_key_first($schedule);
    $firstDateData = $schedule[$firstAvailableDate];

    // Берем первое доступное временное окно для выбранной даты
    $firstTimeWindow = array_key_first($firstDateData['destination']);
    $destinationDates = $firstDateData['destination'][$firstTimeWindow];

    // Берем первую доступную дату доставки
    $firstDeliveryDate = array_key_first($destinationDates);
    $deliveryDateData = $destinationDates[$firstDeliveryDate];


    $params = [
        'cargo' => [
            'dimension' => [
                'max' => [
                    'height' => $this->Height / 100,
                    'length' => $this->Length / 100,
                    'width' => $this->Width / 100,
                    'weight' => $this->Weight / 1000,
                ],
                'quantity' => 1,
                'volume' => round(($this->Length / 100) * ($this->Width / 100) * ($this->Height / 100), 5),
                'weight' => $this->Weight / 1000
            ],
        ],
        'gateway' => [
            'dispatch' => [
                'point' => [
                    'location' => 'Ярославль, пр-т Московский, 115',
                    'terminal' => 'Ярославль, пр-т Московский, 115',
                    'date' => $dispatchDate,
                    'time' => [
                        'start' => $dispatchInfo['time'],
                        'end' => $dispatchInfo['time'],
                    ],
                ],
                'customer' => [
                    'email' => 'AlfaBullsKennel@yandex.ru',
                    'type' => 'individual',
                    'name' => 'Сестров Дмитрий Викторович',
                    'phone' => '79807427894',
                ],
            ],
            'destination' => [
                'point' => [
                    'location' => $order->address,
                    'terminal' => $order->address,
                    'date' => $deliveryDate,
                    'time' => [
                        'start' => $deliveryTime,
                        'end' => $deliveryTime,
                    ],
                ],
                'customer' => [
                    'email' => $order->email,
                    'type' => 'individual',
                    'name' => $order->name,
                    'phone' => $order->phone,
                ],
            ],
        ],
        // Дополнительные параметры из примера
        'payer' => 'dispatch', // Кто оплачивает (отправитель)
        'customId' => 'ORDER-' . $order->id,
    ];

    try {
        $result = $api->request('order', 'set', $params);
        \Log::info(['Vozovoz API OK: ' => $result]);

        if (isset($result['error'])) {
            throw new \Exception("Vozovoz API Error: " . $result['error']['message']);
        }

        $order->delivery_tracknumber = $result['response']['number'];
        $order->delivery_amount = $result['response']['price'];
        return $result;
        
    } catch (\Exception $e) {
        \Log::error('Vozovoz delivery error: ' . $e->getMessage());
        throw $e;
    }
}


}
