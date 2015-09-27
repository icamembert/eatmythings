<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotCreatorOfDish {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if ( ! Auth::user()->isCreatorOfDish($request->route()->getParameter('dishes')->id))
        {
            return redirect('dishes');
        }

		return $next($request);
	}

}
