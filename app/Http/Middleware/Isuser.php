<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;

class Isuser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::get('isadmin')==0 && (url('home-admin')==$request->url()||url('edit-photo')==$request->url()||url('add-product')==$request->url()||url('edit-product/{id}')==$request->url())){
            return redirect('home');
        }
        return $next($request);
    }
}
