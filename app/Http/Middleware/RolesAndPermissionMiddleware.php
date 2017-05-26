<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RolesAndPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $action = $request->route()->getAction();
        $permission = $action['permission'];
        if (\Auth::user() && \Auth::user()->hasPermission($permission)) {
            return $next($request);
        }
        return Redirect::to('errors/404');
    }
}
