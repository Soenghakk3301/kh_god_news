<?php

use App\Http\Controllers\Admin\AdminAuthenicationController;
use App\Http\Controllers\Admin\DashboardController;
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
});