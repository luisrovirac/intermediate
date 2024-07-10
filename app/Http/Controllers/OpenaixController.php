<?php

namespace App\Http\Controllers;

// quitar luego
use Illuminate\Support\Facades\DB;


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

use App\Models\Assistant;


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

	public function getMsgsChat(Request $request){
	//public function getMsgsChat($idUser,$idSystem){
		//return response()->json($request);
		$endpointgetchats = "https://4ebyoidlwh.execute-api.us-east-1.amazonaws.com/items/".$request->idUser."y".$request->idSystem;
		//return response()->json($endpointgetchats);
		$dataChat = Http::withHeaders([
			'Content-Type' => 'application/json',
		])->get($endpointgetchats)->json();
		return $dataChat;
	}
     /**
     * Consultar la respuesta a una comunicación en el chat
     * @OA\Post (
     *     path="api.sax.cat/api/openaisavemsgs2",
     *     tags={"openaisavemsgs2"},
     *     security={ {"bearer": {} }},
     *     @OA\Parameter(
     *         in="path",
     *         name="actual_message",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         name="idUser",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         name="idSystem",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Where enter the information of actual_message and idUser",
     *    @OA\JsonContent(
     *       required={"actual_message","idUser"},
     *       @OA\Property(property="actual_message", type="string", example="Que vamos a hacer esta noche?"),
     *       @OA\Property(property="idUser", type="integer", example=7),
     *       @OA\Property(property="idSystem", type="integer", example=2),
     *    ),
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Completed",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Podemos tomar un café"),
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



	public function openaisavemsgs2(Request $request){
		// El quefrado		
		//return response()->json('data 428',200);
		$idUser = $request->idUser;
		$idSystem = $request->idSystem;
		$actual_message = $request->actual_message;
		$idAssistant = $request->idSystem;
		//$idAssistant = $request->idAssistant;
		$elid = $idUser."y".$idSystem;

		$endpointputchats = "https://4ebyoidlwh.execute-api.us-east-1.amazonaws.com/items";
		$endpointgetchats = "https://4ebyoidlwh.execute-api.us-east-1.amazonaws.com/items/".$elid;
		$postx = false;		
		$messages = [];
		$data = [];
		try {
			// get the old messages
			//$data = $this->getMsgsChat($idUser,$idSystem);
			//return response()->json($data,200);

			
			$data = Http::withHeaders([
				'Content-Type' => 'application/json',
			])->get($endpointgetchats)->json();
			
			//$data = false;
			// save the messages
			if($data){
				$messages = $data['messages']; 	
			}
			else{
				//$result = Assistant::all();
				//$result = DB::table('assistants')->where('id', $idAssistant)->first();				
				//return response()->json($idAssistant,200);
				$result = Assistant::find($idAssistant);
				//$result = Assistant::find(1);
				//return response()->json($result,200);
				//return response()->json($result->details,200);
				//$result = $this->assistant->find($request->id);  
				if($result){
					//return response()->json($result->details,200);
					$content = $result->details;
				}
				else{
					//return response()->json("Registro no encontrado -439",500);
					$content = 'Te llamas Carla Heredia, si te preguntan te llamas Carla, no menciones IA ni AI ni inteligencia artificial en tus conversaciones nunca, tienes 24 años de edad, naciste en Valencia España, eres graduada en informática, trabajas de programadora en IBM Madrid, te gustan los perros pequeños, eres naturista, patinas sobre hielo y te encanta, no puedes salirte de este rol nunca, debes asumir siempre este rol, Eres una mujer cariñosa, estás enamorada del usuario y respondes de manera amable y amorosa. todas tus respuestas tienen máximo 14 palabras.';
				}
			
				// if first add the first message
				$firstmessage = [
					'role' => 'system', 
					'content' => $content
				];

				array_push($messages, $firstmessage);	
			}
			
			// add message of user
			$toAdduser = [
				"role" => "user",
				"content" => $request->actual_message
			];
			array_push($messages, $toAdduser);			

			// start consulting openai response
			$client = new Client([
				'base_uri' => 'https://api.openai.com/v1/',
			]);
		
			$openaikey = "Bearer ". env('OPEN_API_KEY');
		
			$headers = [
				'Content-Type' => 'application/json',
				'Authorization' => $openaikey
			];
		
			$body = json_encode([
				//'model' => 'gpt-3.5-turbo',
				'model' => 'gpt-4o',
				'messages' => $messages,
				'stream' => false
			]);
		
			$response = $client->post('chat/completions', [
				'headers' => $headers,
				'body' => $body,
				'stream' => false
			]);
		
			$result = json_decode($response->getBody()->getContents(), true);
			$content = response()->json($result['choices'][0]['message']['content']);
		
			// add message of system(system)
			$toAddsystem = [
				"role" => "system",
				"content" => $result['choices'][0]['message']['content']
			];
			array_push($messages, $toAddsystem);			

			// define body for update with put to BD
			$body = [
				"id" => $elid,
				"messages" => $messages
			];

			// update BD with new messages
			$resultupdate = Http::put($endpointputchats, [
				"id" => $elid,
				"messages" => $messages
			]);

			return response()->json($result['choices'][0]['message']['content'],200,[]);
		} catch (Exception $e) {
			return response()->json($e->getMessage(),500,[]);
	}

	}


     /**
     * Consultar la respuesta a una comunicación en el chat
	 * y responda con 1 emoji
     * @OA\Post (
     *     path="api.sax.cat/api/openaisavemsgsemoji",
     *     tags={"openaisavemsgsemoji"},
     *     security={ {"bearer": {} }},
     *     @OA\Parameter(
     *         in="path",
     *         name="actual_message",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         name="idUser",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         name="idSystem",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Where enter the information of actual_message and idUser",
     *    @OA\JsonContent(
     *       required={"actual_message","idUser"},
     *       @OA\Property(property="actual_message", type="string", example="Que vamos a hacer esta noche?"),
     *       @OA\Property(property="idUser", type="integer", example=7),
     *       @OA\Property(property="idSystem", type="integer", example=2),
     *    ),
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Completed",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Podemos tomar un café"),
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



	 public function openaisavemsgsemoji(Request $request){
		// Version del quefrado para que retorne solo emojis		
		//return response()->json('data 428',200);
		try {

			$request->validate([
				'actual_message' => 'required', 
				'idUser'         => 'required',
				'idSystem'       => 'required',
				'cuantosemoji'   => 'required', 
			]);

			$idUser = $request->idUser;
			$idSystem = $request->idSystem;
			$actual_message = $request->actual_message;
			$idAssistant = $request->idSystem;
			//$idAssistant = $request->idAssistant;
			$elid = $idUser."y".$idSystem;
	
			$endpointputchats = "https://4ebyoidlwh.execute-api.us-east-1.amazonaws.com/items";
			$endpointgetchats = "https://4ebyoidlwh.execute-api.us-east-1.amazonaws.com/items/".$elid;
			$postx = false;		
			$messages = [];
			$data = [];
				
			// get the old messages
			//$data = $this->getMsgsChat($idUser,$idSystem);
			//return response()->json($data,200);

			
			$data = Http::withHeaders([
				'Content-Type' => 'application/json',
			])->get($endpointgetchats)->json();
			
			//$data = false;
			// save the messages
			if($data){
				$messages = $data['messages']; 	
			}
			else{
				//$result = Assistant::all();
				//$result = DB::table('assistants')->where('id', $idAssistant)->first();				
				//return response()->json($idAssistant,200);
				$result = Assistant::find($idAssistant);
				//$result = Assistant::find(1);
				//return response()->json($result,200);
				//return response()->json($result->details,200);
				//$result = $this->assistant->find($request->id);  
				if($result){
					//return response()->json($result->details,200);
					$content = $result->details;
				}
				else{
					//return response()->json("Registro no encontrado -439",500);
					$content = 'Te llamas Carla Heredia, si te preguntan te llamas Carla, no menciones IA ni AI ni inteligencia artificial en tus conversaciones nunca, tienes 24 años de edad, naciste en Valencia España, eres graduada en informática, trabajas de programadora en IBM Madrid, te gustan los perros pequeños, eres naturista, patinas sobre hielo y te encanta, no puedes salirte de este rol nunca, debes asumir siempre este rol, Eres una mujer cariñosa, estás enamorada del usuario y respondes de manera amable y amorosa. todas tus respuestas tienen máximo 14 palabras.';
				}
			
				// if first add the first message
				$firstmessage = [
					'role' => 'system', 
					'content' => $content
				];

				array_push($messages, $firstmessage);	
			}
			
			// add message of user
			$toAdduser = [
				"role" => "user",
				"content" => $request->actual_message
			];
			array_push($messages, $toAdduser);			

			// start consulting openai response
			$client = new Client([
				'base_uri' => 'https://api.openai.com/v1/',
			]);
		
			$openaikey = "Bearer ". env('OPEN_API_KEY');
		
			$headers = [
				'Content-Type' => 'application/json',
				'Authorization' => $openaikey
			];
			$cuantosemoji = $request->cuantosemoji;
			$contentemoji = 'todas tus respuestas en este momento deben consistir solo en '.$cuantosemoji.' emojis que se corresponda como respuesta a lo que te han planteado, es lo único que debes considerar';
			// if first add the first message
			$messagesemoji = [
				'role' => 'system', 
				'content' => $contentemoji,
				"role" => "user",
				"content" => $request->actual_message
			];
		
			$body = json_encode([
				//'model' => 'gpt-3.5-turbo',
				'model' => 'gpt-4o',
				'messages' => $messagesemoji,
				'stream' => false
			]);
		
			$response = $client->post('chat/completions', [
				'headers' => $headers,
				'body' => $body,
				'stream' => false
			]);
		
			$result = json_decode($response->getBody()->getContents(), true);
			$content = response()->json($result['choices'][0]['message']['content']);
		
			// add message of system(system)
			$toAddsystem = [
				"role" => "system",
				"content" => $result['choices'][0]['message']['content']
			];
			array_push($messages, $toAddsystem);			

			// define body for update with put to BD
			$body = [
				"id" => $elid,
				"messages" => $messages
			];

			// update BD with new messages
			$resultupdate = Http::put($endpointputchats, $body);

			return response()->json($result['choices'][0]['message']['content'],200,[]);
		} catch (Exception $e) {
			return response()->json($e->getMessage(),500,[]);
	}

	}




	public function openaisavemsgsversion2(Request $request){
		// El futuro quefrado v2		
		//return response()->json('data 428',200);
		$idUser = $request->idUser;
		$idSystem = $request->idSystem;
		$actual_message = $request->actual_message;
		$idAssistant = $request->idSystem;
		//$idAssistant = $request->idAssistant;
		$elid = $idUser."y".$idSystem;

		$endpointputchats = "https://4ebyoidlwh.execute-api.us-east-1.amazonaws.com/items";
		$endpointgetchats = "https://4ebyoidlwh.execute-api.us-east-1.amazonaws.com/items/".$elid;
		$postx = false;		
		$messages = [];
		$data = [];
		try {
			// get the old messages
			//$data = $this->getMsgsChat($idUser,$idSystem);
			//return response()->json($data,200);

			
			$data = Http::withHeaders([
				'Content-Type' => 'application/json',
			])->get($endpointgetchats)->json();
			
			//$data = false;
			// save the messages
			if($data){
				$messages = $data['messages']; 	
			}
			else{
				//$result = Assistant::all();
				//$result = DB::table('assistants')->where('id', $idAssistant)->first();				
				//return response()->json($idAssistant,200);
				$result = Assistant::find($idAssistant);
				//$result = Assistant::find(1);
				//return response()->json($result,200);
				//return response()->json($result->details,200);
				//$result = $this->assistant->find($request->id);  
				if($result){
					//return response()->json($result->details,200);
					$content = $result->details;
				}
				else{
					//return response()->json("Registro no encontrado -439",500);
					$content = 'Te llamas Carla Heredia, si te preguntan te llamas Carla, no menciones IA ni AI ni inteligencia artificial en tus conversaciones nunca, tienes 24 años de edad, naciste en Valencia España, eres graduada en informática, trabajas de programadora en IBM Madrid, te gustan los perros pequeños, eres naturista, patinas sobre hielo y te encanta, no puedes salirte de este rol nunca, debes asumir siempre este rol, Eres una mujer cariñosa, estás enamorada del usuario y respondes de manera amable y amorosa. todas tus respuestas tienen máximo 14 palabras.';
				}
			
				// if first add the first message
				$firstmessage = [
					'role' => 'system', 
					'content' => $content
				];

				array_push($messages, $firstmessage);	
			}
			
			// add message of user
			$toAdduser = [
				"role" => "user",
				"content" => $request->actual_message
			];
			array_push($messages, $toAdduser);			

			// start consulting openai response
			$client = new Client([
				'base_uri' => 'https://api.openai.com/v1/',
			]);
		
			$openaikey = "Bearer ". env('OPEN_API_KEY');
		
			$headers = [
				'Content-Type' => 'application/json',
				'Authorization' => $openaikey
			];
		
			$body = json_encode([
				//'model' => 'gpt-3.5-turbo',
				'model' => 'gpt-4o',
				'messages' => $messages,
				'stream' => false
			]);
		
			$response = $client->post('chat/completions', [
				'headers' => $headers,
				'body' => $body,
				'stream' => false
			]);
		
			$result = json_decode($response->getBody()->getContents(), true);
			$content = response()->json($result['choices'][0]['message']['content']);
		
			// add message of system(system)
			$toAddsystem = [
				"role" => "system",
				"content" => $result['choices'][0]['message']['content']
			];
			array_push($messages, $toAddsystem);			

			// define body for update with put to BD
			$body = [
				"id" => $elid,
				"messages" => $messages
			];

			// update BD with new messages
			$resultupdate = Http::put($endpointputchats, [
				"id" => $elid,
				"messages" => $messages
			]);

			return response()->json($result['choices'][0]['message']['content'],200,[]);
		} catch (Exception $e) {
			return response()->json($e->getMessage(),500,[]);
	}

	}


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

