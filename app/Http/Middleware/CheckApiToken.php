<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckApiToken
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

        //nostro codice con le varie verifiche
        $auth_token = $request->header('Authorization');
        //Verifico se è presente un token di autorizzazione
        if(empty($auth_token)) {
            return response()->json([
                'success' => false,
                'error' => 'Api Token Missed'
            ]);
        }
        //estraggo il token dall'header
        $api_token = substr($auth_token, 7);
        $user = User::where('api_token', $api_token)->first();
        //arriva ma sbagliato
        if(!$user) {
            return response()->json([
                'success' => false,
                'error' => 'Wrong Api Token'
            ]);
        }
        return $next($request);
    }
}