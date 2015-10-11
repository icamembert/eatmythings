<?php namespace App\Http\Controllers;

use App;
use App\Dish;
use App\User;
use Illuminate\Support\Facades\Auth;
use Torann\GeoIP\GeoIPFacade;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use DB;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $dishes = Dish::orderBy('rating', 'desc')->limit(12)->get();

        $todayDishes = Dish::orderBy('rating', 'desc')->limit(3)->get();

        $chefsOfTheWeek = User::orderBy('rating', 'desc')->limit(3)->get();

        $location = GeoIPFacade::getLocation();

		return view('home', compact('dishesForMap', 'dishes', 'todayDishes', 'chefsOfTheWeek', 'location'));
	}

	public function search()
	{
        
		$googlePlaceId = Input::get('googlePlaceId');

		if (Input::has('radius'))
        {
        	$radius = Input::get('radius');
        } else
        {
        	$radius = 50;
        }

		$json = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $googlePlaceId . '&key=AIzaSyDZ3X3vQ9tFf9I4F-3ON6rGC9JCGDzufLE'));
		$lat = $json->result->geometry->location->lat;
		$lng = $json->result->geometry->location->lng;

		$R = 6371;

		$maxLat = $lat + rad2deg($radius / $R);
		$minLat = $lat - rad2deg($radius / $R);

		$maxLng = $lng + rad2deg($radius / $R / cos(deg2rad($lat)));
		$minLng = $lng - rad2deg($radius / $R / cos(deg2rad($lat)));

		$sortBy = 'bestRating';

		if (Input::has('sortBy'))
        {
        	$sortBy = Input::get('sortBy');
        }

        if ($sortBy == 'bestRating') {
        	$dishes = Dish::select('d1.*', 'users.address_google_place_id', 'users.city_google_place_id')
        	->from('dishes as d1')
        	->leftJoin('dishes as d2', function($join) {
        		$join->on('d1.user_id', '=', 'd2.user_id');
        		$join->on('d1.rating', '<', 'd2.rating');
        	})
        	->leftJoin('users', 'd1.user_id', '=', 'users.id')->whereNull('d2.rating')
        	->orderBy('d1.rating', 'desc')
        	->whereBetween('users.lat', [$minLat, $maxLat])
        	->whereBetween('users.lng', [$minLng, $maxLng]);
        } else {
        	$dishes = Dish::select('d1.*', 'users.address_google_place_id', 'users.city_google_place_id')
        	->from('dishes as d1')
        	->leftJoin('dishes as d2', function($join) {
        		$join->on('d1.user_id', '=', 'd2.user_id');
        		$join->on('d1.price', '>', 'd2.price');
        	})
        	->leftJoin('users', 'd1.user_id', '=', 'users.id')->whereNull('d2.price')
        	->orderBy('d1.price')
        	->whereBetween('users.lat', [$minLat, $maxLat])
        	->whereBetween('users.lng', [$minLng, $maxLng]);
        }
		

        $searchedGooglePlaceId = $googlePlaceId;
        
        $name = '';
        $rating = '';
        $price = '';

        $resultsPerPage = 8;

        if (Input::has('name'))
        {
        	$name = Input::get('name');
        	$dishes = $dishes->where('d1.name', 'LIKE', '%' . $name .'%');
        }

        if (Input::has('rating'))
        {
        	$rating = Input::get('rating');
        	$dishes = $dishes->where('d1.rating', '>=', $rating);
        }

        if (Input::has('price'))
        {
        	$price = Input::get('price');
        	$dishes = $dishes->where('d1.price', '<=', $price);
        }

        if (Input::has('resultsPerPage'))
        {
        	$resultsPerPage = Input::get('resultsPerPage');
        }

        $dishes = $dishes->paginate($resultsPerPage);

		return view('search', compact('dishes', 'searchedGooglePlaceId', 'name', 'rating', 'price', 'radius', 'sortBy', 'resultsPerPage'));
	}

	public function aboutUs() {

		return view('about-us');
	
	}

	public function contactUs() {

		return view('contact-us');

	}

	public function becomeAChef() {

		return view('become-a-chef');

	}

}
