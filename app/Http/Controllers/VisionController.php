<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use OpenAI\Laravel\Facades\OpenAI;



use Exception;


/**
 * @OA\Info(title="API for projects", version="0.1")
 */

class VisionController extends Controller
{
	

    public function doyousee(Request $request)
	{
        $apiKey = env('OPEN_API_KEY');
		$imagePath = $request->file;
		$imageContent = file_get_contents($imagePath);
		$base64Image = base64_encode($imageContent);

		$headers = [
			"Content-Type: application/json",
			"Authorization: Bearer {$apiKey}"
		];

		$payload = [
			//'model'      => 'gpt-4-vision-preview', // The spirit you wish to summon.
			'model'      => 'gpt-4-turbo', // The spirit you wish to summon.
			'messages'   => [ // Your message to the spirit.
				[
					'role'    => 'user', // You, the summoner.
					'content' => [
						[
							'type' => 'text', // Your request, in words.
							'text' => "What’s in this image?"
						],
						[
							'type' => 'image_url', // Your offering, in image form.
							//'image_url' => "data:image/jpeg;base64,$base64Image"
							'image_url' => $imagePath
							//'image_url' => $imageContent
							//'image_url' => $base64Image
						],
					],
				]
			],
			'max_tokens' => 900, // How much you're willing to let the spirit ramble.
		];

$result  = OpenAI::chat()->create($payload);		

// Opening the portal to the API.
$ch = curl_init("https://api.openai.com/v1/chat/completions");
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Speak, spirit!
$response = curl_exec($ch);
curl_close($ch);
$responseData = json_decode($response, true);

return response()->json([
	'status' => 'success',
	'message' => 'Test Api',
	'response' => $response,
	'responseData' => $responseData
], 200);

// The spirits speak in riddles. This part tries to make sense of their words.
$responseData = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    // When the spirits are just mumbling nonsense.
    echo json_encode(["error" => "Failed to decode JSON response"]);
    exit;
}

// Sharing the wisdom bestowed upon you by the digital spirits.
echo json_encode($responseData);

/*
        return response()->json([
                'status' => 'success',
                'message' => 'Test Api',
				'request' => $base64Image,
                'data' => $apiKey
        ], 200);
*/		
    }
/*
	public function encodeImage($imagePath): string {
		// This sorcery fetches your image's essence.
		$imageContent = file_get_contents($imagePath);
		// And this incantation transforms it into a base64 charm.
		return base64_encode($imageContent);
	}
*/	


}

