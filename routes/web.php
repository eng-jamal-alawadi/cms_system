<?php

use App\Models\City;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;



Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cms/admin')->group(function(){

        Route::get('/', function () {
            return view('cms.layouts.master');
        });

        Route::get('/index', function () {
            return view('cms.cities.index');
        });
        Route::resource('cities', CityController::class);


});
