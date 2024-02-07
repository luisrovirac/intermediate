<?php

use App\Http\Controllers\OpenaixController;
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

// Get only test
Route::get('getTest', [OpenaixController::class, 'getTest']);

// get openai first
Route::get('getopenai', [OpenaixController::class, 'getopenai']);

// post openai first
Route::post('postopenai', [OpenaixController::class, 'postopenai']);

// get coinmarketcap first test
Route::get('coinmarket01', [OpenaixController::class, 'coinmarket01']);

// get openai01 test using openai-php/laravel client
Route::post('openai01', [OpenaixController::class, 'openai01']);

// get openai02 test using openai-php/laravel client
Route::get('openai02', [OpenaixController::class, 'openai02']);

// get openaidalle3 test using openai-php/laravel client
Route::get('openaidalle3', [OpenaixController::class, 'openaidalle3']);



