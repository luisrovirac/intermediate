<?php

use App\Http\Controllers\OpenaixController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\AssistantController;

use Illuminate\Support\Facades\Auth;


/* Auth */
Route::post('register', [RegisterController::class, 'register']);
// For return error
Route::get('login', [RegisterController::class, 'login'])->name('login');
// For autenticate
Route::post('thelogin', [RegisterController::class, 'thelogin'])->name('thelogin');
//Route::post('logout', [RegisterController::class, 'logout']);
/*
Route::middleware('auth:api')->group( function() {
	Route::post('logout', [RegisterController::class, 'logout']);
});
*/
/*
Route::controller(RegisterController::class)->group(function(){

	Route::post('logout', [RegisterController::class, 'logout']);
  
})->middleware('auth:api');
*/

Route::middleware('auth:api')->group(function () {
	//Route::post('me', [AuthorizationController::class, 'me'])->name('me');
	Route::post('logout', [RegisterController::class, 'logout']);
	// get    - read      - index - show all data
	Route::get('index', [AssistantController::class, 'index'])->name('index');
});


/* Assistant crud */

// post   - create    - store - create new register
Route::post('store', [AssistantController::class, 'store']);

// get    - read      - index - show all data
//Route::get('index', [AssistantController::class, 'index']);

// patch  - update    - update only register by id passed at parameter (for example 2)
Route::post('update', [AssistantController::class, 'update']);

// delete - destroy   - delete only register by id passed at parameter (for example 4)
Route::post('destroy', [AssistantController::class, 'destroy']);

// get    - show/{id} - show only register by id passed at parameter (for example 2)
Route::post('show', [AssistantController::class, 'show']);


// get all users
Route::get('listuser', [RegisterController::class, 'listuser']);

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

// post openai03 test using http
// You need pass the parameter: actual_message
Route::post('openai03', [OpenaixController::class, 'openai03']);

// post openaisavemsgs test using openai-php/laravel client and save messages
// You need pass the parameter: actual_message
// Route::post('openaisavemsgs', [OpenaixController::class, 'openaisavemsgs']);

// get getopenaisavemsgs test using openai-php/laravel client and save messages
// You need pass the parameter: actual_message
Route::get('getopenaisavemsgs', [OpenaixController::class, 'getopenaisavemsgs']);

// get openai02 test using openai-php/laravel client
Route::get('openai02', [OpenaixController::class, 'openai02']);

// post openaidalle3 test using openai-php/laravel client
// You need pass the parameter: prompt_img
Route::post('openaidalle3', [OpenaixController::class, 'openaidalle3']);


// El quefrado
// post openaisavemsgs2 test using http and guzzle and save messages
// You need pass the parameter: actual_message, idUser and idSystem
Route::post('openaisavemsgs2', [OpenaixController::class, 'openaisavemsgs2']);

// get msgs of chats
// You need pass the parameter: idUser and idSystem
Route::post('getMsgsChat', [OpenaixController::class, 'getMsgsChat']);
