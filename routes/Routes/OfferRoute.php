<?php
Route::group(['middleware' => 'auth'], function (){
Route::namespace('Admin')->group(function () {  
Route::get('offer', 'OfferController@index')->name('offer');
Route::post('offer/add', 'OfferController@addOffer')->name('offer/add');
Route::get('offer/edit/{id}', 'OfferController@editOffer')->name('offer/edit/{id}');
Route::post('offer/update', 'OfferController@updateOffer')->name('offer/update');
Route::get('offer/delete/{id}', 'OfferController@deleteOffer')->name('offer/delete/{id}');
});
});
?>