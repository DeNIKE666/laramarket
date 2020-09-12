<?php

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

Route::post('/comission/payin', 'ComissionsPayInOutController@getPayinFee')->name('get-payin-fee');
Route::post('/comission/payout', 'ComissionsPayInOutController@getPayoutFee')->name('get-payout-fee');

//Route::get('/comission/payin', function () {
//    $comission = (new \App\Services\Comission())
//        ->amount(1000)
//        ->payMethod(1000)
//        ->withdrawComission('QIWI');
//
//    dd($comission);
//});

Route::get('/', 'FrontController@index')->name('front.index');
Route::get('/about', 'FrontController@about')->name('front.about');

//Route::get('{seller}/catalog', function (\Illuminate\Http\Request $request) {
//    dump($request);
//});
//
//Route::get('{seller}/{partner}/catalog', function (\Illuminate\Http\Request $request) {
//    dump($request);
//});

Route::get('catalog/{slug}', 'CatalogController@index')
    ->where('slug', '[a-zA-Z0-9/_-]+')
    ->name('front_catalog');


Route::get('product/{path}', 'FrontController@product')
    ->where('path', '[a-zA-Z0-9/_-]+')->name('front_product');

Auth::routes();

Route::get('/logout', 'AuthController@logout');
Route::get('/join/{partner_token}', 'Auth\RegisterController@rememberPartnerToken')->name('join');

/**
 * Работа корзины
 */
Route::group(
    [
        'prefix' => 'shop',
        'as'     => 'cart.',
    ],
    function () {
        Route::get('/cart', 'CartController@cart')->name('index');
        Route::post('/add', 'CartController@add')->name('store');
        Route::post('/update', 'CartController@update')->name('update');
        Route::post('/remove', 'CartController@removeItem')->name('remove');
        //Route::post('/clear', 'CartController@clearCart')->name('clear');
    }
);

Route::group(
    [
        'prefix'     => 'dashboard/user',
        'namespace'  => 'Dashboard\User',
        'middleware' => ['auth'],
        'as'         => 'user.',
    ],
    function () {
        //Тикеты
        Route::resource('/tasks', 'TaskController');

        Route::patch('/become-partner', 'ProfileController@becomePartner')->name('become-partner');
        Route::get('/application-to-seller', 'ProfileController@applicationToSeller')->name('application-to-seller');
        Route::post('/application-to-seller', 'ProfileController@storeApplicationToSeller')->name('store-application-to-seller');
    }
);

/**
 * Раздел покупателя
 */
Route::group(
    [
        'prefix'     => 'dashboard/buyer',
        'namespace'  => 'Dashboard\Buyer',
        'middleware' => ['auth'],
        'as'         => 'buyer.',
    ],
    function () {
        #################### ПРОФИЛЬ ####################
        //Редактирование профиля
        Route::get('/', 'ProfileController@edit')->name('profile.edit');
        Route::patch('/profile/update', 'ProfileController@update')->name('profile.update');


        #################### ЗАКАЗЫ ####################
        //Список заказов
        Route::get('/orders', 'OrderController@index')->name('orders');
        Route::get('/orders/archive', 'OrderController@archive')->name('orders.archive');


        //Оформление заказа
        Route::get('/order/checkout-form', 'OrderController@checkoutForm')->name('order.checkout_form');
        Route::post('/order/store', 'OrderController@store')->name('order.store');

        //Оплата заказа
        Route::get('/order/pay/{order}/{paySystem}', 'OrderController@showPayForm')->name('order.show_pay_form');
        //Оплата картой
        Route::post('/order/pay/{order}/card', 'OrderController@payViaCard')->name('order.pay_via_card');
        Route::post('/order/pay/{order}/card/callback/{externalPayment}', 'OrderController@payViaCardCallback')->name('order.pay_via_card_callback');

        //Изменить статус заказа
        Route::patch('/order/{order}/status', 'OrderController@changeStatus')->name('order.change_status');

        #################### ФИНАНСЫ ####################
        //Пополнение и вывод
        Route::get('/finance/deposit-withdraw', 'FinanceController@depositOrWithdrawForm')->name('finance.deposit_withdraw');
        //Пополнение картой
        Route::post('/finance/deposit/card', 'FinanceController@depositViaCard')->name('finance.deposit_via_card');
        Route::post('/finance/deposit/{user}/card/callback/{externalPayment}', 'FinanceController@depositViaCardCallback')->name('finance.deposit_via_card_callback');


        //Вывод средств
        Route::post('/finance/withdraw', 'FinanceController@withdraw')->name('finance.withdraw');

        //История движения средств
        Route::get('/finance/history/personal', 'FinanceController@historyOfPersonalAccount')->name('finance.history.personal-account');
        Route::get('/finance/history/cashback', 'FinanceController@historyOfCompletedCashback')->name('finance.history.cashback-account');

        //Route::get('/data_seller', 'UserController@data_seller')->name('data_seller');
//        Route::resource('/messages', 'MessageController');
//

        //Route::get('summernote',array('as'=>'summernote.get','uses'=>'FileController@getSummernote'));
        //Route::post('ckeditor/image_upload','CKEditorController@upload')->name('upload');
    }
);

