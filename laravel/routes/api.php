<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserController;
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
Route::middleware(['auth:sanctum'])->post('/auth/logout', [AuthController::class, 'logout']);

// current authenicated user
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return response()->json($request->user());
});

// colors
Route::get('/colors', [ColorController::class, 'index']);

// categories
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::get('/categories/{id}/products', [CategoryController::class, 'getProductsByCategoryId']);


// products
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/all', [ProductController::class, 'getAll']);
Route::get('/products/recommended', [ProductController::class, 'getRecommended']);
Route::get('/products/trending', [ProductController::class, 'getTrending']);
Route::get('/products/new-arrivals', [ProductController::class, 'getNewArrivalProducts']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/{id}/reviews', [ProductController::class, 'getReviewsByProductId']);


// reviews
Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/reviews/{id}', [ReviewController::class, 'show']);
Route::middleware('auth:sanctum')->post('/reviews', [ReviewController::class, 'store']);
Route::middleware('auth:sanctum')->put('/reviews/{id}', [ReviewController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/reviews/{id}', [ReviewController::class, 'destory']);


// users
Route::get('/users', [UserController::class, 'index']);
Route::middleware(['auth:sanctum'])->get('/users/{id}/orders', [UserController::class, 'getOrdersByUserId']);
Route::middleware('auth:sanctum')->get('/users/{id}/reviews', [UserController::class, 'getReviewsByUserId']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destory']);


// orders
Route::middleware(['auth:sanctum'])->get('/orders/{id}/order-details', [OrderController::class, 'getOrderDetailsByOrderId']);
Route::middleware('auth:sanctum')->post('/orders', [OrderController::class, 'store']);



// admin routes
//middleware(['auth:sanctum', 'can:is_admin'])->
Route::prefix('admin')->group(function () {

    // colors
    Route::post('/colors', [ColorController::class, 'store']);
    Route::delete('/colors/{id}', [ColorController::class, 'destory']);

    // categories
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destory']);

    // products
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destory']);

    // users
    Route::get('/users/{id}', [UserController::class, 'show']);

    //orders
    Route::delete('/orders/{id}', [OrderController::class, 'destory']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::get('/orders', [OrderController::class, 'index']);
});