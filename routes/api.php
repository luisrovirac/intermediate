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

// post openai01 test using openai-php/laravel client
// You need pass the parameter: actual_message
Route::post('openai01', [OpenaixController::class, 'openai01']);

// post openaisavemsgs test using openai-php/laravel client and save messages
// You need pass the parameter: actual_message
Route::post('openaisavemsgs', [OpenaixController::class, 'openaisavemsgs']);

// get getopenaisavemsgs test using openai-php/laravel client and save messages
// You need pass the parameter: actual_message
Route::get('getopenaisavemsgs', [OpenaixController::class, 'getopenaisavemsgs']);

// get openai02 test using openai-php/laravel client
Route::get('openai02', [OpenaixController::class, 'openai02']);

// post openaidalle3 test using openai-php/laravel client
// You need pass the parameter: prompt_img
Route::post('openaidalle3', [OpenaixController::class, 'openaidalle3']);



