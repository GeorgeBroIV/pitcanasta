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
        // Check to see if the user hasn't expired
        if (is_null(Auth()->user())) {
            return redirect(RouteServiceProvider::HOME);
        }
        // check() tests if the session expired
        if (! Auth()->user()->hasRole($role) && !Auth()->user()->check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        return $next($request);
    }
}