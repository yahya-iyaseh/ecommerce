<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;

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


Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin/dashboard');
// CRUD: Create, Read, Update and Delete routes
Route::resource('categories', CategoriesController::class, [
    'as' => 'dashboard'
    // 'names' => [
    //     'index' => 'dashboard.categories.index',
    //     'create' => 'dashboard.categories.create',
    //     'store' => 'dashboard.categories.store',
    // ],
]);
