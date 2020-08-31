<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class ShopMiddleware
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
        /** @var User $user */
        $user = auth()->user();

        if ($user->isSeller() or $user->isAdmin()) {
            return $next($request);
        }

        return redirect('/');
    }
}
