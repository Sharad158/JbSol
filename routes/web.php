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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('lang/change', 'App\Http\Controllers\HomeController@change')->name('changeLang');

Route::group(['middleware' => ['auth'] , 'prefix' => 'admin'], function()
{
    Route::resource('/company','App\Http\Controllers\CompanyController');
    Route::post('/company/status-change', 'App\Http\Controllers\CompanyController@changeStatus');

    Route::resource('/employee','App\Http\Controllers\EmployeeController');
    Route::post('/employee/status-change', 'App\Http\Controllers\EmployeeController@changeStatus');
});