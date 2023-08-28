<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;

class Alreadylogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ((Session::has('loginemail')&&(url('signin')==$request->url()||url('signup')==$request->url()))&&Session::get('isadmin')==1){
            return redirect('home-admin');
        } else if ((Session::has('loginemail')&&(url('signin')==$request->url()||url('signup')==$request->url()))&&Session::get('isadmin')==0){
            return redirect('home');

        }
        return $next($request);
    }
}
