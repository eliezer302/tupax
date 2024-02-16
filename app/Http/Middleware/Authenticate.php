<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    public function handle($request, $next)
    {
        if (!$request->hasHeader('Authorization'))
            return response()->json(['error' => 'Unauthorized'], 401);

        $authorizationHeader = $request->header('Authorization');
        $credentials         = explode(' ', $authorizationHeader);

        if (count($credentials) != 2 || strtolower($credentials[0]) !== 'basic')
            return response()->json(['error' => 'Unauthorized'], 401);

        $decodedCredentials        = base64_decode($credentials[1]);
        list($username, $password) = explode(':', $decodedCredentials);

        if (!Auth::attempt(['email' => $username, 'password' => $password]))
            return response()->json(['error' => 'Unauthorized'], 401);

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
