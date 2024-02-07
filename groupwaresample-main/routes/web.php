<?php

use App\Http\Controllers\AuthorityController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('')->group(function () {
    Route::controller(MainController::class)->group(function() {
        Route::get('', 'welcome')->name('welcome')->middleware('guest');
        Route::middleware('auth')->group(function(){
            Route::get('home', 'home')->name('home');
            Route::get('setting', 'setting')->name('setting');
            Route::post('setting', 'updateSetting')->name('setting');
        });
    });
});

Route::prefix('auth')->group(function () {
    Route::controller(AuthorityController::class)->group(function() {
        Route::post('login', 'login')->name('auth.login')->middleware('guest');
        Route::post('logout', 'logout')->name('auth.logout')->middleware('auth');
    });
});
