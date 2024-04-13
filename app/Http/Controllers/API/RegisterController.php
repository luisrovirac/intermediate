<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
	public function register(Request $request): JsonResponse
	{
        $message = 'Hubo un problema en el proceso del Registro';
		try {
			$validator = Validator::make($request->all(), 
			[
				'name' => 'required',
				'email' => 'required',
				'password' => 'required',
				'c_password' => 'required|same:password' // alt 124 |
			]);
		
			if($validator->fails()) {
				return $this->sendError('Validation Error.', $validator->errors());
			}
		
			$input = $request->all();
			$input['password'] = bcrypt($input['password']);
			$user = User::create($input);
			$success['token'] = $user->createToken('MyApp')->accessToken;
		
			return $this->sendResponse($success, 'User register succesfully');
			} catch (\Throwable $th) {
				return $this->sendError($message, [], 500);
			}
	}

	public function login(Request $request): JsonResponse
	{
		try {
		//if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
			$user = User::where('email', $request->email)->first();
			if (Hash::check($request->password, $user->password)) {
			//if (Hash::check(['email' => $request->email, 'password' => $request->password])){
				$id = Auth::id();
				/** @var \App\Models\MyUserModel $user **/
				//$user = Auth::user();
				$success['token'] = $user->createToken('MyApp')->accessToken;
				$success['name'] = $user->name;
				$success['name'] = $user->id;
	
				return $this->sendResponse($success, 'User login successfully');
				// implementar esto...
				//return response()->json(['user' => $user, 'token' => $success['token']]);
			}
			else{
				//echo 'en el else de error...';
				return false;
				return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
			}
		} catch (\Throwable $th) {
			$data = [];
            $message = 'Hubo un problema en el proceso del Login '.$th;
            return $this->sendError($message, $data, 500);
		}
	}


    public function logout (Request $request) {
        $data        = null;
        $message     = 'Hubo un problema en el proceso del Logout';

        try {
            $token   = $request->user()->token();
            $token->revoke();
            $message = 'Logout satisfactorio';
            return $this->sendResponse($message, $data, 200);
        }
        catch (\Exception $e) {
            return $this->sendError($message, [], 500);
        }
    }    

}
