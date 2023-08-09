<?php
Route::group(['middleware' => 'auth'], function (){
Route::namespace('Admin')->group(function () {  
Route::get('plan', 'PlanController@index')->name('plan');
Route::post('plan/add', 'PlanController@add_Plan')->name('plan/add');
Route::get('plan/edit/{id}', 'PlanController@edit_Plan')->name('plan/edit/{id}');
Route::post('plan/update', 'PlanController@update_Plan')->name('plan/update');
Route::get('plan/delete/{id}', 'PlanController@delete_Plan')->name('plan/delete/{id}');

Route::get('operator/getAjaxData', 'PlanController@get_operator')->name('operator/getAjaxData');
Route::get('operatortype/getAjaxData', 'PlanController@get_operatortype')->name('operatortype/getAjaxData');
});
});
?>