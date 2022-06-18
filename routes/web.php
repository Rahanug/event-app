<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'revalidate'], function () {
    Route::group(['middleware' => 'auth:admins'], function () {
        // Dashboard
        Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('admins.dashboard');
        // Event
        Route::get('/event', [\App\Http\Controllers\EventController::class, 'index'])->name('admins.events');
        Route::post('/event/store', [\App\Http\Controllers\EventController::class, 'storeEvent'])->name('admins.storeEvents');
        Route::post('/event/update', [\App\Http\Controllers\EventController::class, 'updateEvent'])->name('admins.updateEvents');
        Route::get('/event/delete/{id_event}', [\App\Http\Controllers\EventController::class, 'deleteEvent'])->name('admins.deleteEvents');

    });
    // Landing Page
    Route::get('/', [\App\Http\Controllers\LandingPageController::class, 'index'])->name('landing');
    Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'index'])->name('register');
    Route::get('/hasil', [\App\Http\Controllers\RegisterController::class, 'hasil'])->name('hasil');
    Route::post('/storependaftar', [\App\Http\Controllers\RegisterController::class, 'storependaftar'])->name('storependaftar');
    // Login
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'formLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});
