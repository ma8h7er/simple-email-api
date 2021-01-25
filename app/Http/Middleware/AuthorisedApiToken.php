<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorisedApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->query('api_token') === null) {
            return response()->json('Forbidden', Response::HTTP_UNAUTHORIZED);
        }

        if($this->isValidToken($request->query('api_token')) === false) {
            return response()->json('Forbidden', Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }

    /**
     * Check if the api token is valid, it can be implemented to check the user token in Database
     * @param string $token
     * @return bool
     */
    private function isValidToken(string $token)
    {
        return $token === '1234567890'; // 1234567890 fake token
    }
}
