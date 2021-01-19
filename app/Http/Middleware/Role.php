<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    public function handle($request, Closure $next,  $role = 'administrador')
    {
        //Evaluar si el usuario esta identificado
        if(!auth()->check()) abort(403);
        $roles = explode('-', $role);
        
        if($request->user()->has_any_role($roles)){
            return $next($request);
        }else{
            abort(403);
        }
        //Evaluar si el usuario tiene un determinado rol
        
    }
}
