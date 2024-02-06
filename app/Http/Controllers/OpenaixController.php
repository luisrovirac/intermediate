<?php

namespace App\Http\Controllers;

use App\Models\Openaix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\TryCatch;
use OpenAI\Laravel\Facades\OpenAI;

class OpenaixController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Openaix $openaix)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Openaix $openaix)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Openaix $openaix)
    {
        //
    }

    public function getTest() {
        $dummy = "Data Info Fake";
        return response()->json([
                'status' => 'success',
                'message' => 'Test Api',
                'data' => $dummy
        ], 200);
    }

	public function getopenai() {
		$search = "who is google";

		$data = Http::withHeaders([
			'Content-Type' => 'application/json',
			'Authorization' => 'Bearer ', env('OPEN_API_KEY') 
		])->post(
			'https://api.openai.com/v1/chat/completions',[
				'model' => 'gpt-3.5-turbo',
				'messages' => [
					[
						'role' => 'user', 'content' => $search
					]
				],
				'temperature' => 0.5,
				'max_tokens' => 200,
				'top_p' => 1.0,

			])->json();
			return response()->json($data,200,[]);
	}

	public function postopenai() {
		$search = "who is google";
		try {
			$data = Http::withHeaders([
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer ', env('OPEN_API_KEY') 
			])->post(
				'https://api.openai.com/v1/chat/completions',[
					'model' => 'gpt-3.5-turbo',
					'messages' => [
						[
							'role' => 'user', 'content' => $search
						]
					],
					//'temperature' => 0.5,
					//'max_tokens' => 200,
					//'top_p' => 1.0,
				])->json();
				return response()->json($data,200,[]);
			} catch (\Throwable $th) {
				return response()->json($th,200,[]);
		}
	}

	public function coinmarket01() {
/**
 * Requires curl enabled in php.ini
 **/

echo "Linea 112......";

 $url = 'https://sandbox-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
 $parameters = [
   'start' => '1',
   'limit' => '5000',
   'convert' => 'USD'
 ];

 echo "Linea 121......";

 $headers = [
   'Accepts: application/json',
   'X-CMC_PRO_API_KEY: 00c8eae1-bfff-45e6-ac60-58c6df43217c'
 ];

 echo "Linea 128......";

 $qs = http_build_query($parameters); // query string encode the parameters
 $request = "{$url}?{$qs}"; // create the request URL
 
 echo "Linea 133......";

 try {
	$curl = curl_init(); // Get cURL resource
	// Set cURL options

	echo "Linea 139......";

	curl_setopt_array($curl, array(
	  CURLOPT_URL => $request,            // set the request URL
	  CURLOPT_HTTPHEADER => $headers,     // set the headers 
	  CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
	));
	
	echo "Linea 147......";

	$response = curl_exec($curl); // Send the request, save the response

	echo "Linea 151......";

	print_r(json_decode($response)); // print json decoded response
	curl_close($curl); // Close request
	} catch (\Throwable $th) {
		print_r(json_decode($th)); // print json decoded response $th
	}

 
}

	public function openai01(){

		$result = OpenAI::chat()->create([
			'model' => 'gpt-3.5-turbo',
			'messages' => [
				[
					'role' => 'system', 
					'content' => 'Eres una mujer cariñosa, estás enamorada del usuario y respondes de manera amable y amorosa. todas tus respuestas tienen máximo 10 palabras.'
				],
				[
					"role" => "user",
					"content" => "Que vamos hacer esta tarde?"
				],
			],
		]);
		
		echo $result->choices[0]->message->content; // Hello! How can I assist you today?		
	}


	public function openai02(){

		try {
			$result = OpenAI::completions()->create([
				'model' => 'gpt-3.5-turbo',
				'prompt' => 'Que vamos hacer esta tarde?'
			]);
			echo $result; 
		} catch (\Throwable $th) {
			echo $th;
		}
		//echo $result->choices[0]->message->content; // Hello! How can I assist you today?		
	}	
}
