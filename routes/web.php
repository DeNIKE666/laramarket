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

Route::get('/','FrontController@index')->name('front_index');
Route::get('catalog/{path}', 'FrontController@catalog')
    ->where('path', '[a-zA-Z0-9/_-]+')->name('front_catalog');
Route::get('product/{path}', 'FrontController@product')
    ->where('path', '[a-zA-Z0-9/_-]+')->name('front_product');

Auth::routes();

/*
Route::get('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@showLoginForm']);
Route::post('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@login']);
Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@logout']);

// Registration Routes...
//Route::get('register', ['as' => 'auth.register', 'uses' => 'AuthController@showRegistrationForm']);
Route::post('register', ['as' => 'auth.register', 'uses' => 'AuthController@register']);

// Password Reset Routes...
Route::get('password/reset/{token?}', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@showResetForm']);
Route::post('password/email', ['as' => 'auth.password.email', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
Route::post('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@reset']);*/

Route::get('/logout', 'AuthController@logout');
//Route::get('/register}', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::get('/join/{partner_token}', 'Auth\RegisterController@rememberPartnerToken')->name('join');

/**
 * Оформление заказа
 */


Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', 'CheckoutController@getCheckout')->name('checkout');
    Route::post('/checkout/order/', 'CheckoutController@placeOrder')->name('placeOrder');
    Route::any('/checkout/order/{id}/{payMethod}', 'CheckoutController@infoOrder')->name('infoOrder');
});

/**
 * Работа корзины
 */
Route::group(
    [
        'prefix' => 'shop',
        'as' => 'cart.',
    ],
    function () {
        Route::get('/cart', 'CartController@cart')->name('index');
        Route::post('/add', 'CartController@add')->name('store');
        Route::post('/update', 'CartController@update')->name('update');
        Route::post('/remove', 'CartController@removeItem')->name('remove');
        //Route::post('/clear', 'CartController@clearCart')->name('clear');
    }
);

/**
 * Раздел покупателя в админке
 */
Route::group(
    [
        'prefix' => 'dashboard/buyer',
        'namespace' => 'Dashboard',
        'middleware' => 'auth'
    ],
    function () {
        //Route::get('/', 'DashboardController@index')->name('adminIndex');
        Route::get('/index', 'UserController@edit_profile')->name('adminIndex');
        Route::put('/edit_profile', 'UserController@edit_profile_data')->name('edit_profile_data');
        Route::patch('/become-partner', 'UserController@becomePartner')->name('become-partner');
        Route::get('/application-to-seller', 'UserController@application_to_sellers')->name('application-to-seller');
        Route::put('/application-to-seller', 'UserController@storeApplicationToSeller')->name('store-application-to-seller');
        //Route::get('/data_seller', 'UserController@data_seller')->name('data_seller');

        Route::resource('/tasks', 'TaskController');
        Route::resource('/messages', 'MessageController');

        Route::get('/orders', 'UserController@listOrder')->name('user_orders_list');
        Route::patch('/order/{order}/status', 'UserController@changeStatus')->name('user_change_status');
        Route::get('/history_orders', 'UserController@historyOrder')->name('user_history_order');
        Route::get('/list_cashback', 'UserController@userCashback')->name('user_list_cashback');
        Route::get('/user_pay', 'UserController@userPay')->name('user_pay');

        Route::post('/withdraw' , 'UserController@withdraw')->name('withdraw');
        Route::get('/history/withdraw' , 'UserController@histroryWithdraw')->name('history.withdraw');

        Route::prefix('payment')->group(function () {
            Route::post('/visa' , 'QiwiController@pay')->name('qiwi.pay');
            Route::post('/visa/order/{order}' , 'QiwiController@orderPay')->name('qiwi.order.pay');
            Route::post('/callback/visa/deposit/{orderPay}' , 'QiwiController@callback')->name('qiwi.callback');
            Route::post('/callback/visa/order/{order}/{orderPay}' , 'QiwiController@callbackOrder')->name('qiwi.callback.order');
        });

        //Route::get('summernote',array('as'=>'summernote.get','uses'=>'FileController@getSummernote'));
        //Route::post('ckeditor/image_upload','CKEditorController@upload')->name('upload');
    }
);

/**
 * функционал админа сайта
 */
Route::group(
    [
        'prefix' => 'dashboard/admin',
        'namespace' => 'Dashboard\Admin',
        'middleware' => ['auth', 'super'],
        'as' => 'admin.'
    ],
    function () {
        Route::get('/index', 'AdminController@index')->name('home');
        Route::get('/users', 'AdminController@getUsers')->name('users');
        Route::get('/user/{id}', 'AdminController@infoUser')->name('info_user');
        Route::get('/request_seller', 'AdminController@index')->name('request_seller');
        Route::put('/approve-as-seller', 'AdminController@approveAsSeller')->name('approve-as-seller');
        Route::get('/orders', 'AdminController@orders')->name('orders');

        Route::resource('/settings', 'SettingController');
        Route::resource('/setting_schedules', 'PaymentScheduleController');
        Route::resource('/attributes', 'AttributeController');
        Route::resource('/payment_option', 'PaymentOptionController');

        Route::get('/clear-cache', function() {
            Artisan::call('cache:clear');
            return redirect()->back();
        })->name('clear-cache');
    }
);

/**
 * функционал продавца
 */
Route::group(
    [
        'prefix' => 'dashboard/shop',
        'namespace' => 'Dashboard\Shop',
        'middleware' => ['auth', 'shop'],
    ],
    function () {
        Route::resource('/categories', 'CategoryController');
        Route::resource('/products', 'ProductController');

        Route::post('/products/attributes', 'ProductController@getAttributeProduct')->name('product_attributes');

        Route::group(
            [
                'prefix' => 'categories/{category}',
                'as' => 'categories.',
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
                'as' => 'order.',
            ],
            function () {
                Route::get('/list', 'OrderShopController@index')->name('list');
                Route::get('/list/in-progress', 'OrderShopController@listInProgress')->name('list.in-progress');
                Route::patch('/{order}/status', 'OrderShopController@changeStatus')->name('change-status');
                Route::get('/item/{order}', 'OrderShopController@detail')->name('detail');
            }
        );

        Route::get('/index', 'SellerController@seller_status')->name('seller_status');
        Route::get('/data_sellers', 'SellerController@data_sellers')->name('data_sellers');
    }
);

Route::post('gallery/media', 'Dashboard\DashboardController@storeMedia')->name('gallery');
