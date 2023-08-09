<?php
Route::group(['middleware' => 'auth'], function (){
Route::namespace('Admin')->group(function () {  
Route::get('operator/banner', 'OperatorBanner@index')->name('operator/banner');
Route::post('operator/banner/store', 'OperatorBanner@Banner_Add')->name('operator/banner/store');
Route::get('operator/banner/edit/{id}', 'OperatorBanner@edit_Banner')->name('operator/banner/edit/{id}');
Route::post('operator/banner/update', 'OperatorBanner@update_Banner')->name('operator/banner/update');
Route::get('operator/banner/delete/{id}', 'OperatorBanner@delete_Banner')->name('operator/banner/delete/{id}');

Route::get('banner/detail/{id}', 'OperatorBanner@get_Banner')->name('banner/detail/{id}');
});
});
?>