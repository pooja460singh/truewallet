<?php
Route::namespace('Admin')->group(function () {  
Route::get('payment/history', 'PaymentController@index')->name('payment/history');

Route::post('front/recharge', 'AdminController@mobileRecharge')->name('front/recharge');
Route::post('front/payment', 'AdminController@mobilepayment')->name('front/payment');
Route::get('recharge/report', 'PaymentController@recharge_report')->name('recharge/report');

});
?>