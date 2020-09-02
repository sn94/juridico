<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuth
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
         if ($request->session()->has('nick')) {
         

           return $next($request);//dejar pasar
         }else{
            if( $request->path() == "signin"){
                return $next($request);//dejar pasar
            }else return redirect('signin'); 
         }
        
    }
}
