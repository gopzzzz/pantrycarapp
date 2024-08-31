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
Route::get('/day', [App\Http\Controllers\DaysController::class, 'day'])->name('day');

Route::post('/daysfetch', [App\Http\Controllers\DaysController::class, 'daysfetch'])->name('daysfetch');
Route::post('/daysinsert', [App\Http\Controllers\DaysController::class, 'daysinsert'])->name('daysinsert');
Route::post('/daysedit', [App\Http\Controllers\DaysController::class, 'daysedit'])->name('daysedit');

Route::get('/master_plans', [App\Http\Controllers\MasterplanController::class, 'master_plans'])->name('master_plans');
Route::post('/masterplansfetch', [App\Http\Controllers\MasterplanController::class, 'masterplansfetch'])->name('masterplansfetch');
Route::post('/masterplaninsert', [App\Http\Controllers\MasterplanController::class, 'masterplaninsert'])->name('masterplaninsert');
Route::post('/masterplansedit', [App\Http\Controllers\MasterplanController::class, 'masterplansedit'])->name('masterplansedit');

Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'customer'])->name('customer');
Route::post('/customerfetch', [App\Http\Controllers\CustomerController::class, 'customerfetch'])->name('customerfetch');
Route::post('/customeredit', [App\Http\Controllers\CustomerController::class, 'customeredit'])->name('customeredit');
Route::post('/customerinsert', [App\Http\Controllers\CustomerController::class, 'customerinsert'])->name('customerinsert');

Route::get('/plandetails', [App\Http\Controllers\PlanDetailsController::class, 'plandetails'])->name('plandetails');
Route::post('/plandetailsfetch', [App\Http\Controllers\PlanDetailsController::class, 'plandetailsfetch'])->name('plandetailsfetch');
Route::post('/plandetailsedit', [App\Http\Controllers\PlanDetailsController::class, 'plandetailsedit'])->name('plandetailsedit');
Route::post('/plandetailsinsert', [App\Http\Controllers\PlanDetailsController::class, 'plandetailsinsert'])->name('plandetailsinsert');

Route::get('/enquirylist', [App\Http\Controllers\EnquiryController::class, 'enquirylist'])->name('enquirylist');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


