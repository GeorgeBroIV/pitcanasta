<?php

namespace App\Http\Middleware;

/**
 * Code Author
 * George T. Brotherston IV
 * StackOverflow: https://stackoverflow.com/users/13029167/george-brotherston
 * Github: https://github.com/GeorgeBroIV
 *
 * This 'EnsureUserHasRole' middleware is registered in 'App\Http\Kernel.php' in the routeMiddleware property
 * trait is intended to be called from a controller method that stores or deletes files from
 * file storage folder.
 */

use App\Providers\RouteServiceProvider;
use App\Traits\RolesTrait;
use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    use RolesTrait;
    /**
     * Handle an incoming request and apply middleware 'hasRole()' (in RolesTrait)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $role
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // check() tests if the session expired
        if (! $request->user()->hasRole($role) && !$request->user()->check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        return $next($request);
    }
}
