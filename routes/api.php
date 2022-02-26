<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\CategoryController;

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

Route::get('welcome',function(){
    return response()->json([
        'message'=>'welcome to database app testing -> in laravel 8'
    ]);
});

Route::prefix('auth')->group(function(){
    Route::post('login',[ApiAuthController::class,'login']);
    Route::post('forgot-password',[ApiAuthController::class,'forgotPassword']);
    Route::post('reset-password',[ApiAuthController::class,'resetPassword']);
});

Route::prefix('auth')->middleware('auth:api')->group(function(){
    Route::get('logout',[ApiAuthController::class,'logout']);
});

Route::middleware('auth:api')->group(function(){
    Route::apiResource(('categories'),CategoryController::class);
});
