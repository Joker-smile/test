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

Route::get('/', 'PagesController@index')->name('index');

//支付宝支付
Route::get('alipay', 'PaymentController@payByAlipay')->name('payment.alipay');
Route::get('payment/alipay/return', 'PaymentController@alipayReturn')->name('payment.alipay.return');
Route::post('payment/alipay/notify', 'PaymentController@alipayNotify')->name('payment.alipay.notify');

//微信支付
Route::get('payment/{order}/wechat', 'PaymentController@payByWechat')->name('payment.wechat');
Route::post('payment/wechat/notify', 'PaymentController@wechatNotify')->name('payment.wechat.notify');

//信用卡支付
Route::post('payment/notify', 'PaymentController@creditCardNotify');
Route::get('payment/back', 'PaymentController@back');
Route::post('payment/ocean/check', 'PaymentController@reconciliation');

//获取实时利率
Route::get('exchange/rate', 'ExchangeRateController@exchangeRate');
Route::any('search', 'PlasticController@search')->name('plastic.search');

//spider
Route::any('spider/images', 'SpiderController@getImages');

Auth::routes();


