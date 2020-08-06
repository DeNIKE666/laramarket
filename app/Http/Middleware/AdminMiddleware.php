<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Auth;

class AdminMiddleware
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
        if(Auth::check() && Auth::user()->role == User::ROLE_ADMIN)
        {
            return $next($request);
        } else {
            return redirect('/');
        }

        abort(404);
    }
}
