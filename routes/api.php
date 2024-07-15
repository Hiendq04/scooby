<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Client;
use App\Http\Controllers\Admin;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Auth
Route::post('/register', [Auth\RegisterController::class, 'handleRegister'])->name('register.handle');
Route::post('/verfy', [Auth\VerfyController::class, 'handleVerfy'])->name('verfy.again');
Route::post('/forgot', [Auth\ForgotController::class, 'handleForgot'])->name('forgot.again');
Route::post('/password/reset', [Auth\ForgotController::class, 'handleReset'])->name('password.reset.handle');

Route::get('account/info', [Client\AccountController::class, 'getInfoAccount'])->name('api.account.info');
Route::post('contact', [Client\OtherController::class, 'sendQuestion'])->name('contact.send.question');

Route::prefix('admin')->name('api.admin.')->group(function(){
    Route::prefix('account')->name('account.')->group(function(){
        Route::get('list', [Admin\AccountController::class, 'getAccounts'])->name('list');
        Route::post('add', [Admin\AccountController::class, 'addAccount'])->name('add');
        Route::post('delete', [Admin\AccountController::class, 'deleteAccount'])->name('delete');
        Route::post('edit', [Admin\AccountController::class, 'editAccount'])->name('edit');
        Route::post('update', [Admin\AccountController::class, 'updateAccount'])->name('update');
    });
    Route::prefix('category')->name('category.')->group(function(){
        Route::get('list', [Admin\CategoryController::class, 'getCategories'])->name('list');
        Route::post('add', [Admin\CategoryController::class, 'handleAddCategory'])->name('add');
        Route::post('delete', [Admin\CategoryController::class, 'deleteCategory'])->name('delete');
        Route::post('update', [Admin\CategoryController::class, 'updateCategory'])->name('update');
    });
    Route::prefix('voucher')->name('voucher.')->group(function(){
        Route::get('list', [Admin\VoucherController::class, 'getVouchers'])->name('list');
        Route::post('add', [Admin\VoucherController::class, 'handleAddVoucher'])->name('add');
        Route::post('delete', [Admin\VoucherController::class, 'deleteVoucher'])->name('delete');
        Route::post('update', [Admin\VoucherController::class, 'updateVoucher'])->name('update');
    });
});
