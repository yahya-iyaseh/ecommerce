<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\UserProfileController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Auth\ChangeUserPasswordController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin/dashboard');

Route::prefix('dashboard')->group(function () {

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
});

Route::get('/profile', [UserProfileController::class, 'index'])->name('profile')->middleware(['auth']);
Route::post('/profile/update', [UserProfileController::class, 'update'])->name('profile.update')->middleware(['auth', 'password.confirm']);
Route::get('/change-password', [ChangeUserPasswordController::class, 'index'])->name('change-password')->middleware(['auth']);
Route::post('/profile/update', [ChangeUserPasswordController::class, 'update'])->name('change-password.update')->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('test', function(){
    return view('layouts.store');
});



require __DIR__ . '/auth.php';
