<?php
Route::group(['middleware' => 'auth'], function (){
Route::namespace('Admin')->group(function () {  
Route::get('customers', 'AdminController@customerlist')->name('customers');
Route::post('customers/add', 'AdminController@customer_register')->name('customers/add');
Route::post('password/update', 'AdminController@changePassword')->name('password/update');
Route::post('profile/update', 'AdminController@editprofile')->name('profile/update');
});
});

?>