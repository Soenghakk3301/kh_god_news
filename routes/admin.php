<?php

use App\Http\Controllers\Admin\AdminAuthenicationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('login', [AdminAuthenicationController::class, 'login'])->name('login');
    Route::post('login', [AdminAuthenicationController::class, 'handleLogin'])->name('handle-login');
    Route::get('logout', [AdminAuthenicationController::class, 'logout'])->name('logout');

    /** reset password */
    Route::get('forgot-password', [AdminAuthenicationController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('forgot-password', [AdminAuthenicationController::class, 'sendResetLink'])->name('forgot-password.send');

    Route::get('reset-password/{token}', [AdminAuthenicationController::class, 'resetPassword'])->name('reset-password');
    Route::post('reset-password', [AdminAuthenicationController::class, 'handleResetPassword'])->name('reset-password.send');
});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /** profile routes */
    Route::put('profile-password-update/{id}', [ProfileController::class, 'passwordUpdate'])->name('profile-password.update');
    Route::resource('profile', ProfileController::class);

    /** language routes */
    Route::resource('language', LanguageController::class);
    Route::resource('category', CategoryController::class);
});