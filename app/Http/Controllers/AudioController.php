<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use OpenAI\Laravel\Facades\OpenAI;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Utils;

use Exception;


class AudioController extends Controller
{
	

    public function texttospeech(Request $request)
	{
	try {
		$apiKey = env('OPEN_API_KEY');

        $request->validate([
            'input' => 'required',
            'idUser' => 'required',
            'idSystem' => 'required',
            'voice' => 'required',
        ]);

		// Initialize Guzzle HTTP client
		$client = new Client([
    		'base_uri' => 'https://api.openai.com/v1/',
		]);

    		// Request parameters
    		$params = [
        		'model' => 'tts-1',
        		'input' => $request->input,
        		'voice' => $request->voice,
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
			$namemp3 = $request->idUser."y".$request->idSystem.".mp3";
    		file_put_contents($namemp3, $response->getBody());
    		//file_put_contents('newspeech.mp3', $response->getBody());

    		//echo "Audio generated successfully!\n";
		} catch (\Exception $e) {
    		echo "Error: " . $e->getMessage() . "\n";
			return response()->json([
				'status' => 'failed',
				'message' => 'Error generating Audio with texttospeech',
				'response' => $e->getMessage()
				], 500);
	
		}

		$pathfilex =  asset('/'.$namemp3);

		return response()->json([
			'status' => 'success',
			'message' => 'Audio generated successfully! with texttospeech',
			'response' => $pathfilex
			], 200);

		//return response()->download($pathx, 'newspeech.mp3', ['Content-Type' => 'audio/mp3']);
		

/*
        if (file_exists($pathfilex)) {
            return response()->download($pathfilex);
        } else {
			return response()->json([
				'status' => 'error',
				'message' => 'File not found',
				//'response' => $response->getBody()
				], 404);
        }
*/
/*
		return response()->json([
			'status' => 'success',
			'message' => 'Test Api texttospeech',
			//'response' => $response->getBody()
			], 200);
*/			
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

