<?php
Route::namespace('Admin')->group(function () {  
Route::group(['middleware' => 'auth'], function (){	
Route::get('payment/gateway', 'PaymentGateway@index')->name('payment/gateway');
Route::get('gateway/status/update','PaymentGateway@payment_gateway_status')->name('gateway/status/update');

});
Route::post('rozarpayment','PaymentGateway@payment')->name('rozarpayment');
Route::get('payment/view/{id}', 'PaymentGateway@payment_view')->name('payment/view');
Route::post('payment/complete', 'PaymentGateway@payment_complete')->name('payment/complete');
});
?>