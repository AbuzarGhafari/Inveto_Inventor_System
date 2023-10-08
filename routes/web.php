<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopTypeController;
use App\Http\Controllers\OrderBookerController;

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
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::resource('/products', ProductController::class);
    
    Route::resource('/areas', AreaController::class);
    
    Route::resource('/shop-types', ShopTypeController::class);

    Route::resource('/shops', ShopController::class);
    
    Route::resource('/order-bookers', OrderBookerController::class);

    Route::get('/bills/daily-sales-report/{booker}', [BillController::class, 'dailySalesReport'])->name('bills.dailySalesReport');

    Route::resource('/bills', BillController::class);

    Route::get('/bills/print/{bill}', [BillController::class, 'print'])->name('bills.print');
    
    
});
 
