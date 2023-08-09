<?php
Route::group(['middleware' => 'auth'], function (){
Route::namespace('Admin')->group(function () {  
Route::get('wallettowallet', 'WalletToWalletController@index')->name('wallettowallet');
});
});
?>