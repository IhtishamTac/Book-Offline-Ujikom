<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('login');
})->name('login');
Route::post('/postlogin',[AuthController::class,'login'])->name('postlogin');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::prefix('pustakawan')->group(function () {
    Route::get('/home', [BookController::class, 'index'])->name('home');

    Route::get('/log', [BookController::class, 'log'])->name('log');

    Route::post('/post-keranjang/{id}', [BookController::class, 'postkeranjang'])->name('post-keranjang');
    Route::get('/keranjang', [BookController::class, 'keranjang'])->name('keranjang');

    Route::get('/checkout/{tranID}', [BookController::class, 'checkout'])->name('checkout');
    Route::post('/postcheckout/{tranID}', [BookController::class, 'postcheckout'])->name('postcheckout');

    Route::get('/history', [BookController::class, 'history'])->name('history');

});

Route::prefix('admin')->group(function () {
    Route::get('/home', [AdminController::class, 'index'])->name('home.admin');
});
