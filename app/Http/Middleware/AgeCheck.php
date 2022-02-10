<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$age)
    {
        
        if($age<18){
            abort(Response::HTTP_UNAUTHORIZED); //HTTP_UNAUTHORIZED=401
        }
        return $next($request);
    }
}
