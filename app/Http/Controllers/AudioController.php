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

/*
// ini		
        $apiKey = env('OPEN_API_KEY');

        $request->validate([
            'input' => 'required',
        ]);

		// Initialize Guzzle HTTP client
		$client = new Client([
    		'base_uri' => 'https://api.openai.com/v1/',
		]);

		try {
    		// Request parameters
    		$params = [
        		'model' => 'tts-1',
        		'input' => "This is there are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words",
        		//'input' => $request->input,
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
    		file_put_contents('newspeech.mp3', $response->getBody());

    		echo "Audio generated successfully!\n";
		} catch (\Exception $e) {
    		echo "Error: " . $e->getMessage() . "\n";
		}

// end
*/
        //$filePath = "/../../../public/newspeech.mp3";
		$filePath = public_path('newspeech.mp3');

/*		
		return response()->json([
			'status' => 'success',
			'message' => 'Test Api texttospeech',
			'response' => $filePath
			], 200);
*/

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
			return response()->json([
				'status' => 'error',
				'message' => 'File not found',
				//'response' => $response->getBody()
				], 404);
        }

		return response()->json([
			'status' => 'success',
			'message' => 'Test Api texttospeech',
			//'response' => $response->getBody()
			], 200);
	}


    public function speechtotext(Request $request){
		// path at speech test: C:\Users\luisr\Music\fortest\speechfortest.mp3
        $testaudio = $request->file('audio');
        $apiKey = env('OPEN_API_KEY');
/*
		if($request->audio){
			return response()->json([
				'status' => 'success',
				'message' => 'first IF Test Api speechtotext',
				'data' => $testaudio->getClientOriginalName()
			], 200);
		}		
		else{
			return response()->json([
				'status' => 'success',
				'message' => 'first ELSE Test Api speechtotext',
			], 200);
		}		
		*/

        $request->validate([
            'audio' => 'required|mimes:flac,m4a,mp3,mp4,mpeg,mpga',
        ]);

        $filePath = $request->file('audio')->store('temp'); 
        $fileContent = file_get_contents(storage_path('app/'.$filePath));
        $client = new Client();

        try {
            $response = $client->post('https://api.openai.com/v1/audio/transcriptions', [
                'headers' => [
                    'Authorization' => 'Bearer '.$apiKey,
                ],
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => $fileContent,
                        'filename' => $testaudio->getClientOriginalName(), 
                    ],
                    [
                        'name' => 'response_format',
                        'contents' => 'text',
                    ],
                    [
                        'name' => 'model',
                        'contents' => 'whisper-1',
                    ],
                ],
            ]);

            $result = $response->getBody()->getContents();
			return response()->json([
				'status' => 'success',
				'message' => 'Test Api speechtotext',
				'response' => $result,
			], 200);
	
        } catch (\Exception $e) {
            $errorMessage = 'An error occurred while processing your request.';

			return response()->json([
				'status' => 'error',
				'message' => $errorMessage,
				'type error' => $e,
			], 500);

        } 
    }


}

