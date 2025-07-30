<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return "Кэш очищен.";
});
// temporary route to set bonus points
Route::get('/user/{user_id}/set_bonuses/{amount}', function ($user_id, $amount) {
    $user = \App\Models\User::find($user_id);
    if ($user) {
        $user->bonus_points = $amount;
        $user->save();
        return "Бонусы заданы!";
    }
    return "Бонусы не заданы";
});

Route::post('/calc_delivery', 'DeliveryController@calculate')->name('delivery.calculate');
/*
 * Главная страница интернет-магазина
 */
Route::get('/', 'IndexController')->name('index');


/*
 * Щенки страница интернет-магазина
 */
Route::get('/dogs', 'DogController')->name('dog');

/*
 * Страницы «Доставка», «Контакты» и прочие
 */
Route::get('/page/{page:slug}', 'PageController')->name('page.show');







Route::get('/contacts', function() {
    return view('contacts');
})->name('contacts');

Route::get('/pay-delivery', function() {
    return view('pay-delivery');
})->name('pay-delivery');

Route::get('/about', function() {
    return view('about');
})->name('about');

Route::get('/nursery', function() {
    return view('nursery');
})->name('nursery');

Route::get('/contacts', function() {
    return view('contacts');
})->name('contacts');


/*
 * Каталог товаров: категория, бренд и товар
 */
Route::group([
    'as' => 'catalog.', // имя маршрута, например catalog.index
    'prefix' => 'catalog', // префикс маршрута, например catalog/index
], function () {
    // главная страница каталога
    Route::get('index', 'CatalogController@index')
        ->name('index');
    // категория каталога товаров
    Route::get('category/{category:slug}', 'CatalogController@category')
        ->name('category');
    // бренд каталога товаров
    Route::get('brand/{brand:slug}', 'CatalogController@brand')
        ->name('brand');
    // страница товара каталога
    Route::get('product/{product:slug}', 'CatalogController@product')
        ->name('product');
    // страница результатов поиска
    Route::get('search', 'CatalogController@search')
        ->name('search');
});




/*
 * Корзина покупателя
 */
Route::group([
    'as' => 'basket.', // имя маршрута, например basket.index
    'prefix' => 'basket', // префикс маршрута, например basket/index
], function () {
    // список всех товаров в корзине
    Route::get('index', 'BasketController@index')
        ->name('index');
    Route::post('/apply-promo', 'BasketController@applyPromoCode')
    ->name('apply.promo');
    Route::post('ajax/change/{id}', 'BasketController@changeAjax')
    ->name('basket.ajax.change');
    // страница с формой оформления заказа
    Route::get('checkout', 'BasketController@checkout')
        ->name('checkout');
    // получение данных профиля для оформления
    Route::post('profile', 'BasketController@profile')
        ->name('profile');
    // отправка данных формы для сохранения заказа в БД
    Route::post('saveorder', 'BasketController@saveOrder')
        ->name('saveorder');
    // страница после успешного сохранения заказа в БД
    Route::get('success', 'BasketController@success')
        ->name('success');
    Route::get('fail', 'BasketController@fail')
        ->name('fail');
    // отправка формы добавления товара в корзину
    Route::post('add/{id}', 'BasketController@add')
        ->where('id', '[0-9]+')
        ->name('add');
    // отправка формы изменения кол-ва отдельного товара в корзине
    Route::post('plus/{id}', 'BasketController@plus')
        ->where('id', '[0-9]+')
        ->name('plus');
    // отправка формы изменения кол-ва отдельного товара в корзине
    Route::post('minus/{id}', 'BasketController@minus')
        ->where('id', '[0-9]+')
        ->name('minus');
    Route::post('/basket/change/{id}', 'BasketController@change')
        ->where('id', '[0-9]+')
        ->name('change');
    // отправка формы удаления отдельного товара из корзины
    Route::post('remove/{id}', 'BasketController@remove')
        ->where('id', '[0-9]+')
        ->name('remove');
    // отправка формы для удаления всех товаров из корзины
    Route::post('clear', 'BasketController@clear')
        ->name('clear');
});

/*
 * Регистрация, вход в ЛК, восстановление пароля
 */
Route::name('user.')->prefix('user')->group(function () {
    Auth::routes();
});

Route::get('/test-pay', function () {
    $order = \App\Models\Order::find(125); // ID существующего заказа
    $order->getPaymentLink();
    return redirect($order->payment_link);
});


/*
 * Личный кабинет зарегистрированного пользователя
 */
Route::group([
    'as' => 'user.', // имя маршрута, например user.index
    'prefix' => 'user', // префикс маршрута, например user/index
    'middleware' => ['auth'] // один или несколько посредников
], function () {
    // главная страница личного кабинета пользователя
    Route::get('index', 'UserController@index')->name('index');
    // CRUD-операции над профилями пользователя
    Route::resource('profile', 'ProfileController');
    // CRUD-добавить отзыв
    Route::resource('otzv', 'OtzvController');

    Route::post('/basket/change-bonus', 'BasketController@changeBonus')->name('basket.change_bonus');

    // просмотр списка заказов в личном кабинете
    Route::get('order', 'OrderController@index')->name('order.index');
    // просмотр отдельного заказа в личном кабинете
    Route::get('order/{order}', 'OrderController@show')->name('order.show');
    // Обновление аватара профиля
    Route::put('profile/{profile}/avatar', 'ProfileController@updateAvatar')
    ->name('profile.avatar.update');
});

