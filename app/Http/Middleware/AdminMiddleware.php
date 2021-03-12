<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = auth($guard)->authenticate();
        if($user->role_id != Role::ADMIN) {
            abort(404);
        }
        return $next($request);
    }
}
