<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    protected $message;

    public function __construct(Message $message){
        $this->message = new Message();
    }

    /**
     * Display a listing of the resource.
     */
    public function indexmessage()
    {
		try {
			return $this->message->all();
		} catch (\Throwable $th) {
			return response()->json('Error', $th);				
		}
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storemessage(Request $request)
    {
		try {
			$validator = Validator::make($request->all(),
			[
				'message'        => 'required'
			]);

			if($validator->fails()){
				$data = [
					'message' => 'Error en la validación de los datos: '.$validator->errors(),
					'status' => 400
				];
				return response()->json($data['message'], $data['status']);				
			}

	    	$result = $this->message->create($request->all());
			if($result){
				return response()->json("Agregado el registro en message",200);
			}
			else{
				return response()->json("Problema agregando registro en message",500);
			}
		} catch (\Throwable $th) {
			return response()->json("Problema agregando registro en message".$th ,500);
		}    }

    /**
     * Display the specified resource.
     */
    public function showmessage(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatemessage(Request $request, Message $message)
    {
		$message = Message::find($request->id);


		if (!$message) {
			$data = [
				'message' => 'Mensaje no encontrado',
				'status' => 404
			];
			return response()->json($data, 404);
		}

		$validator = Validator::make($request->all(), [
			'message' => 'required|max:755',
		]);

		if ($validator->fails()) {
			$data = [
				'message' => 'Error en la validación de los datos',
				'errors' => $validator->errors(),
				'status' => 400
			];
			return response()->json($data, 400);
		}

		$message->message = $request->message;

		$message->save();

		$data = [
			'message' => 'Mensaje actualizado',
			'Message' => $message,
			'status' => 200
		];

		return response()->json($data, 200);

   }

    /**
     * Remove the specified resource from storage.
     */
    public function destroymessage(Request $request)
    {
		try {
			$validator = Validator::make($request->all(),
			[
				'id'    => 'required',
			]);

			if($validator->fails()){
				$data = [
					'message' => 'Error en la validación de los datos: '.$validator->errors(),
					'status' => 400
				];
				return response()->json($data['message'], $data['status']);				
			}
			$result = $this->message->find($request->id);  
			if($result){
				$theresult = $result->delete();
				if($theresult){
					return response()->json("Registro eliminado con éxito", 200);
				}
				else{
					return response()->json("Registro no se ha eliminado", 400);
				}
			}
			else{
				return response()->json("Registro no encontrado",400);
			}
		} catch (\Throwable $th) {
			return response()->json("Problema buscando este registro en message".$th ,500);
		}
    }
}
