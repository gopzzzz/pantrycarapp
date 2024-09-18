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
Route::get('/customerList/{id}', [App\Http\Controllers\HomeController::class, 'customerList'])->name('customerList');
Route::get('/cancellation', [App\Http\Controllers\HomeController::class, 'cancellation'])->name('cancellation');
Route::post('/cancelfoodmeals', [App\Http\Controllers\HomeController::class, 'cancelfoodmeals'])->name('cancelfoodmeals');
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

Route::get('/delivery_agent', [App\Http\Controllers\DeliveryagentController::class, 'delivery_agent'])->name('delivery_agent');
Route::post('/delivery_agentfetch', [App\Http\Controllers\DeliveryagentController::class, 'delivery_agentfetch'])->name('delivery_agentfetch');
Route::post('/delivery_agentedit', [App\Http\Controllers\DeliveryagentController::class, 'delivery_agentedit'])->name('delivery_agentedit');
Route::post('/delivery_agentinsert', [App\Http\Controllers\DeliveryagentController::class, 'delivery_agentinsert'])->name('delivery_agentinsert');
Route::get('/delivery_agentdelete/{id}', [App\Http\Controllers\DeliveryagentController::class, 'delivery_agentdelete'])->name('delivery_agentdelete');

Route::get('/account_head', [App\Http\Controllers\AccountheadController::class, 'account_head'])->name('account_head');
Route::post('/account_headfetch', [App\Http\Controllers\AccountheadController::class, 'account_headfetch'])->name('account_headfetch');
Route::post('/account_headedit', [App\Http\Controllers\AccountheadController::class, 'account_headedit'])->name('account_headedit');
Route::post('/account_headinsert', [App\Http\Controllers\AccountheadController::class, 'account_headinsert'])->name('account_headinsert');
Route::get('/account_headdelete/{id}', [App\Http\Controllers\AccountheadController::class, 'account_headdelete'])->name('account_headdelete');

Route::get('/transaction', [App\Http\Controllers\TransactionController::class, 'transaction'])->name('transaction');
Route::post('/transactioninsert', [App\Http\Controllers\TransactionController::class, 'transactioninsert'])->name('transactioninsert');
Route::get('/transactiondelete/{id}', [App\Http\Controllers\TransactionController::class, 'transactiondelete'])->name('transactiondelete');

Route::get('/plandetails', [App\Http\Controllers\PlanDetailsController::class, 'plandetails'])->name('plandetails');
Route::post('/plandetailsfetch', [App\Http\Controllers\PlanDetailsController::class, 'plandetailsfetch'])->name('plandetailsfetch');
Route::post('/plandetailsedit', [App\Http\Controllers\PlanDetailsController::class, 'plandetailsedit'])->name('plandetailsedit');
Route::post('/plandetailsinsert', [App\Http\Controllers\PlanDetailsController::class, 'plandetailsinsert'])->name('plandetailsinsert');

Route::get('/b2csales', [App\Http\Controllers\Messb2csalesController::class, 'b2csales'])->name('b2csales');
Route::get('/menu', [App\Http\Controllers\MenuController::class, 'menu'])->name('menu');


Route::get('/b2csales', [App\Http\Controllers\B2cController::class, 'b2csales'])->name('b2csales');
Route::post('/b2csalesinsert', [App\Http\Controllers\B2cController::class, 'b2csalesinsert'])->name('b2csalesinsert');

Route::get('/enquirylist', [App\Http\Controllers\EnquiryController::class, 'enquirylist'])->name('enquirylist');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


