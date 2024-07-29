<?php

use App\Http\Controllers\OpenaixController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\AssistantController;
use App\Http\Controllers\VisionController;
use App\Http\Controllers\AudioController;
use Illuminate\Support\Facades\Auth;
use OpenAI\Resources\Audio;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ConfigmsgController;

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


/* Message crud */

// post   - create    - store - create new message - message id passed at parameter
Route::post('storemessage', [MessageController::class, 'storemessage']);

// get    - read      - index - show all data
Route::get('indexmessage', [MessageController::class, 'indexmessage']);

// patch  - update    - update only register by id passed at parameter (for example 2)
Route::post('updatemessage', [MessageController::class, 'updatemessage']);

// delete - destroy   - delete only register by id passed at parameter (for example 4)
Route::post('destroymessage', [MessageController::class, 'destroymessage']);

// get    - show/{id} - show only register by id passed at parameter (for example 2)
Route::post('show', [AssistantController::class, 'show']);




// post   - create    - store - create new message - message id passed at parameter
Route::post('storeconfigmsg', [ConfigmsgController::class, 'storeconfigmsg']);


// get all users
Route::get('listuser', [RegisterController::class, 'listuser']);


// post openaidalle3 test using openai-php/laravel client
// You need pass the parameter: prompt_img
Route::post('openaidalle3', [OpenaixController::class, 'openaidalle3']);


// El quefrado
// post openaisavemsgs2 using http and guzzle and save messages
// You need pass the parameter: actual_message, idUser and idSystem
Route::post('openaisavemsgs2', [OpenaixController::class, 'openaisavemsgs2']);

// post openaisavemsgsemoji using http and guzzle and save messages
// You need pass the parameter: actual_message, idUser and idSystem
Route::post('openaisavemsgsemoji', [OpenaixController::class, 'openaisavemsgsemoji']);

// post msgproactive genera msg proactivo of assistant
// You need pass the parameter: idUser and idSystem
Route::post('msgproactive', [OpenaixController::class, 'msgproactive']);

// post msgproactive genera msg proactivo of assistant
// You need pass the parameter: idUser and idSystem
Route::post('msgproactiveok', [OpenaixController::class, 'msgproactiveok']);

// Intento de El quefrado version 2
// post openaisavemsgsversion2 test using http and guzzle and save messages
// You need pass the parameter: actual_message, idUser and idSystem
Route::post('openaisavemsgsversion2', [OpenaixController::class, 'openaisavemsgsversion2']);


// get msgs of chats
// You need pass the parameter: idUser and idSystem
Route::post('getMsgsChat', [OpenaixController::class, 'getMsgsChat']);

// get do you see in the image
Route::get('doyousee', [VisionController::class, 'doyousee']);

// get text to speech
Route::post('texttospeech', [AudioController::class, 'texttospeech']);

// get speech to text
Route::post('speechtotext', [AudioController::class, 'speechtotext']);

