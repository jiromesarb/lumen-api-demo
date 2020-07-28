<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class ExampleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return apiReturn([], 'Token is Invalid', 'failed');
                // return response()->json(['status' => 'Token is Invalid']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return apiReturn([], 'Token is Expired', 'failed');
                // return response()->json(['status' => 'Token is Expired']);
            }else{
                return apiReturn([], 'Authorization Token not found', 'failed');
                // return response()->json(['status' => 'Authorization Token not found']);
            }
        }
        return $next($request);
    }
}
