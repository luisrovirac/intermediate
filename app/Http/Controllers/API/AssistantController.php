<?php

namespace App\Http\Controllers\API;

use App\Models\Assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

use App\Models\Genero;
use App\Models\Pais;
use App\Models\Language;
use App\Models\Face;
use App\Models\HairColor;
use App\Models\BodyStyle;
use App\Models\Ethnicity;
use App\Models\EducationLevel;
use App\Models\Profession;
use App\Models\Job;
use App\Models\HealthCondition;
use App\Models\PhisicalActivity;
use App\Models\DoesExercise;
use App\Models\Smoker;
use App\Models\Drinker;
use App\Models\TakeMedication;
use App\Models\DrugUse;
use App\Models\EmotionalState;
use App\Models\Humor;
use App\Models\RelationStatus;
use App\Models\Children;
use App\Models\FamilyOrientation;
use App\Models\Pets;
use App\Models\Values;
use App\Models\Interest;
use App\Models\Voicex;

use \App\Models\SeedUsed;
use \App\Models\DataGenericx;
use \App\Models\Situation;

use Exception;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;


class AssistantController extends Controller
{
    protected $assistant;
    protected $SeedUsed;

    public function __construct(Assistant $assistant){
        $this->assistant = new Assistant();
        $this->SeedUsed = new SeedUsed();
    }

