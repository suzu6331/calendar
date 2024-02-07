<?php

use App\Http\Controllers\Api\CalendarApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('calendar')->group(function(){
        Route::controller(CalendarApiController::class)->group(function(){
            Route::get('', 'index');
            Route::get('/{event}', 'show');
            Route::post('', 'store');
            Route::put('/{event}', 'update');
            Route::delete('/{event}', 'destroy');
        });
    });
});
