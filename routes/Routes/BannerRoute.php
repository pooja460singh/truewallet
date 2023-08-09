<?php
Route::group(['middleware' => 'auth'], function (){
Route::namespace('Admin')->group(function () {  
Route::get('banner', 'BannerController@index')->name('banner');
Route::post('banner/add', 'BannerController@addBanner')->name('banner/add');
Route::get('banner/edit/{id}', 'BannerController@editBanner')->name('banner/edit/{id}');
Route::post('banner/update', 'BannerController@updateBanner')->name('banner/update');
Route::get('banner/delete/{id}', 'BannerController@deleteBanner')->name('banner/delete/{id}');
});
});
?>