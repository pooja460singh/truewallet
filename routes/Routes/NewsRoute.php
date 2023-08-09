<?php
Route::group(['middleware' => 'auth'], function (){
Route::namespace('Admin')->group(function () {  
Route::get('news', 'NewsController@index')->name('news');
Route::post('news/add', 'NewsController@addNews')->name('news/add');
Route::get('news/edit/{id}', 'NewsController@editNews')->name('news/edit/{id}');
Route::post('news/update', 'NewsController@updateNews')->name('news/update');
Route::get('news/delete/{id}', 'NewsController@deleteNews')->name('news/delete/{id}');
});
});
?>