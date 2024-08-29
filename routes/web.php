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



Auth::routes();



//web view
Route::get('/', function () {
    return redirect(route('login'));
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/daylist', [App\Http\Controllers\DaysController::class, 'daylist'])->name('daylist');
Route::post('/dayfetch', [App\Http\Controllers\DaysController::class, 'dayfetch'])->name('dayfetch');


Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


