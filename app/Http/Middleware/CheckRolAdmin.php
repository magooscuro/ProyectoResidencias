<?php

namespace App\Http\Middleware;

use Closure;

class CheckRolAdmin
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
        if (auth()->user()->rol->key == 'admin') {    //checa si el usuario esta asginado como admin y si lo 
            //nos regresa un reques si no nos regresa a la raiz 
            return $next($request);
        }
       return redirect('/');
    }
}
