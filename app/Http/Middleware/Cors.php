<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

	 public function handle(Request $request, Closure $next): Response
	 {
		 return $next($request)
			 ->withHeaders([
				 'Access-Control-Allow-Origin' => 'http://localhost:5174/'
			 ]);
	 }

	/*
    public function handle(Request $request, Closure $next): Response
    {
		return $next($request)
		->header("Access-Control-Allow-headers" , "*")
		->header("Access-Control-Allow-Origin", "http://localhost:5174","*")
		->header("Access-Control-Allow-Methods", "GET, POST");
    }
		*/
}
