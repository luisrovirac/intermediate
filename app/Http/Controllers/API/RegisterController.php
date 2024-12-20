<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class RegisterController extends Controller
{

    /**
     * @OA\POST(
     *  tags={"User"},
     *  summary="Register - Create a new user",
     *  description="This endpoint creates a new user when register",
     *  path="/api/register",
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/x-www-form-urlencoded",
     *          @OA\Schema(
     *             required={"email","password","name","c_password"},
     *             @OA\Property(property="name", type="string", example="Jose Gabriel"),
     *             @OA\Property(property="email", type="string", example="josegabriel@example.org"),
     *             @OA\Property(property="password", type="string", example="#sdasd$ssdaAA@"),
     *             @OA\Property(property="c_password", type="string", example="#sdasd$ssdaAA@"),
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *    response=200,
     *    description="User created when User register",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="User register succesfully")
     *    )
     *  ),
     *  @OA\Response(
     *    response=400,
     *    description="Validation Error",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="The name has already been taken. (and 2 more errors)"),
     *       @OA\Property(property="errors", type="string", example="..."),
     *    )
     *  )
     * )
     */

	public function register(Request $request)
	{
        //$message = 'Flecha - Hubo un problema en el proceso del Registro';

		try {

			$validateuser = Validator::make(
			$request->all(),
			[
				'name' => 'required',
				'email' => 'required|email|unique:users,email',
				'password' => 'required|min:6',
				'c_password' => 'required|same:password' 
			]
			);

			if ($validateuser->fails()) {
				return response()->json([
				'status' => false,
				'message' => 'validation error',
				'errors' => $validateuser->errors()
				], 401);
			}

			try {
				$input = $request->all();
				$input['password'] = bcrypt($input['password']);
				$user = User::create($input);
				$success['token'] = $user->createToken('MyApp')->accessToken;
			
				return $this->sendResponse($success, 'User register succesfully',200);
			} catch (\Throwable $th) {
				return $this->sendError('error',$th, 400);
			}
		} catch (\Throwable $th) {
			return $this->sendError($th, '2', 422);
		}
	}


	public function login(Request $request): JsonResponse
	{
		return $this->sendError(' Usuario no auntenticado.',[], 403);
	}

    /**
     * @OA\POST(
     *  tags={"Login Authentication"},
     *  summary="Get a autentication user token",
     *  description="Iniciar session con un usuario ya existente en la base de datos",
     *  path="/api/thelogin",
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              required={"email","password"},
     *              @OA\Property(property="email", type="string", example="gabriel_nunes@example.org"),
     *              @OA\Property(property="password", type="string", example="#sdasd$ssdaAA@"),
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *    response=200,
     *    description="User login successfully",
     *    @OA\JsonContent(
     *       @OA\Property(property="json", type="json", example={ 	"success": true, "data": {"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiNzhkNzQwOTA4YjNmNzA3NmFiNjY0YTUwZmYwOTdlNDQ4OThiMzUwMmYyMTJmMTg1Y2JiOWRkMWNhNGIxNDRmYTAwMTk4MjBmNTcxOTYxMTgiLCJpYXQiOjE3MTQ4OTczMzguOTQ0MDQ4LCJuYmYiOjE3MTQ4OTczMzguOTQ0MDUsImV4cCI6MTc0NjQzMzMzOC45MjgzMzgsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.o7k0xue0rBFY6YHcEQ4ffU1K7c105g2vmWlPa4xBm7Jmlk1yQ7U69QMVXGD8w1VdUKdNYDoLqXIrFgIAFChg0WyN4tYQNn1rUlBsud8EafrrMGhVF4gAF8Cw0yq-nSkW9mo3KvryaJei6NbhAb8vnurRUvRVp425ysYUiBTgwIey7yoXPSGzVvl5tFu9xCiJ40o2S5m8saCrSYsfP6qWOcRr1aCiMq2WV9D1wlwHaYjrAf1fbg-W829W1Zp2K_1DJq7MJvxPuAbDhdmZ1odfARAsFpZaSP4xnanyZhbISAYgmDqyRY2ofpIe24m9WOlVfKLTOc3EogBfP2hroXHRAuUOOJNI165SV0vB5chryid1VIyCjgeXNOwWZK2DkRXQ64ZWQaj3g4fArO96nNYKmXTubGgPZfDso7mLMhe3j_KglyBxxPoqiUu2SW_ewnDmxJkLTIgl1M2vF-w0wb0c7a_cTZSj84nwYFw1pB9gkdqL8vJTrUshIxPCWuPPWG5srRt4JdxvJTon-raYjkiAK7IkfIFlN6hYgE86-3waTSKMV5xh0peUM18zDPEuKkYzO6KKe4WYQ9LSX919HIImQuu3NvykyTckBHfvtngSDgMzPhw0oVuIE1aThfMOtuP7_yfV1nS4gykk9owtyBZtWHck2Xy3YiobpHCSUYoTFD0", "name": "Schell",	"id": 1 }, "message": "User login successfully"	})
     *    )
     *  ),
     *  @OA\Response(
     *    response=422,
     *    description="Incorrect credentials",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Datos no válidos."),
     *       @OA\Property(property="errors", type="string", example="..."),
     *    )
     *  )
     * )
     */

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

    /**
     * @OA\Post(
     *   path="/api/logout",
     *   tags={"User"},
     *   security={ {"bearer": {} }},
     *   summary="Cerrar session un usuario",
     *   description="Cerrar session con un usuario ya existente en la base de datos",
     *   operationId="logout",
     *   security={ * {"Passport": {}}, * },
     *   @OA\Response(response=200, description="Logout satisfactorio"),
     *   @OA\Response(response=401, description="Usuario no auntenticado"),
     *   @OA\Response(response=500, description="Hubo un problema en el proceso del Logout")
     * )
     *
     */
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
