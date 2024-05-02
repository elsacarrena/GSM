<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Stagiaire
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        if(auth()->user()->is_admin==5){
        return $next($request);
        }
        if(auth()->user()->is_admin==1){
            return redirect()->route('admin.home');
        }
        if(auth()->user()->is_admin==4){
            return redirect()->route('employe.home');
        }
        if(auth()->user()->is_admin==2){
            return redirect()->route('superieur.home');
        }
        if(auth()->user()->is_admin==3){
            return redirect()->route('chefservice.home');
        }


        else{
            return redirect ('home')->with('error', "Vous n\'avez pas le droit  de stagiaire");
        }
    }
}
