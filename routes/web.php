<?php

use App\Models\City;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Mail\welcomeEmail;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cms/')->middleware('guest:admin,user')->group(function () {

    Route::get('age-check',function(){
        echo"We are here";
    })->middleware('age:15');


    Route::get('{guard}/login',[AuthController::class,'showLoginPage'])->name('login');
    Route::post('/login',[AuthController::class,'login']);


});

Route::prefix('cms/admin')->middleware('auth:admin,user')->group(function(){
// Route::prefix('cms/admin')->group(function(){

        Route::get('/', function () {
            return view('cms.layouts.master');
        });
        Route::resource('cities', CityController::class);
        Route::resource('categories',CategoryController::class);
        Route::resource('admins',AdminController::class);
        Route::resource('users',UserController::class);
        Route::get('logout',[AuthController::class,'logout'])->name('logout');

        Route::get('change-password',[AuthController::class,'changePassword'])->name('change-password');
        Route::put('update-password',[AuthController::class,'updatePassword']);




});

// Route::get('test-email',function(){
//     return new welcomeEmail();
// });

