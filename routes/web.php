<?php

use App\Http\Controllers\MerchantController;
use App\Http\Controllers\WebhookController;
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
    return view('layouts.master');
});

Route::post('/webhook', WebhookController::class)->name('webhook');

Route::get('/merchant/order-stats', [MerchantController::class, 'orderStats'])->name('merchant.order-stats');

//Merchant
Route::get('/merchent', [MerchantController::class, 'index'])->name('merchant');
Route::get('/merchent-add', [MerchantController::class, 'create'])->name('merchant.add');
Route::post('/merchant-store', [MerchantController::class, 'registerMerchant'])->name('merchant.store');
Route::get('/merchant-edit/{id}', [MerchantController::class, 'editMerchant'])->name('merchant.edit');
Route::put('/merchant-update/{id}', [MerchantController::class, 'updateMerchat'])->name('merchant.update');
Route::post('/merchant-search', [MerchantController::class, 'searchMerchant'])->name('merchant.search');


//Affiliate
Route::get('/affiliate', [MerchantController::class, 'affiliateIndex'])->name('affiliate');
Route::get('/affiliate-add', [MerchantController::class, 'affiliateCreate'])->name('affiliate.add');
Route::post('/affiliate-store', [MerchantController::class, 'affiliateStore'])->name('affiliate.store');