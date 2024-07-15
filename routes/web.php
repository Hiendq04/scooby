<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Client;
use App\Http\Controllers\Admin;

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

//Auth
Route::middleware('noauth')->group(function () {
    Route::get('register', [Auth\RegisterController::class, 'register'])->name('register');
    Route::get('login', [Auth\LoginController::class, 'login'])->name('login');
    Route::post('login', [Auth\LoginController::class, 'handleLogin'])->name('login.handle');
    Route::get('verfy/{token?}/{email?}', [Auth\VerfyController::class, 'verfy'])->name('verfy');
    Route::get('forgot', [Auth\ForgotController::class, 'forgot'])->name('forgot');
    Route::get('password/reset/{token?}/{email?}', [Auth\ForgotController::class, 'resetPassword'])->name('password.reset');
    Route::get('/auth/{provider}/redirect', [Auth\ProviderController::class, 'redirect']);
    Route::get('/auth/{provider}/callback', [Auth\ProviderController::class, 'callback']);
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('/', [Client\HomeController::class, 'index'])->name('/');
    Route::get('about', [Client\OtherController::class, 'about'])->name('about');
    Route::get('contact', [Client\OtherController::class, 'contact'])->name('contact');
    Route::get('service', [Client\ServiceController::class, 'service'])->name('service');
    Route::get('blog', [Client\BlogController::class, 'blog'])->name('blog');
    Route::get('shop', [Client\ShopController::class, 'shop'])->name('shop');
    Route::get('shop-detail', [Client\ShopController::class, 'shopDetail'])->name('shop.detail');
    Route::get('cart', [Client\CartController::class, 'cart'])->name('cart');
    Route::get('check-out', [Client\CheckOutController::class, 'checkOut'])->name('checkout');
    Route::get('faq', [Client\OtherController::class, 'faq'])->name('faq');
    Route::get('gallery', [Client\OtherController::class, 'gallery'])->name('gallery');
    Route::prefix('account')->name('account.')->group(function(){
        Route::get('info', [Client\AccountController::class, 'info'])->name('info');
    });
});

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function(){
    Route::get('/', [Admin\HomeController::class, 'index'])->name('dashboard');
    Route::prefix('account')->name('account.')->group(function(){
        Route::get('list', [Admin\AccountController::class, 'list'])->name('list');
        Route::get('info/{id}', [Admin\AccountController::class, 'showAccount'])->name('info');
    });
    Route::prefix('category')->name('category.')->group(function(){
        Route::get('list', [Admin\CategoryController::class, 'list'])->name('list');
        Route::get('add', [Admin\CategoryController::class, 'add'])->name('add');
        Route::get('edit/{id}', [Admin\CategoryController::class, 'edit'])->name('edit');
    });
    Route::prefix('voucher')->name('voucher.')->group(function(){
        Route::get('list', [Admin\VoucherController::class, 'list'])->name('list');
        Route::get('add', [Admin\VoucherController::class, 'add'])->name('add');
        Route::get('edit/{id}', [Admin\VoucherController::class, 'edit'])->name('edit');
    });
});
