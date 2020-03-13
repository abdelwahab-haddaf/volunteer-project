<?php

namespace App\Http\Middleware;

use Closure;

class isAdmin
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
        if (auth()->user()->isAdmin !== 1){
            return redirect('/home');
        }

        if (auth()->guest()){
            return redirect('/login');
        }

        return $next($request);


    }
}
