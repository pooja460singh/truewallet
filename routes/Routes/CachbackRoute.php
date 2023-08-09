<?php
Route::group(['middleware' => 'auth'], function (){
Route::namespace('Admin')->group(function () {  
Route::get('cashback', 'CashbackController@index')->name('cashback');
Route::post('cashback/add', 'CashbackController@addCashback')->name('cashback/add');
Route::get('cashback/edit/{id}', 'CashbackController@editCashback')->name('cashback/edit/{id}');
Route::post('cashback/update', 'CashbackController@updateCashback')->name('cashback/update');
});
});
?>