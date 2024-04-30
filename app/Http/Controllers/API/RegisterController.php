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
				'email' => 'required|email|unique:users',
				'password' => 'required|min:6',
				'c_password' => 'required|same:password' // alt 124 |
			]);
		
			if($validator->fails()) {
				return $this->sendError('Validation Error.', $validator->errors(),400);
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
		return $this->sendError(' Usuario no auntenticado.',[], 403);
	}

	public function thelogin(Request $request): JsonResponse
	{
		try {
			$validator = Validator::make($request->all(), 
			[
				'email' => 'required',
				'password' => 'required',
			]);
		
			if($validator->fails()) {
				return $this->sendError('Validation Error.', $validator->errors(),400);
			}
			
			$user = User::where('email', $request->email)->first();
			if (!$user) {
				return $this->sendError('Datos no válidos.',[], 400);
			}

			if (Hash::check($request->password, $user->password)) {
				$success['token'] = $user->createToken('MyApp')->accessToken;
				$success['name'] = $user->name;
				$success['id'] = $user->id;
				return $this->sendResponse($success, 'User login successfully');
			}
			else{
				return $this->sendError('Datos no válidos.',[], 400);
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
			if(Auth::check()){
				$token   = $request->user()->token();
				$token->revoke();
				$message = 'Logout satisfactorio';
				return $this->sendResponse($message, $data, 200);
			}
			else{
				$motive = ', Usuario no auntenticado';
				return $this->sendError($message.$motive, [], 403);
			}
        }
        catch (\Exception $e) {
            return $this->sendError($message.$e, [], 500);
        }
    }    

	public function listuser(){
		try {
			$result = User::all();
			if($result){
				return response()->json($result,200);
			}
			else{
				return response()->json("No user list",200);
			}
		} catch (\Throwable $th) {
			return response()->json($th,500);
		}
	}

}
