<?php

namespace App\Http\Controllers\API;

use App\Models\Assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class AssistantController extends Controller
{
    protected $assistant;

    public function __construct(Assistant $assistant){
        $this->assistant = new Assistant();
    }

    public function index()
    {
		//return response()->json("Index -> Mostrando los registros",200);
        return $this->assistant->all();
    }

	public function show(Request $request){
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
			$result = $this->assistant->find($request->id);  
			if($result){
				return response()->json($result,200);
			}
			else{
				return response()->json("Registro no encontrado",500);
			}
		} catch (\Throwable $th) {
			return response()->json("Problema buscando este registro en Assistant".$th ,500);
		}
	}
    
    public function store(Request $request)
    {
		try {
			$validator = Validator::make($request->all(),
			[
				'name'    => 'required',
				'details' => 'required',
			]);

			if($validator->fails()){
				$data = [
					'message' => 'Error en la validación de los datos: '.$validator->errors(),
					'status' => 400
				];
				return response()->json($data['message'], $data['status']);				
			}

	    	$result = $this->assistant->create($request->all());
			if($result){
				return response()->json("Agregado el registro en Assistant",200);
			}
			else{
				return response()->json("Problema agregando registro en Assistant",500);
			}
		} catch (\Throwable $th) {
			return response()->json("Problema agregando registro en Assistant".$th ,500);
		}
    }
  

    public function update(Request $request)
    {
         $assistant = Assistant::find($request->id);


		 if (!$assistant) {
			 $data = [
				 'message' => 'Asistente no encontrado',
				 'status' => 404
			 ];
			 return response()->json($data, 404);
		 }
 
		 $validator = Validator::make($request->all(), [
			 'name' => 'required|max:255',
			 'details' => 'required',
		 ]);
 
		 if ($validator->fails()) {
			 $data = [
				 'message' => 'Error en la validación de los datos',
				 'errors' => $validator->errors(),
				 'status' => 400
			 ];
			 return response()->json($data, 400);
		 }
 
		 $assistant->name = $request->name;
		 $assistant->details = $request->details;
 
		 $assistant->save();
 
		 $data = [
			 'message' => 'Asistente actualizado',
			 'assistant' => $assistant,
			 'status' => 200
		 ];
 
		 return response()->json($data, 200);
 
	}

    public function destroy(Request $request)
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
			$result = $this->assistant->find($request->id);  
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
			return response()->json("Problema buscando este registro en Assistant".$th ,500);
		}
	
    }
}