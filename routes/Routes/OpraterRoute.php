<?php
Route::group(['middleware' => 'auth'], function (){
Route::namespace('Admin')->group(function () {  
Route::get('oprater', 'OpraterController@index')->name('oprater');
Route::post('oprater/add', 'OpraterController@addOprater')->name('oprater/add');
Route::get('oprater/edit/{id}', 'OpraterController@editOprater')->name('oprater/edit/{id}');
Route::post('oprater/update', 'OpraterController@updateOprater')->name('oprater/update');
Route::get('oprater/delete/{id}', 'OpraterController@deleteOprater')->name('oprater/delete/{id}');
});
});
?>