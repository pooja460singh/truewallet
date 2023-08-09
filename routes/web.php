<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
foreach (File::allFiles(__DIR__ . '/Routes') as $partial) {
	require (string)$partial;
}

Route::get('/', function () {
    return view('front.index');
});
Route::group(['middleware' => 'auth'], function (){
Route::get('home', 'Admin\AdminController@index')->name('home');

});
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/', 'Front\HomeController@index')->name('/');
Auth::routes();
Route::post('admin/login', 'Auth\LoginController@adminlogin')->name('admin/login');

