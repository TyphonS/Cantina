<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            if($request->routeIs('cantina.*')){
                return route('cantina.cantinasu');
            }
            if($request->routeIs('responsavel.*')){
                return route('responsavel.cantinasu');
            }
            if($request->routeIs('aluno.*')){
                return route('aluno.cantinasu');
            }


            return route('login');
        }
    }
}
