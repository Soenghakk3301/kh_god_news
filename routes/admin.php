<?php

use App\Http\Controllers\Admin\AdminAuthenicationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeSectionSettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SocialCountController;
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

    /** news routes */
    Route::get('fetch-news-category', [NewsController::class, 'fetchCategory'])->name('fetch-news-category');
    Route::get('toggle-news-status', [NewsController::class, 'toggleNewsStatus'])->name('toggle-news-status');
    Route::get('news-copy/{id}', [NewsController::class, 'copyNews'])->name('news-copy');
    Route::resource('news', NewsController::class);


    /** home section setting route */
    Route::get('home-section-setting', [HomeSectionSettingController::class, 'index'])->name('home-section-setting.index');
    Route::put('home-section-setting', [HomeSectionSettingController::class, 'update'])->name('home-section-setting.update');

    /** social count route */
    Route::resource('social-count', SocialCountController::class);
});