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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        $user = auth()->user();
    
        // التأكد من أن المستخدم موجود ولديه دور مرتبط به
        if (!$user || !$user->role || $user->role->name !== $role) {
            
            return redirect('/home')->with('error', 'Unauthorized access.');
        }
    
        return $next($request);
    }
    
    
}
