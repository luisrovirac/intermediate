<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use OpenAI\Laravel\Facades\OpenAI;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Utils;

use Exception;


/**
 * @OA\Info(title="API for projects", version="0.1")
 */

class AudioController extends Controller
{
	

    public function texttospeech(Request $request)
	{
        $apiKey = env('OPEN_API_KEY');

		// Initialize Guzzle HTTP client
		$client = new Client([
    		'base_uri' => 'https://api.openai.com/v1/',
		]);

		try {
    		// Request parameters
    		$params = [
        		'model' => 'tts-1',
        		'input' => "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.",
        		'voice' => 'alloy',
    		];

    		// Make POST request to OpenAI API
    		$response = $client->request('POST', 'audio/speech', [
        		'headers' => [
            		'Authorization' => 'Bearer ' . $apiKey,
            		'Content-Type' => 'application/json',
        		],
        		'json' => $params,
    		]);

    		// Save the audio to a file
    		file_put_contents('speech.mp3', $response->getBody());

    		echo "Audio generated successfully!\n";
		} catch (\Exception $e) {
    		echo "Error: " . $e->getMessage() . "\n";
		}

		return response()->json([
			'status' => 'success',
			'message' => 'Test Api texttospeech',
			//	'response' => $response,
			], 200);
	}


}

