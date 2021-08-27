<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cms/admin')->group(function(){

        Route::get('/', function () {
            return view('cms.layouts.master');
        });


});
