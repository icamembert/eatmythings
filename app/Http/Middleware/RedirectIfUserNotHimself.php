<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfUserNotHimself {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ( ! (Auth::user()->id == $request->route()->getParameter('users')->id))
        {
            return redirect('/');
        }

        return $next($request);
	}

}
