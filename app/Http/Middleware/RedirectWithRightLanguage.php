<?php namespace App\Http\Middleware;

use Closure;
use Torann\GeoIP\GeoIPFacade;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RedirectWithRightLanguage {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$location = GeoIPFacade::getLocation();

        if ($location['isoCode'] == 'FR')
        {

        	if ( ! ($request->is('fr') || $request->is('fr/*') || $request->is('kr') || $request->is('kr/*') || $request->is('en') || $request->is('en/*')) )
        		return redirect(LaravelLocalization::getLocalizedURL('fr'));

        } else if ($location['isoCode'] == 'KR')
        {

        	if ( ! ($request->is('kr') || $request->is('kr/*') || $request->is('fr') || $request->is('fr/*') || $request->is('en') || $request->is('en/*')) )
        		return redirect(LaravelLocalization::getLocalizedURL('kr'));

        } else
        {

        	if ( ! ($request->is('en') || $request->is('en/*') || $request->is('fr') || $request->is('fr/*') || $request->is('kr') || $request->is('kr/*')) )
        		return redirect(LaravelLocalization::getLocalizedURL('en'));

        }

		return $next($request);
	}

}
