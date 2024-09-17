<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client; 
use Aws\S3\Exception\S3Exception;

class BucketImgController extends Controller
{
    // 

	public function uploadImg(Request $request){
		try {
			$request->validate([
				'file' => 'required|mimes:png,jpg|max:4096'
			]);
			$file = $request->file('file');
			$keyname = 'uploads/' . $file->getClientOriginalName();		

            //create s3 client
            $s3 = new S3Client([
                'version' => 'latest',
                'region'  => env('AWS_DEFAULT_REGION'),
                'credentials' => [
                    'key'    => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ]
            ]);

			$result = $s3->putObject([
				'Bucket' => env('AWS_BUCKET'),
				'Key'    => $keyname,
				'Body'   => fopen($file, 'r'),
				'ACL'    => 'public-read'
			]);

			return response()->json($result,200);
		} catch (\Throwable $th) {
			$data = 'Error ... '.$th;
			return response()->json($data,200);
		}

		
/*


        //$path = Storage::disk('s3')->put('images', $request->image);
        //$path = Storage::disk('s3')->url($path);

        //Image::create(['url' => $path]);

		//$data = 'Imagen guardada correctamente';
		//$data = $request->image;
		return response()->json($keyname,200);
*/		
	}
}
