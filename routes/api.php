<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
   // return $request->user();
//});
Route::namespace('API')->group(function () {
Route::post('login', 'LoginController@login')->name('login');
Route::post('/register', 'CustomerController@customer_register')->name('register');
Route::get('/string', 'CustomerController@quickRandom')->name('string');

Route::post('/checksum', 'RechargeController@checksum')->name('checksum');
Route::post('/recharge', 'RechargeController@pay_recharge')->name('recharge');
Route::post('/payment/success', 'RechargeController@payment_success')->name('/payment/success'); 

Route::post('/opraterlist', 'OpratorController@oprater_list')->name('opraterlist');
Route::get('/masterlist', 'OpratorController@oprater_master')->name('masterlist');

Route::get('/bannerlist', 'BannerController@banner')->name('bannerlist');
Route::get('/offerbannerlist', 'BannerController@offer_banner')->name('offerbannerlist');

Route::post('/paymentlist', 'PaymenHistoryController@payment_history')->name('paymentlist');
Route::post('/share', 'PaymenHistoryController@share_referal')->name('share');
Route::post('/walletlist', 'PaymenHistoryController@wallet_amount')->name('walletlist');
Route::post('/wallethistory', 'PaymenHistoryController@wallethistory')->name('wallethistory');

Route::post('/wallettowallet', 'RechargeController@wallet_to_wallet')->name('wallettowallet');
Route::post('/without/pay/recharge', 'WithoutPayRecharge@withoutpay_recharge')->name('/without/pay/recharge');


Route::get('/newslist', 'NewController@news_history')->name('newslist');
Route::post('/recpaymentlist', 'NewController@recieved_credit')->name('recpaymentlist');

Route::post('/profile', 'CustomerProfile@changeprofile')->name('profile');

Route::post('/changepassword', 'CustomerProfile@changepassword')->name('changepassword');
Route::post('/forgot/password', 'ForgotPasswordController@forgot_password')->name('/forgot/password');
Route::post('/customer_profile', 'CustomerProfile@profile')->name('customer_profile');
Route::post('/profile_update', 'CustomerProfile@profile_update')->name('profile_update');

Route::post('/receiptlist', 'NewController@receipt_list')->name('receiptlist');
Route::post('/planlist', 'PlanController@plan_list')->name('planlist');

Route::post('/packagelist', 'PlanController@package_list')->name('packagelist');

Route::post('/operatorbanner_list', 'OperatorBanner@OperatorBanner_list')->name('operatorbanner_list');

Route::get('/active-payment-gateway', 'SwitchingController@get_switch_gateway')->name('active-payment-gateway');

Route::post('/gateway-status-update', 'SwitchingController@payment_gateway_status')->name('gateway-status-update');

});	
