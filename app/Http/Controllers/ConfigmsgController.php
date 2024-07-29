<?php

namespace App\Http\Controllers;

use App\Models\Configmsg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConfigmsgController extends Controller
{

    protected $configmsg;

    public function __construct(Configmsg $message){
        $this->configmsg = new Configmsg();
    }
    /**
     * Display a listing of the resource.
     */
    public function indexconfigmsg()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeconfigmsg(Request $request)
    {
		try {
			$validator = Validator::make($request->all(),
			[
				'arraymessage'       => 'required',
				'forporcentaje'      => 'required',
				'waittimeinseconds'  => 'required',
				'minNumberRandom'    => 'required',
				'maxNumberRandom'    => 'required'
			]);



			if($validator->fails()){
				$data = [
					'message' => 'Error en la validación de los datos: '.$validator->errors(),
					'status' => 400
				];
				return response()->json($data['message'], $data['status']);				
			}

	    	$result = $this->configmsg->create($request->all());
			if($result){
				return response()->json("Agregado el registro en config",200);
			}
			else{
				return response()->json("Problema agregando registro en config",500);
			}
		} catch (\Throwable $th) {
			return response()->json("Problema agregando registro en config".$th ,500);
		}    

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Configmsg $configmsg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateconfigmsg(Request $request, Configmsg $configmsg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyconfigmsg(Configmsg $configmsg)
    {
        //
    }
}
