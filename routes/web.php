<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController as PublicCategoryController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\DashboardSettingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route yang bisa diakses tanpa login
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [PublicCategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [PublicCategoryController::class, 'detail'])->name('categories-detail');
Route::get('/details/{id}', [DetailController::class, 'index'])->name('detail');
Route::get('/register/success', [App\Http\Controllers\Auth\RegisterController::class, 'success'])
    ->name('register-success');  // Pindahkan kesini

// Route yang memerlukan authentikasi
Route::middleware(['auth'])->group(function() {
    // Cart routes
    Route::post('/detail/{id}/add', [DetailController::class, 'add'])->name('detail-add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart-delete');
    
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');
    Route::post('/checkout/callback', [CheckoutController::class, 'callback'])->name('midtrans-callback');

    Route::get('/success', [CartController::class, 'success'])->name('success');

    // Dashboard routes
   
    
    Route::get('/dashboard/transactions', [DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'details'])->name('dashboard-transaction-details');
    Route::post('/dashboard/transactions/{id}/update', [DashboardTransactionController::class, 'update'])
    ->name('dashboard-transaction-update');
    Route::get('/dashboard/settings', [DashboardSettingController::class, 'store'])->name('dashboard-settings-store');
    Route::get('/dashboard/account', [DashboardSettingController::class, 'account'])->name('dashboard-settings-account');
    Route::post('/dashboard/update/{redirect}', [DashboardSettingController::class, 'update'])->name('dashboard-settings-redirect');
});


// Admin routes
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
        Route::resource('category', CategoryController::class);
        Route::resource('user', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('product-gallery', ProductGalleryController::class);
        Route::resource('transaction', TransactionController::class);
    });

Auth::routes();