<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        // dd(Auth::user()->user_type);
// dd('hit handle');
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(
                    // RouteServiceProvider::HOME
                    $this->determineUserHomeRoute(Auth::user()->user_type)
                );
            }
        }

        return $next($request);
    }

    public function determineUserHomeRoute($user_type)
    {
        // Determine the user home route base on the user type
        // $user_type = Auth::user()->getAttributes()['user_type'];
// dd('hit custom function');
        if($user_type == User::TYPE_ADMIN){
            return RouteServiceProvider::HOME_ADMIN;
        }

        if($user_type == User::TYPE_APPLICANT){
            return RouteServiceProvider::HOME_APPLICANT;
        }

        if($user_type == User::TYPE_COMPANY){
            return RouteServiceProvider::HOME_COMPANY;
        }

    }
}
