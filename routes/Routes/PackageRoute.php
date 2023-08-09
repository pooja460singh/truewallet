<?php
Route::group(['middleware' => 'auth'], function (){
Route::namespace('Admin')->group(function () {  
Route::get('package', 'PackageController@index')->name('package');
Route::post('package/add', 'PackageController@add_Package')->name('package/add');
Route::get('package/edit/{id}', 'PackageController@edit_Package')->name('package/edit/{id}');
Route::post('package/update', 'PackageController@update_Package')->name('package/update');
Route::get('package/delete/{id}', 'PackageController@delete_Package')->name('package/delete/{id}');

Route::get('operator/getAjaxData', 'PackageController@get_operator')->name('operator/getAjaxData');
});
});
?>