<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Auth\UserProfileController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Auth\ChangeUserPasswordController;
use App\Http\Controllers\Dashboard\NotificationsController;
use App\Http\Controllers\ProductsController as StoreProductsController;
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

// Route::prefix(LaravelLocalization::setLocale())->group(
// function () {

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{category:slug?}', [StoreProductsController::class, 'index'])->name('products');
Route::get('/products/{category:slug}/{product:slug}', [StoreProductsController::class, 'show'])->name('products.show');
// Rating post
Route::post('/products/{product}/reviews', [StoreProductsController::class, 'review'])->name('products.reviews.store');


Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin/dashboard');

// Cart Routes


Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'store']);
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');


Route::prefix('/dashboard')->group(function () {

    Route::group(['as' => 'dashboard.categories.',], function () {
        Route::get('/categories/{id}/restore', [CategoriesController::class, 'restore'])->name('restore');
    });
    Route::group(['as' => 'dashboard.products.'], function () {
        Route::get('/products/{id}/restore', [ProductsController::class, 'restore'])->name('restore');
    });
    // Dashboard categories
    Route::resource('categories', CategoriesController::class, [
        'as' => 'dashboard',
    ]);
    // Dashboard Products
    Route::resource('/products', ProductsController::class, [
        'as' => 'dashboard',
    ]);
    Route::resource('/roles', RolesController::class, [
        'as' => 'dashboard'
    ]);
    Route::resource('/users', UsersController::class, [
        'as' => 'dashboard'
    ]);

    // Notifications
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications');
    Route::get('/notifications/{notification}', [NotificationsController::class, 'read'])->name('notifications.read');
});


// check out routes

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/profile', [UserProfileController::class, 'index'])->name('profile')->middleware(['auth']);
Route::post('/profile/update', [UserProfileController::class, 'update'])->name('profile.update')->middleware(['auth', 'password.confirm']);
Route::get('/change-password', [ChangeUserPasswordController::class, 'index'])->name('change-password')->middleware(['auth']);
Route::post('/profile/update/password', [ChangeUserPasswordController::class, 'update'])->name('change-password.update')->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('test', function () {
    return view('layouts.store');
});


require __DIR__ . '/auth.php';
//     }
// );
