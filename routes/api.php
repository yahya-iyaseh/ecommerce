<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\AccessTokenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('categories', CategoriesController::class);
// Route::apiResource('products', ProductsController::class);


Route::apiResources([
    'categories' => CategoriesController::class,
    'products' => ProductsController::class
]);

Route::post('access/tokens', [AccessTokenController::class, 'store']);
Route::delete('access/tokens/{token?}', [AccessTokenController::class, 'destroy'])->middleware('auth:sanctum');
