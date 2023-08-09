<?php
Route::group(['middleware' => 'auth'], function (){
Route::namespace('Admin')->group(function () {  
Route::get('planduration', 'PlanDuration@index')->name('planduration');
Route::post('planduration/add', 'PlanDuration@add_PlanDuration')->name('planduration/add');
Route::get('planduration/edit/{id}', 'PlanDuration@edit_PlanDuration')->name('planduration/edit/{id}');
Route::post('planduration/update', 'PlanDuration@update_PlanDuration')->name('planduration/update');
Route::get('planduration/delete/{id}', 'PlanDuration@delete_PlanDuration')->name('planduration/delete/{id}');

Route::get('operator/getAjaxData', 'PlanController@get_operator')->name('operator/getAjaxData');
Route::get('plan/getAjaxData', 'PlanDuration@get_plan')->name('plan/getAjaxData');
});
});
?>