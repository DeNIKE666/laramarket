<?php

namespace App\Http\Middleware;

use Closure;

class SellerMiddleware
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
        if (\Gate::allows('is-seller')) {
            return $next($request);
        }

        return redirect()->route('buyer.profile.edit');
    }
}
