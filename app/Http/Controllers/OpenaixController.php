<?php

namespace App\Http\Controllers;

use App\Models\Openaix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenaixController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Openaix $openaix)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Openaix $openaix)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Openaix $openaix)
    {
        //
    }

    public function getTest() {
        $dummy = "Data Info Fake";
        return response()->json([
                'status' => 'success',
                'message' => 'Test Api',
                'data' => $dummy
        ], 200);
    }

	public function getopenai() {
		$search = "who is google";

		$data = Http::withHeaders([
			'Content-Type' => 'application/json',
			'Authorization' => 'bearer ', env('OPEN_API_KEY') 
		])->post(
			'https://api.openai.com/v1/chat/completions',[
				'model' => 'gpt-3.5-turbo',
				'messages' => [
					[
						'role' => 'user', 'content' => $search
					]
				],
				'temperature' => 0.5,
				'max_tokens' => 200,
				'top_p' => 1.0,

			])->json();
			return response()->json($data,200,[]);
	}

	public function postopenai() {
		$search = "who is google";
		try {
			$data = Http::withHeaders([
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer ', env('OPEN_API_KEY') 
			])->post(
				'https://api.openai.com/v1/chat/completions',[
					'model' => 'gpt-3.5-turbo',
					'messages' => [
						[
							'role' => 'user', 'content' => $search
						]
					],
					//'temperature' => 0.5,
					//'max_tokens' => 200,
					//'top_p' => 1.0,
				])->json();
				return response()->json($data,200,[]);
			} catch (\Throwable $th) {
				return response()->json($th,200,[]);
		}
	}



}
