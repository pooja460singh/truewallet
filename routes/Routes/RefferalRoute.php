<?php
Route::group(['middleware' => 'auth'], function (){
Route::namespace('Admin')->group(function () {  
Route::get('refferal', 'RefferalController@index')->name('refferal');
});
});
?>