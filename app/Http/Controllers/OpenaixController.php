<?php

namespace App\Http\Controllers;

use App\Models\Openaix;
use Illuminate\Http\Request;

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

	public function getopenai() {
		return response()->json('Works', 200, []);
	}
}
