<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::get('/', [Admin\HomeController::class, 'index'])->name('dashboard');
Route::prefix('account')->name('account.')->group(function () {
    Route::get('list', [Admin\AccountController::class, 'list'])->name('list');
    Route::get('info/{id}', [Admin\AccountController::class, 'showAccount'])->name('info');
});
Route::prefix('category')->name('category.')->group(function () {
    Route::get('list', [Admin\CategoryController::class, 'list'])->name('list');
    Route::get('add', [Admin\CategoryController::class, 'add'])->name('add');
    Route::get('edit/{id}', [Admin\CategoryController::class, 'edit'])->name('edit');
});
Route::prefix('voucher')->name('voucher.')->group(function () {
    Route::get('list', [Admin\VoucherController::class, 'list'])->name('list');
    Route::get('add', [Admin\VoucherController::class, 'add'])->name('add');
    Route::get('edit/{id}', [Admin\VoucherController::class, 'edit'])->name('edit');
});
Route::resource('product', Admin\ProductController::class);
Route::resource('banner', Admin\BannerController::class);
