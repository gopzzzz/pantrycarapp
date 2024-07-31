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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/categorylist', [App\Http\Controllers\CategoryController::class, 'categorylist'])->name('categorylist');
Route::get('/categoryinsert', [App\Http\Controllers\CategoryController::class, 'categoryinsert'])->name('categoryinsert');
Route::post('/categoryadd', [App\Http\Controllers\CategoryController::class, 'categoryadd'])->name('categoryadd');
Route::post('/categoryfetch', [App\Http\Controllers\CategoryController::class, 'categoryfetch'])->name('categoryfetch');
Route::post('/categoryedit', [App\Http\Controllers\CategoryController::class, 'categoryedit'])->name('categoryedit');

Route::get('/productlist', [App\Http\Controllers\ProductController::class, 'productlist'])->name('productlist');
Route::get('/productinsert', [App\Http\Controllers\ProductController::class, 'productinsert'])->name('productinsert');
Route::post('/productadd', [App\Http\Controllers\ProductController::class, 'productadd'])->name('productadd');
Route::post('/productfetch', [App\Http\Controllers\ProductController::class, 'productfetch'])->name('productfetch');
Route::post('/productedit', [App\Http\Controllers\ProductController::class, 'productedit'])->name('productedit');
Route::post('/productimageinsert', [App\Http\Controllers\ProductController::class, 'productimageinsert'])->name('productimageinsert');
Route::post('/productimagefetch', [App\Http\Controllers\ProductController::class, 'productimagefetch'])->name('productimagefetch');
Route::post('/productimagedelete', [App\Http\Controllers\ProductController::class, 'productimagedelete'])->name('productimagedelete');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


