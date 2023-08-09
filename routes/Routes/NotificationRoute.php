<?php
Route::group(['middleware' => 'auth'], function (){
Route::namespace('Admin')->group(function () {  
Route::get('notification', 'NotificationController@index')->name('notification');
});
});
?>