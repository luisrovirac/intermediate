<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cfg;
use App\Models\GuidanceScale;
use App\Models\Sharpness;
use App\Models\Performance;
use App\Models\Lora;
use App\Models\Style;
use App\Models\AspectRatio;
use App\Models\NegativePrompt;
use App\Models\Seed;
use App\Models\ImageNumber;
use App\Models\SaveExtension;

class AImageController extends Controller
{
    
	public function getDataCreateImage(Request $request){
		$Cfg = Cfg::all();
		$GuidanceScale = GuidanceScale::all();
		$Sharpness = Sharpness::all();
		$Performance = Performance::all();
		$Lora = Lora::all();
		$Style = Style::all();
		$AspectRatio = AspectRatio::all();
		$NegativePrompt = NegativePrompt::all();
		$Seed = Seed::all();
		$ImageNumber = ImageNumber::all();
		$SaveExtension = SaveExtension::all();
		
		return ["Cfg"=>$Cfg, "GuidanceScale"=>$GuidanceScale, "Sharpness"=>$Sharpness, "Performance"=>$Performance, "Lora"=>$Lora,
			"Style"=>$Style, "AspectRatio"=>$AspectRatio, "NegativePrompt"=>$NegativePrompt, "Seed"=>$Seed, "ImageNumber"=>$ImageNumber,
			"SaveExtension"=>$SaveExtension
		];
}



}