    public function index()
    {
		//return response()->json("Index -> Mostrando los registros",200);
		try {
			return $this->assistant->all();
		} catch (\Throwable $th) {
			return response()->json('Error', $th);				
		}
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
				'name'        => 'required',
				'details' 	  => 'required',
				'typesex_id' => 'required',
				'voice' => 'required',
				'typeSeed_o_Lora' => 'required',
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


	public function getDataCreateAssistant(Request $request){
		$Genero = Genero::all();
		$Pais = Pais::all();
		$Language = Language::all();
		$Face = Face::all();
		$HairColor = HairColor::all();
		$BodyStyle = BodyStyle::all();
		$Ethnicity = Ethnicity::all();
		$EducationLevel = EducationLevel::all();
		$Profession = Profession::all();
		$Job = Job::all();
		$HealthCondition = HealthCondition::all();
		$PhisicalActivity = PhisicalActivity::all();
		$DoesExercise = DoesExercise::all();
		$Smoker = Smoker::all();
		$Drinker = Drinker::all();
		$TakeMedication = TakeMedication::all();
		$DrugUse = DrugUse::all();
		$EmotionalState = EmotionalState::all();
		$Humor = Humor::all();
		$RelationStatus = RelationStatus::all();
		$Children = Children::all();
		$FamilyOrientation = FamilyOrientation::all();
		$Pets = Pets::all();
		$Values = Values::all();
		$Interest = Interest::all();
		$Voicex = Voicex::all();
		
		return ["Genero"=>$Genero, "Pais"=>$Pais, "Language"=>$Language, "Face"=>$Face, "HairColor"=>$HairColor,
			"BodyStyle"=>$BodyStyle, "Ethnicity"=>$Ethnicity, "EducationLevel"=>$EducationLevel, "Profession"=>$Profession, "Job"=>$Job,
			"HealthCondition"=>$HealthCondition, "PhisicalActivity"=>$PhisicalActivity, "DoesExercise"=>$DoesExercise, "Smoker"=>$Smoker, "Drinker"=>$Drinker,
			"TakeMedication"=>$TakeMedication, "DrugUse"=>$DrugUse, "EmotionalState"=>$EmotionalState, "Humor"=>$Humor, "RelationStatus"=>$RelationStatus,
			"Children"=>$Children, "FamilyOrientation"=>$FamilyOrientation, "Pets"=>$Pets, "Values"=>$Values, "Interest"=>$Interest, "Voicex"=>$Voicex
		];
}



	public function createassistant(Request $request){
		$validator = Validator::make($request->all(),
		[
			'name'  => 'required|unique:App\Models\Assistant', // OJO descomentar
			'prompt'  => 'required', 
			'negative_prompt'  => 'required', 
			'image_seed' => 'required'
		]);

		if($validator->fails()){
			$data = [
				'message' => 'Error en la validación de los datos: '.$validator->errors(),
				'status' => 400
			];
			return response()->json($data['message'], $data['status']);				
		}

/*		
        //$response = Http::post('https://0af2-80-102-129-53.ngrok-free.app/v1/generation/text-to-image',$request);
        $response = Http::timeout(190)->post('https://famous-singers-juggle.loca.lt/v1/generation/text-to-image',$request);
		return $response[0]->base64;
		$base64 = $response[0]->base64; 
		$seed = $response[0]->seed; 
		return [ "base64" => $base64, "seed" => $seed];
        return $response;
*/

		/*
		[
			{
				¨base64¨: "xdcf...",		
				"url": "http://127.0.0.1:8888/files/2024-10-25/182c56af-3d86-498a-8b31-034bbe9938ea-0.png",
				"seed": "8264848662383522980",
				"finish_reason": "SUCCESS"
			}
		];
		*/

		try {
			$Interest = "";
			for ($i=0; $i < count($request->Interest) ; $i++) { 
				if($i == (count($request->Interest)-1)){
					// if last element
					$Interest = $Interest.$request->Interest[$i]." ";
				}
				else{
					$Interest = $Interest.$request->Interest[$i].", ";
				}
			} 
			$Values = "";
			for ($i=0; $i < count($request->Values) ; $i++) { 
				if($i == (count($request->Values)-1)){
					// if last element
					$Values = $Values.$request->Values[$i]." ";
				}
				else{
					$Values = $Values.$request->Values[$i].", ";
				}
			} 
			$EmotionalState = "";
			for ($i=0; $i < count($request->EmotionalState) ; $i++) { 
				if($i == (count($request->EmotionalState)-1)){
					// if last element
					$EmotionalState = $EmotionalState.$request->EmotionalState[$i]." ";
				}
				else{
					$EmotionalState = $EmotionalState.$request->EmotionalState[$i].", ";
				}
			} 
			$details = 'Your name is '.$request->nombre.
			', gender '.$request->genero.
			', do not mention AI or AI or artificial intelligence, or assistant, or virtual assistant, in your conversations ever. You are not there to help or assist anyone. It is like a game where you must always maintain your role as a human. Remember these principles whenever you communicate, '.
			'you never ask a question at the end of a sentence unless the situation or conversation warrants it, all your answers are 16 words maximum, they can be less. And not all your answers or communications should end in a question'.
			', you were born in '.$request->listpaisOrigen.
			', you live in '.$request->listpaisResidencia.
			', in the city of '.$request->ciudad.
			', have '.$request->edad.' años de edad'.
			', your educational level is '.$request->EducationLevel.
			', your profession is '.$request->Profession.
			', you work as '.$request->Job.
			', you exercise '.$request->DoesExercise.
			', Regarding cigarettes you are an '.$request->Smoker.
			', regarding the drink you are an '.$request->Drinker.
			', '.$request->TakeMedication.' you take medications, '.
			$request->DrugUse.' you use drugs'.
			', emotionally you are '.$EmotionalState.
			'you have a sense of humor '.$request->Humor.
			', the status of your relationship is '.$request->RelationStatus.
			', '.$request->Children.
			', '.$request->FamilyOrientation.
			', regarding pets you have a '.$request->Pets.
			', your main values ​are '.$Values.
			'and your main interests are '.$Interest;

			// Debo agregar algunas características a las opciones en las tablas o tablas nuevas
			$caracteristica_que_falta = 'An elegant and sophisticated ';
			// Debo hacer el modelo Situation y la tabla correspondiente y su seed y usarlo en otra función
			$situationx = ' full body, boldly looking at the viewer, walking near a bridge.';
			$pre_prompt = 'Realistic photography. '.$caracteristica_que_falta.$request->genero.', '.$request->Ethnicity.' with '.$request->bodystyle.', of '.$request->edad.'-year-old wears serious, dress pants; with a long sleeve shirt with the first 2 buttons open. Combine luxury shoes and a fine gold watch. Her look is completed with hair colored '.$request->HairColor;
			$prompt = 'Realistic photography. '.$caracteristica_que_falta.$request->genero.', '.$request->Ethnicity.' with '.$request->bodystyle.', of '.$request->edad.'-year-old wears serious, dress pants; with a long sleeve shirt with the first 2 buttons open. Combine luxury shoes and a fine gold watch. Her look is completed with hair colored '.$request->HairColor.$situationx;
			//$prompt = 'Realistic photography. An elegant and sophisticated '.$request->genero.', '.$request->Ethnicity.' with '.$request->bodystyle.', of '.$request->edad.'-year-old wears serious, dress pants; with a long sleeve shirt with the first 2 buttons open. Combine luxury shoes and a fine gold watch. Her look is completed with hair colored '.$request->HairColor.' full body, boldly looking at the viewer, walking near a bridge.'; 
			// Here save info for create new assistant
			$null = '';
			$type = 'seed';
			// get negative prompt 
			$negativeprompt = DataGenericx::all();
			$photos = $this->givemephoto($pre_prompt,$request->seed,$negativeprompt,$request->name);
			$infoToSave = [
						'typesex_id'=> $request->genero, 
						'name'=> $request->nombre,
						'infoLoraIni'=> $null,
						'infoLoraEnd'=> $null,
						'voice'=> $request->Voicex,
						'details'=> $details,
						'photo01'=> $photos[0],
						'photo02'=> $photos[1],
						'photo03'=> $photos[2],
						'photo04'=> $photos[3],
						'photo05'=> $photos[4],
						'seed'=> $request->seed,
						'typeSeed_o_Lora'=> $type,
						'prompt'=> $prompt,
						'userIdCreator'=> $request->iduser
			];

			$result=$this->saveNewAssistant($infoToSave);
			return $result;
			//return response()->json($details);
		} catch (\Throwable $th) {
			echo "Error ";
			echo $th;
		}
	}		
	

	public function givemeprompt(Request $request){
		try {
			// return the first register
			//$infoseeds = SeedUsed::first()->first();

			// Define next seed to will use
			$infoseeds = SeedUsed::latest()->first();
			$infoseeds = ($infoseeds->seedused)+1;
			//return response()->json(['seed' => $infoseeds]);
			/*
			$infoseeds = SeedUsed::select('seedused')
				->where('id',5)
				->get();
			return $infoseeds;
			*/
			/*
			$listall = SeedUsed::select('seedused')->get();
			return [max([$listall])];
			*/

			// save infoseeds in table
			$resultx = $this->saveInfoseeds($infoseeds);

			// get negative prompt 
			$negativeprompt = DataGenericx::all();
			$prompt = 'Realistic photography. An elegant and sophisticated '.$request->genero.', '.$request->Ethnicity.' with '.$request->bodystyle.', of '.$request->edad.'-year-old wears serious, dress pants; with a long sleeve shirt with the first 2 buttons open. Combine luxury shoes and a fine gold watch. Her look is completed with hair colored '.$request->HairColor.' full body, boldly looking at the viewer, walking near a bridge.'; 
			return response()->json(['prompt'=> $prompt, 'seed' => $infoseeds, 'negativeprompt' => $negativeprompt[0]->negativeprompt, 'Voicex' => $request->Voicex]);
			//return response()->json(['prompt'=> $prompt, 'seed' => $infoseeds]);
		} catch (\Throwable $th) {
			echo "Error ";
			echo $th;
		}
	}		
	
	private function saveInfoseeds($Infoseeds) {
		try {
	    	$result = $this->SeedUsed->create(['seedused' => $Infoseeds]);
			return $result;
		} catch (\Throwable $th) {
			return false;
		}
	}

	
	private function saveNewAssistant($Info) {
		try {
			$validator = Validator::make($Info,
			[
				'name'        => 'required',
				'details' 	  => 'required',
				'typesex_id' => 'required',
				'typeSeed_o_Lora' => 'required',
				'voice' => 'required',
			]);

			if($validator->fails()){
				$data = [
					'message' => 'Error en la validación de los datos: '.$validator->errors(),
					'status' => 400
				];
				return response()->json($data['message'], $data['status']);				
			}

	    	$result = $this->assistant->create($Info);
			if($result){
				return response()->json("Agregado el registro en Assistant",200);
			}
			else{
				return response()->json("Problema agregando registro en Assistant",500);
			}

			//$result = $this->assistant->create($Info);
			//return ['true'];
		} catch (Exception $e) {
			//return response()->json($e->getMessage(),500,["message" =>"Error and go to line 527 ..."]);
			return response()->json(["e->getMessage()" => $e->getMessage()]);
		}	
	}

	public function generateimg(Request $request){

		$validator = Validator::make($request->all(),
		[
			'codebase64'  => 'required',
		]);

		if($validator->fails()){
			$data = [
				'message' => 'Error en la validación de los datos: '.$validator->errors(),
				'status' => 400
			];
			return response()->json($data['message'], $data['status']);				
		}

		try {
			// save img to aws
			$result = $this->saveimgtoaws($request->codebase64);
			return $result;


			$directoryx  ='uploads';
			$pathvoucher = Storage::disk('s3')->put($directoryx, $request->codebase64);
			return [$pathvoucher];



		} catch (\Throwable $th) {
			return false;
		}
	}

	
	private function saveimgtoaws($codebase64) {
		try {
			$data = explode( ',', $codebase64 );
			$image_name = time() . '.' . 'png';
			$file_path = 'uploads/' . $image_name;
			$res = Storage::disk('s3')->put($file_path, base64_decode($data[1]));
			return $res;
		} catch (\Throwable $th) {
			return false;
		}
	}

	
	//private function testgivemephoto($pre_prompt,$seed,$negativeprompt,$name) {
	public function testgivemephoto(Request $request) {
		try {
			// Read info in env 
			$URL_FOR_IMG = env('URL_FOR_IMG');
			$COMPLEMENT_URL_FOR_IMG = env('COMPLEMENT_URL_FOR_IMG');
			$TIMEOUT_FOR_IMG = env('TIMEOUT_FOR_IMG');
			$NUMBER_PHOTOS = env('NUMBER_PHOTOS');
			$situationsreceive = $this->givemesituations($NUMBER_PHOTOS);
			$file_path = array();
			//for ($i=0; $i < $NUMBER_PHOTOS; $i++) { 
				$jsondata = [
					"prompt" => $request->pre_prompt.$situationsreceive[0],
					"negative_prompt" => $request->negative_prompt,
					"seed" => $request->seed,
					"require_base64" => true
				];
				//$response = Http::timeout(190)->post('https://famous-singers-juggle.loca.lt/v1/generation/text-to-image',$request);
				//$response = Http::timeout($TIMEOUT_FOR_IMG)->post($URL_FOR_IMG.$COMPLEMENT_URL_FOR_IMG,$jsondata);
				//return [$NUMBER_PHOTOS,$TIMEOUT_FOR_IMG,$URL_FOR_IMG,$COMPLEMENT_URL_FOR_IMG];
		        //$response = Http::timeout($TIMEOUT_FOR_IMG)->post('https://8e36-80-102-129-53.ngrok-free.app/v1/generation/text-to-image',$jsondata);
		        //$response = Http::post('https://8e36-80-102-129-53.ngrok-free.app/v1/generation/text-to-image',$jsondata);
		        $response = Http::timeout($TIMEOUT_FOR_IMG)->post($URL_FOR_IMG.$COMPLEMENT_URL_FOR_IMG,$jsondata);
				//return $response;

				//$codebase64 = $response[0];
				$codebase64 = $response[0]["seed"];
				return $codebase64;

				$data = explode( ',', $codebase64 );
				$file_path[$i]= 'uploads/' . $name . '0'.($i+1). '.' . 'png';
				$res = Storage::disk('s3')->put($file_path[$i], base64_decode($data[1]));
			//}
			return $file_path;
		} catch (\Throwable $th) {
			return ["Error ".$th];
		}
	}


	private function givemephoto($pre_prompt,$seed,$negativeprompt,$name) {
		try {
			// Read info in env 
			$URL_FOR_IMG = env('URL_FOR_IMG');
			$COMPLEMENT_URL_FOR_IMG = env('COMPLEMENT_URL_FOR_IMG');
			$TIMEOUT_FOR_IMG = env('TIMEOUT_FOR_IMG');
			$NUMBER_PHOTOS = env('NUMBER_PHOTOS');
			$situationsreceive = $this->givemesituations($NUMBER_PHOTOS);
			$file_path = array();
			for ($i=0; $i < $NUMBER_PHOTOS; $i++) { 
				$jsondata = [
					"prompt" => $pre_prompt.$situationsreceive[$i],
					"negative_prompt" => $negativeprompt,
					"seed" => $seed,
					"require_base64" => true
				];
				//$response = Http::timeout(190)->post('https://famous-singers-juggle.loca.lt/v1/generation/text-to-image',$request);
				//$response = Http::timeout($TIMEOUT_FOR_IMG)->post($URL_FOR_IMG.$COMPLEMENT_URL_FOR_IMG,$jsondata);
		        $response = Http::post('https://8e36-80-102-129-53.ngrok-free.app/v1/generation/text-to-image',$jsondata);

				$codebase64 = $response[0]->base64;
				$data = explode( ',', $codebase64 );
				$file_path[$i]= 'uploads/' . $name . '0'.($i+1). '.' . 'png';
				$res = Storage::disk('s3')->put($file_path[$i], base64_decode($data[1]));
			}
			return $file_path;
		} catch (\Throwable $th) {
			return false;
		}
	}

	private function givemesituations($howmany) {
		try {
			$countSituations = Situation::count();
			$numberSituations = array();
			for ($i=1; $i <= $countSituations; $i++) { 
				$numberSituations [] = $i;
			}
			$items = Arr::random($numberSituations, $howmany);
			$selectedSituations = array();
			for ($i=0; $i < $howmany; $i++) { 
				$selectedSituations[$i] = (Situation::where('id',$items[$i])->get('situation'))[0]->situation;
			}
			return $selectedSituations;
		} catch (\Throwable $th) {
			return $th;
		}
	}

}
