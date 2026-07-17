<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next,string ...$role): Response
    {
        
        if( ! in_array($request->user()->role, $role)){
            abort(403, 'Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.');
        }
        return $next($request);
    }
}
