<?php
Route::namespace('Front')->group(function () {  
Route::get('about', 'HomeController@about')->name('about');
Route::get('services', 'HomeController@services')->name('services');
Route::get('process', 'HomeController@process')->name('process');
Route::get('contact', 'HomeController@contact')->name('contact');
Route::get('privacy', 'HomeController@privacy')->name('privacy');
Route::get('terms-condition', 'HomeController@termscondition')->name('terms-condition');
Route::get('refund-cancellation', 'HomeController@refundrancellation')->name('refund-cancellation');
Route::get('user/login', 'HomeController@login')->name('user/login');
Route::get('user/register', 'HomeController@register')->name('user/register');

Route::get('download', 'HomeController@download')->name('download');
Route::get('postpaid/getAjaxData', 'HomeController@index')->name('postpaid/getAjaxData');
Route::get('success', 'HomeController@success')->name('success');
Route::get('forgot/password', 'HomeController@forgot_password')->name('forgot/password');
Route::get('failed', 'HomeController@failed')->name('failed');
Route::get('app-success', 'HomeController@app_success')->name('app-success');
Route::get('app-recharge-failed', 'HomeController@app_recharge_failed')->name('app-recharge-failed');
Route::get('app_payment_view/{checksum}/{str}', 'HomeController@app_payment_view')->name('app_payment_view/{$checksum}/{str}');
});
Route::post('forgot-password', 'Admin\ForgotPasswordController@forgot_password')->name('forgot-password');
?>