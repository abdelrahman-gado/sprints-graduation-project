<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\Api\OrderDetailsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for youcr application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum','can:is_admin'])->group(function(){

    // create colors
    Route::post('/colors', [ColorController::class, 'store']);
    
    // create categories & delete categories
    Route::post('/categories', [CategoriesController::class, 'store']);
    Route::delete('/categories/{id}', [CategoriesController::class, 'delete']);

    // create products & delete products & update products
    Route::post('/products', [ProductsController::class, 'store']);
    Route::delete('/products/{id}', [ProductsController::class, 'delete']);
    Route::post('/products/{id}', [ProductsController::class, 'update']);

    // view all users & update users
    Route::get('/users', [AuthController::class, 'getUsers']);
    Route::post('/users/update/{id}', [AuthController::class, 'updateUsers']);
});

// register & login
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
    
// get colors & categories & products 
Route::get('/colors', [ColorController::class, 'index']);
Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/products', [ProductsController::class, 'index']);

// get add update delete details
Route::get('/get/details',[OrderDetailsController::class, 'getOrderDetails']);
Route::post('/add/details',[OrderDetailsController::class, 'create']);
Route::post('/update/details/{id}',[OrderDetailsController::class, 'update']);
Route::delete('/delete/details/{id}',[OrderDetailsController::class, 'delete']);

// get add update delete orders
Route::get('/get/orders/{order_id}',[OrdersController::class, 'getOrders']);
Route::post('/add/orders',[OrdersController::class, 'create']);
Route::post('/update/orders/{id}',[OrdersController::class, 'update']);
Route::delete('/delete/orders/{id}',[OrderDetailsController::class, 'delete']);


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
