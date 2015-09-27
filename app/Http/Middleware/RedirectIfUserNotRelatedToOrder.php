<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfUserNotRelatedToOrder {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if ( ! Auth::user()->isRelatedToOrder($request->route()->getParameter('orders')->id))
        {
            return redirect('/');
        }

		return $next($request);
	}

}
