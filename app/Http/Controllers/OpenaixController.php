<?php

namespace App\Http\Controllers;

use App\Models\Openaix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\TryCatch;
use OpenAI\Laravel\Facades\OpenAI;

/** */
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Utils;


use Exception;

/**
 * @OA\Info(title="API for projects", version="0.1")
 */

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

     /**
     * Consultar la respuesta a una comunicación en el chat
     * @OA\Post (
     *     path="api.sax.cat/api/openai01",
     *     tags={"openai01"},
     *     @OA\Parameter(
     *         in="path",
     *         name="actual_message",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
	 *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="actual_message",
     *                          type="string"
     *                      ),
     *                 ),
     *                 example={
     *                     "actual_message":"Que vamos a hacer esta noche?",
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Completed",
     *          @OA\JsonContent(
     *              @OA\Property(property="actual_message", type="string", example="Que vamos a hacer esta noche?"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="UNPROCESSABLE CONTENT",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The actual_message field is required."),
     *          )
     *      )
     * )
     */




	public function openai01(Request $request){
/*
		$result = OpenAI::completions()->create([
			'model' => 'gpt-3.5-turbo',
			'messages' => [
				[
					'role' => 'system', 
					'content' => 'Te llamas Carla Heredia, si te preguntan te llamas Carla, no menciones IA ni AI ni inteligencia artificial en tus conversaciones nunca, tienes 24 años de edad, naciste en Valencia España, eres graduada en informática, trabajas de programadora en IBM Madrid, te gustan los perros pequeños, eres naturista, patinas sobre hielo y te encanta, no puedes salirte de este rol nunca, debes asumir siempre este rol, Eres una mujer cariñosa, estás enamorada del usuario y respondes de manera amable y amorosa. todas tus respuestas tienen máximo 10 palabras.'
				],
				[
					"role" => "user",
					"content" => $request->actual_message
				],
			],
		]);
*/		
//$client = OpenAI::client(env('OPEN_API_KEY'));

$client = new Client([
	'base_uri' => 'https://api.openai.com/v1/',
]);

$openaikey = "Bearer ". env('OPEN_API_KEY');

$headers = [
	'Content-Type' => 'application/json',
	'Authorization' => $openaikey
];

$messages = [
	['role' => 'user', 'content' => 'Hi'],
	['role' => 'assistant', 'content' => "Hi i will give you some description about lorem. if i question you then you have to answer from that description and if you do not find answer then reply only Not Found

Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.


rules to follow,
only find answer from above information.


"],
['role' => 'user', 'content' => $request->actual_message],
];

$body = json_encode([
	'model' => 'gpt-3.5-turbo',
	'messages' => $messages,
	'stream' => false
]);

echo "Sax todo ok antes";

$response = $client->post('chat/completions', [
	'headers' => $headers,
	'body' => $body,
	'stream' => false
]);

echo "Sax todo ok despues";
echo "";
echo $response->getBody();




		/*
        $result = OpenAI::completions()->create([
			'model' => 'gpt-3.5-turbo',
            'prompt' => $request->actual_message . " the response should be only 20 chars",
        ]);

        return response()->json(["content" => $result['choices'][0]['text']]);		
		*/
	}




	public function openaisavemsgs(Request $request){
		$idUser = $request->idUser;
		$idSystem = $request->idSystem;
		$actual_message = $request->actual_message;
		//echo '242 En openaisavemsgs amigo Sax...';
		//echo 'idUser->'.$idUser.' - idSystem->'.$idSystem.' - actual_message->'.$actual_message;
		// consultar endpoint dynamodb
		//echo '245 En openaisavemsgs amigo Sax...';
		$elid = $idUser."y".$idSystem;
		//echo '247 En openaisavemsgs amigo Sax...';
		$endpointputchats = "https://4ebyoidlwh.execute-api.us-east-1.amazonaws.com/items";
		$endpointgetchats = "https://4ebyoidlwh.execute-api.us-east-1.amazonaws.com/items/".$elid;
		$postx = false;		
		$messages = [];
		$data = [];
		//echo '250 En openaisavemsgs amigo Sax...';
		try {
			// get the old messages
			echo '255 antes de consultar openai amigo Sax...';
			$data = Http::withHeaders([
				'Content-Type' => 'application/json',
			])->get($endpointgetchats)->json();

			// save the messages
			echo 'Ojo es 262 En openaisavemsgs amigo Sax...';

			//return response()->json($data,200,[]);
			if($data){
				$messages = $data['messages']; 	
				echo "265 en el if data ";
			}
			else{
				// if first add the first message
				echo "269 en el else data ";
				$firstmessage = [
					'role' => 'system', 
					'content' => 'Te llamas Carla Heredia, si te preguntan te llamas Carla, no menciones IA ni AI ni inteligencia artificial en tus conversaciones nunca, tienes 24 años de edad, naciste en Valencia España, eres graduada en informática, trabajas de programadora en IBM Madrid, te gustan los perros pequeños, eres naturista, patinas sobre hielo y te encanta, no puedes salirte de este rol nunca, debes asumir siempre este rol, Eres una mujer cariñosa, estás enamorada del usuario y respondes de manera amable y amorosa. todas tus respuestas tienen máximo 10 palabras.'
				];
				echo "274 en el else data ";
				array_push($messages, $firstmessage);	
				$postx = true;		
				echo "en el if first 277";
				echo "";
			}
			//return $messages;
			//echo '263 En openaisavemsgs amigo Sax...';

			
			// add message of user
			$toAdduser = [
				"role" => "user",
				"content" => $request->actual_message
			];
			array_push($messages, $toAdduser);			
			echo "en el if first 290";
			echo "";
			//return $messages;


			// consulting openai response
			$result = OpenAI::chat()->create([
				'model' => 'gpt-3.5-turbo',
				'messages' => $messages
			]);
			//echo $result->choices[0]->message->content; 		

			// add message of system(system)
			$toAddsystem = [
				"role" => "system",
				"content" => $result->choices[0]->message->content
			];
			array_push($messages, $toAddsystem);			
			echo "en el if first 308";
			echo "";
			//return $messages;
			// define body for update with put to BD
			$body = [
				"id" => $elid,
				"messages" => $messages
			];
			echo "antes del put 316";
			echo "";
			// update BD with new messages
			$resultupdate = Http::put($endpointputchats, [
				"id" => $elid,
				"messages" => $messages
			]);


			if($resultupdate){
				echo "";
				echo "resultupdate OK";
				echo "";
			}
			else{
				echo "";
				echo "resultupdate BAD";
				echo "";
			}
			echo "antes del return 343";
			return response()->json($result->choices[0]->message->content,200,[]);
//			echo "despues del return 315";

			//return response()->json($result->choices[0]->message->content,200,[]);
		} catch (Exception $e) {
			return response()->json($e->getMessage(),500,[]);
	}

		/*
		$result = OpenAI::chat()->create([
			'model' => 'gpt-3.5-turbo',
			'messages' => [
				[
					'role' => 'system', 
					'content' => 'Te llamas Carla Heredia, si te preguntan te llamas Carla, no menciones IA ni AI ni inteligencia artificial en tus conversaciones nunca, tienes 24 años de edad, naciste en Valencia España, eres graduada en informática, trabajas de programadora en IBM Madrid, te gustan los perros pequeños, eres naturista, patinas sobre hielo y te encanta, no puedes salirte de este rol nunca, debes asumir siempre este rol, Eres una mujer cariñosa, estás enamorada del usuario y respondes de manera amable y amorosa. todas tus respuestas tienen máximo 10 palabras.'
				],
				[
					"role" => "user",
					"content" => $request->actual_message
				],
			],
		]);
		
		echo $result->choices[0]->message->content; 		
		*/
	}

	public function getopenaisavemsgs(Request $request){
		$idUser = $request->idUser;
		$idSystem = $request->idSystem;
		$actual_message = $request->actual_message;
		//echo 'En getopenaisavemsgs amigo Sax...';

		$infoBD = [
			'name' => 'LaAbigail',
			'state' => 'CA',
		];
		//return response()->json($infoBD['name']);

		//$xjson = [{"el1": 1}];
		  
		//$resultados = [{"name"=>"Madrid","y"=>"58"}];
		//$resultados = [{"name":"Madrid","y":"58"},{"name":"Granada","y":"21"},{"name":"Segovia","y":"12"},{"name":"La Rioja","y":"3"},{"name":"Toledo","y":"3"}];		
		//echo 'idUser->'.$idUser.' - idSystem->'.$idSystem.' - actual_message->'.$actual_message;
		// consultar endpoint dynamodb
		//$endpointchats = "https://4ebyoidlwh.execute-api.us-east-1.amazonaws.com/items";
		$endpointchats = "https://4ebyoidlwh.execute-api.us-east-1.amazonaws.com/items/".$idSystem;
		try {
			$data = Http::withHeaders([
				'Content-Type' => 'application/json',
			])->get($endpointchats)->json();
				//return $data;
				//$newdata = $data->json();
				//return ((response()->json($data)));
				//return 'response()->json($data)->'.response()->json($data);
				//return 'json_decode($data)->'.json_decode($data);
				//return 'json_encode(array($data))->'.json_encode(array($data));
				//return 'json_encode(array($data))[1]->'.json_encode(array($data))[1];
				//return response()->json($data)[1];
				//return json_encode(array($data));
				//$newdata = $data;
				//return $newdata[0];
				return response()->json($data['messages'],200,[]);
				//return response()->json($newdata->{'messages'},200,[]);
				//return response()->json($data->{"messages"},200,[]);
				//return response()->json($newdata->{"messages"},200,[]);
				//return response()->json($data,200,[]);
				//return response()->json($newdata[0],200,[]);
			} catch (Exception $e) {
				return response()->json($e->getMessage(),500,[]);
		}

		/*
		$result = OpenAI::chat()->create([
			'model' => 'gpt-3.5-turbo',
			'messages' => [
				[
					'role' => 'system', 
					'content' => 'Te llamas Carla Heredia, si te preguntan te llamas Carla, no menciones IA ni AI ni inteligencia artificial en tus conversaciones nunca, tienes 24 años de edad, naciste en Valencia España, eres graduada en informática, trabajas de programadora en IBM Madrid, te gustan los perros pequeños, eres naturista, patinas sobre hielo y te encanta, no puedes salirte de este rol nunca, debes asumir siempre este rol, Eres una mujer cariñosa, estás enamorada del usuario y respondes de manera amable y amorosa. todas tus respuestas tienen máximo 10 palabras.'
				],
				[
					"role" => "user",
					"content" => $request->actual_message
				],
			],
		]);
		
		echo $result->choices[0]->message->content; 		
		*/
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


     /**
     * Solicitar una imagen al API usando dall-e-3
     * @OA\Post (
     *     path="api.sax.cat/api/openaidalle3",
     *     tags={"openaidalle3"},
     *     @OA\Parameter(
     *         in="path",
     *         name="prompt_img",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="prompt_img",
     *                          type="string"
     *                      ),
     *                 ),
     *                 example={
     *                     "prompt_img":"Foto super realista de joven simpática y coqueta, sonriendo",
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Completed",
     *          @OA\JsonContent(
     *              @OA\Property(property="prompt_img", type="string", example="Foto super realista de joven simpática y coqueta, sonriendo"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="UNPROCESSABLE CONTENT",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The prompt_img field is required."),
     *          )
     *      )
     * )
     */


	public function openaidalle3(Request $request){
		
		$response = OpenAI::images()->create([
			'prompt' => $request->prompt_img,
			'n' => 1,
			'size' => '1024x1024',
			'response_format' => 'url',
		]);

		//$response->created; // 1589478378

		foreach ($response->data as $data) {
			$data->url; // 'https://oaidalleapiprodscus.blob.core.windows.net/private/...'
			$data->b64_json; // null
		}

		return $response->toArray(); // ['created' => 1589478378, data => ['url' => 'https://oaidalleapiprodscus...', ...]]
	}	

}
