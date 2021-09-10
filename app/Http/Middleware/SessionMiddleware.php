<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $session = session('session_usuario_id');
        if ($session) {
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}
