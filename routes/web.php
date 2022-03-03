<?php

use App\Models\City;
use App\Mail\welcomeEmail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\AdminPermissionController;
use App\Http\Controllers\dashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;



Route::prefix('cms/')->middleware('guest:admin,user')->group(function () {

    Route::get('{guard}/login', [AuthController::class, 'showLoginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


Route::prefix('cms/admin')->middleware('auth:admin,user')->group(function () {
    // Route::prefix('cms/admin')->group(function(){
        Route::get('/', [dashboardController::class, 'index'])->name('dashboard');
    // Route::view('/', 'cms.layouts.master');
    Route::resource('categories', CategoryController::class);
    Route::resource('cities', CityController::class);
    Route::resource('tasks', TaskController::class);

    Route::get('change-password', [AuthController::class, 'changePassword'])->name('change-password');
    Route::put('update-password', [AuthController::class, 'updatePassword']);

    Route::get('edit-profile', [AuthController::class, 'editProfile'])->middleware('verified')->name('edit-profile');
    Route::put('update-profile', [AuthController::class, 'updateProfile']);

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});


Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {

    Route::resource('admins', AdminController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles.permissions', RolePermissionController::class);
    Route::resource('admin.permissions', AdminPermissionController::class);
    Route::resource('user.permissions', UserPermissionController::class);
});


// Email Verification Routes...     //

Route::get('/email/verify', function () {
    return view('cms.auth.verify-email');
})->middleware('auth:admin')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    // return back()->with('message', 'Verification link sent!');
    return response()->json(['message' => 'Verification link sent successfuly !']);
})->middleware(['auth:admin', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/cms/admin');
})->middleware(['auth:admin', 'signed'])->name('verification.verify');