/**
 * Функционал админа сайта
 */
Route::group(
    [
        'prefix'     => 'dashboard/admin',
        'namespace'  => 'Dashboard\Admin',
        'middleware' => ['auth', 'admin'],
        'as'         => 'admin.',
    ],
    function () {
        Route::get('/', 'AdminController@index')->name('home');
        Route::get('/users', 'AdminController@getUsers')->name('users');
        Route::get('/user/{id}', 'AdminController@infoUser')->name('info_user');
        Route::get('/request_seller', 'AdminController@index')->name('request_seller');
        Route::put('/approve-as-seller', 'AdminController@approveAsSeller')->name('approve-as-seller');
        Route::get('/orders', 'AdminController@orders')->name('orders');

        Route::resource('/settings', 'SettingController');
        Route::resource('/setting_schedules', 'PaymentScheduleController');
        Route::resource('/attributes', 'AttributeController');
        Route::resource('/payment_option', 'PaymentOptionController');
        Route::resource('/page', 'PageController');

        Route::get('/clear-cache', function () {
            Artisan::call('cache:clear');
            return redirect()->back();
        })->name('clear-cache');
    }
);

/**
 * Функционал продавца
 */
Route::group(
    [
        'prefix'     => 'dashboard/seller',
        'namespace'  => 'Dashboard\Seller',
        'middleware' => ['auth', 'seller'],
    ],
    function () {
        Route::resource('/categories', 'CategoryController');
        Route::resource('/products', 'ProductController');
        Route::group(
            [
                'as' => 'products.',
            ],
            function () {
                Route::patch('/change-status/{status}', 'ProductController@changeStatus')->name('change-status');
                Route::get('/change-status-all/{status}', 'ProductController@changeStatusAll')->name('change-status-all');
                Route::delete('/change-delete/', 'ProductController@changeDelete')->name('change-delete');
            }
        );
        Route::post('/products/attributes', 'ProductController@getAttributeProduct')->name('product_attributes');

        Route::group(
            [
                'prefix' => 'categories/{category}',
                'as'     => 'categories.',
            ],
            function () {
                Route::post('/first', 'CategoryController@first')->name('first');
                Route::post('/up', 'CategoryController@up')->name('up');
                Route::post('/down', 'CategoryController@down')->name('down');
                Route::post('/last', 'CategoryController@last')->name('last');
            }
        );

        Route::group(
            [
                'prefix' => 'order',
                'as'     => 'order.',
            ],
            function () {
                Route::get('/list', 'OrderShopController@index')->name('list');
                Route::get('/list/in-progress', 'OrderShopController@listInProgress')->name('list.in-progress');
                Route::patch('/{order}/status', 'OrderShopController@changeStatus')->name('change-status');
                Route::get('/item/{order}', 'OrderShopController@detail')->name('detail');
            }
        );

        Route::get('/', 'SellerController@seller_status')->name('seller_status');
        Route::get('/data_sellers', 'SellerController@data_sellers')->name('data_sellers');
    }
);

/**
 * Функционал партнера
 */
Route::group(
    [
        'prefix'     => 'dashboard/partner',
        'namespace'  => 'Dashboard\Partner',
        'middleware' => ['auth', 'partner'],
        'as'         => 'partner.',
    ],
    function () {
        Route::get('/', 'PartnerController@index')->name('index');
        Route::get('/referrals', 'PartnerController@referrals')->name('referrals');
        Route::get('/history-account', 'PartnerController@historyAccount')->name('history-account');
        Route::patch('/account/transfer-to-personal-account', 'PartnerController@transferToPersonalAccount')->name('transfer-to-personal-account');
    }
);

Route::post('gallery/media', 'Dashboard\DashboardController@storeMedia')->name('gallery');

Route::get('/{slug}/', 'FrontController@pageStatic')->name('page_static');