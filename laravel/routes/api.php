<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// auth user
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);


// colors
Route::middleware('auth:sanctum')->post('/colors', [ColorController::class, 'store']);
Route::middleware('auth:sanctum')->delete('/colors/{id}', [ColorController::class, 'destory']);
Route::get('/colors', [ColorController::class, 'index']);


// categories
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::get('/categories/{id}/products', [CategoryController::class, 'getProductsByCategoryId']);
Route::middleware('auth:sanctum')->put('/categories/{id}', [CategoryController::class, 'update']);
Route::middleware('auth:sanctum')->post('/categories', [CategoryController::class, 'store']);
Route::middleware('auth:sanctum')->delete('/categories/{id}', [CategoryController::class, 'destory']);


// products
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/{id}/reviews', [ProductController::class, 'getReviewsByProductId']);
Route::middleware('auth:sanctum')->post('/products', [ProductController::class, 'store']);
Route::middleware('auth:sanctum')->put('/products/{id}', [ProductController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/products/{id}', [ProductController::class, 'destory']);


// reviews
Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/reviews/{id}', [ReviewController::class, 'show']);
Route::middleware('auth:sanctum')->post('/reviews', [ReviewController::class, 'store']);
Route::middleware('auth:sanctum')->put('/reviews/{id}', [ReviewController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/reviews/{id}', [ReviewController::class, 'destory']);


// users
Route::get('/users/{id}/reviews', [UserContoller::class, 'getReviewsByUserId']);


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
