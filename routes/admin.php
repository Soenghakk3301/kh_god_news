<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\AdminAuthenicationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FooterGridOneController;
use App\Http\Controllers\Admin\FooterGridThreeController;
use App\Http\Controllers\Admin\FooterGridTwoController;
use App\Http\Controllers\Admin\FooterInfoController;
use App\Http\Controllers\Admin\HomeSectionSettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SocialCountController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SubscribeController;
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

    /** ad route */
    Route::resource('ad', AdController::class);

    /** subscribers routes */
    Route::resource('subscribers', SubscribeController::class);

    /** social links routes */
    Route::resource('social-link', SocialLinkController::class);

    /** footer info routes */
    Route::resource('footer-info', FooterInfoController::class);

    /** footer grid one routes */
    Route::post('footer-grid-one-title', [FooterGridOneController::class, 'handleTitle'])->name('footer-grid-one-title');
    Route::resource('footer-grid-one', FooterGridOneController::class);

    /** footer grid two routes */
    Route::post('footer-grid-two-title', [FooterGridTwoController::class, 'handleTitle'])->name('footer-grid-one-title');
    Route::resource('footer-grid-two', FooterGridTwoController::class);

    /** footer grid three routes */
    Route::post('footer-grid-three-title', [FooterGridThreeController::class, 'handleTitle'])->name('footer-grid-three-title');
    Route::resource('footer-grid-three', FooterGridThreeController::class);

    /** about page route */
    Route::get('about', [AboutController::class, 'index'])->name('about.index');
    Route::post('about', [AboutController::class, 'update'])->name('about.update');

    /** about page route */
    Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('contact', [ContactController::class, 'update'])->name('contact.update');


    /** contact message routes */
    Route::get('contact-message', [ContactMessageController::class, 'index'])->name('contact-message');
    Route::post('contact-send-replay', [ContactMessageController::class, 'sendReply'])->name('contact.send-replay');



});