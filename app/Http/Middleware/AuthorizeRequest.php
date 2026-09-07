<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Permission;
use Illuminate\Http\Request;

/**
 * AuthorizeRequest created by @abianbiya on 21 Jun 2022
 */
class AuthorizeRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $route = $request->route() ? $request->route()->getName() : null;

        if (!$route || str_starts_with($route, 'customer.') || str_starts_with($route, 'auth.google.') || str_starts_with($route, 'frontend.')) {
            return $next($request);
        }

        $user = $request->user();

        $can = Permission::can($route);

        if(!$can){
            abort(403);
        }

        return $next($request);
    }
}
