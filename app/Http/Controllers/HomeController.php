<?php namespace App\Http\Controllers;

use App;
use App\Dish;
use App\User;
use Illuminate\Support\Facades\Auth;
use Torann\GeoIP\GeoIPFacade;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use DB;

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
        $dishesForMap = Dish::join('users', 'dishes.user_id', '=', 'users.id')->orderBy('dishes.rating', 'desc')->groupBy('dishes.user_id')->select('dishes.*', 'users.address_google_place_id')->get();

        $dishes = Dish::orderBy('rating', 'desc')->limit(12)->get();

        $todayDishes = Dish::orderBy('rating', 'desc')->limit(3)->get();

        $chefsOfTheWeek = User::orderBy('rating', 'desc')->limit(3)->get();

        $location = GeoIPFacade::getLocation();

		return view('home', compact('dishesForMap', 'dishes', 'todayDishes', 'chefsOfTheWeek', 'location'));
	}

	public function search($googlePlaceId)
	{
        
		$json = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $googlePlaceId . '&key=AIzaSyDZ3X3vQ9tFf9I4F-3ON6rGC9JCGDzufLE'));
		$lat = $json->result->geometry->location->lat;
		$lng = $json->result->geometry->location->lng;

		$rad = 50;
		$R = 6371;

		$maxLat = $lat + rad2deg($rad / $R);
		$minLat = $lat - rad2deg($rad / $R);

		$maxLng = $lng + rad2deg($rad / $R / cos(deg2rad($lat)));
		$minLng = $lng - rad2deg($rad / $R / cos(deg2rad($lat)));

		$dishesForMap = Dish::select('d1.*', 'users.address_google_place_id', 'users.city_google_place_id')->from('dishes as d1')
        	->leftJoin('dishes as d2', function($join) {
        		$join->on('d1.user_id', '=', 'd2.user_id');
        		$join->on('d1.rating', '<', 'd2.rating');
        	})->leftJoin('users', 'd1.user_id', '=', 'users.id')->whereNull('d2.rating')
        	->whereBetween('users.lat', [$minLat, $maxLat])
        	->whereBetween('users.lng', [$minLng, $maxLng])
        	->paginate(8);

        /*$dishesForMap = Dish::select('d1.*', 'users.address_google_place_id', 'users.city_google_place_id')->from('dishes as d1')
        	->leftJoin('dishes as d2', function($join) {
        		$join->on('d1.user_id', '=', 'd2.user_id');
        		$join->on('d1.rating', '<', 'd2.rating');
        	})->leftJoin('users', 'd1.user_id', '=', 'users.id')->whereNull('d2.rating')
        	/*->where('users.city_google_place_id', '=', $googlePlaceId)*//*->paginate(20);*/

        $searchedGooglePlaceId = $googlePlaceId;

		return view('search', compact('dishesForMap', 'searchedGooglePlaceId'));
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
