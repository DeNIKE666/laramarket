<?php

namespace App\Http\Middleware;

use Closure;

class PartnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Gate::allows('is-partner')) {
            return $next($request);
        }

        return redirect()->route('edit-profile');
    }
}