/*
 * Панель управления магазином для администратора сайта
 */
Route::group([
    'as' => 'admin.', // имя маршрута, например admin.index
    'prefix' => 'admin', // префикс маршрута, например admin/index
    'namespace' => 'Admin', // пространство имен контроллера
    'middleware' => ['auth', 'admin'] // один или несколько посредников
], function () {
    //Route::get('/products/migrate-old-data', 'ProductMigrationController@migrate')->name('admin.products.migrate');
    // главная страница панели управления
    Route::get('index', 'IndexController')->name('index');
    // CRUD-операции над категориями каталога
    Route::patch('/category/{category}/archive', 'CategoryController@archive')->name('category.archive');
    Route::resource('category', 'CategoryController');
    Route::get('/categories/list', 'CategoryController@list');
    Route::post('/categories/save', 'CategoryController@save');
    Route::post('/categories/delete', 'CategoryController@delete');
    // CRUD-операции над брендами каталога
    Route::get('/category/get-category-sale/{id}', 'CategoryController@getSale');
    Route::post('/category/update-category-sale', 'CategoryController@updateSale');

    Route::resource('brand', 'BrandController');
    // CRUD-операции над товарами каталога
    Route::get('/product/search', 'ProductController@searchProduct')->name('product.search');
    Route::patch('/product/{product}/archive', 'ProductController@archive')->name('product.archive');

    Route::resource('product', 'ProductController');
    // CRUD-операции над товарами каталога
    Route::patch('/promo/{promo}/active', 'PromoController@active')->name('promo.active');
    Route::patch('/promo/{promo}/archive', 'PromoController@archive')->name('promo.archive');
    Route::resource('promo', 'PromoController');
    // CRUD-операции над скидочными диапазонами
    Route::resource('discount', 'DiscountController');
    // CRUD-операции над службами доставки
    Route::resource('delivery', 'DeliveryController');
    // CRUD-операции над товарами каталога
    Route::delete('dogs/media/{media}', 'DogsController@deleteMedia')->name('admin.dogs.media.delete');
    Route::get('dogs', 'DogsController@index')->name('dogs.index');          // Список щенков
    Route::get('dogs/create', 'DogsController@create')->name('dogs.create');  // Форма создания
    Route::post('dogs', 'DogsController@store')->name('dogs.store');          // Сохранение нового
    Route::get('dogs/{dog}', 'DogsController@show')->name('dogs.show');       // Просмотр одного
    Route::get('dogs/{dog}/edit', 'DogsController@edit')->name('dogs.edit');  // Форма редактирования
    Route::put('dogs/{dog}', 'DogsController@update')->name('dogs.update');   // Обновление
    Route::delete('dogs/{dog}', 'DogsController@destroy')->name('dogs.destroy');// Удаление
    Route::post('statistic/filter', 'StatisticController@filter')->name('statistic.filter');
    Route::get('statistic/sources', 'StatisticController@sources')->name('statistic.sources');
    Route::get('statistic/remains', 'StatisticController@remains')->name('statistic.remains');
    Route::get('statistic', 'StatisticController@index')->name('statistic.index');
    Route::get('chartData', 'StatisticController@chartData')->name('statistic.chartData');
    Route::get('pieData', 'StatisticController@pieData')->name('statistic.pieData');
    Route::get('reviews', 'OtzvController@index')->name('reviews.index');
    Route::get('reviews/create', 'OtzvController@create')->name('reviews.create');
    Route::post('reviews/store', 'OtzvController@store')->name('reviews.store');
    Route::post('/reviews/{id}/archive', 'OtzvController@archive')->name('reviews.archive');
    Route::post('/reviews/{id}/approve', 'OtzvController@approve')->name('reviews.approve');
    Route::post('/reviews/{id}', 'OtzvController@destroy')->name('reviews.destroy');
    
    // доп.маршрут для показа товаров категории
    Route::get('product/category/{category}', 'ProductController@category')
        ->name('product.category');
    Route::get('/order/search', 'OrderController@searchOrder')->name('order.search');
    Route::get('/order/stats','OrderController@getOrderStats')->name('order.stats');

    
    // просмотр и редактирование заказов
    Route::resource('order', 'OrderController', ['except' => [
        'create', 'store', 'destroy',
    ]]);
    
    Route::get('/orders/{order}/details','OrderController@details')->name('order.details');
    
    Route::get('/user/search', 'UserController@searchUser')->name('user.search');
    // просмотр и редактирование пользователей
    Route::resource('user', 'UserController', ['except' => [
        'create', 'store', 'show', 'destroy'
    ]]);
    // CRUD-операции над страницами сайта
    Route::resource('page', 'PageController');
    // загрузка изображения из wysiwyg-редактора
    Route::post('page/upload/image', 'PageController@uploadImage')
        ->name('page.upload.image');
    // удаление изображения в wysiwyg-редакторе
    Route::delete('page/remove/image', 'PageController@removeImage')
        ->name('page.remove.image');
});
