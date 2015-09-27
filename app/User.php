<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'address1', 'address2', 'city', 'state', 'iso_code', 'time_zone', 'home_phone', 'mobile_phone', 'about', 'rating', 'address_google_place_id', 'city_google_place_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function dishes()
    {
        return $this->hasMany('App\Dish');
    }

    public function isCreatorOfDish($dishId)
    {
        $dish = Dish::find($dishId);

        return ($dish->user_id == Auth::user()->id);
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function clientOrders()
    {

        //return Order::join('dishes', 'dishes.id', '=', 'orders.dish_id')->where('dishes.user_id', '=', $this->id);
        //return $this->hasManyThrough('App\Order', 'App\Dish', 'user_id', 'dishe_id')->select('id');
        return $this->hasMany('App\Dish', 'user_id')->rightJoin('dish_order', 'dishes.id', '=', 'dish_order.dish_id')->rightJoin('orders', 'dish_order.order_id', '=', 'orders.id')->select('orders.*', 'dishes.name as dish_name', 'dishes.price as dish_price');
    }

    public function isRelatedToOrder($orderId)
    {
        $order = Order::find($orderId);

        $dish = Dish::find($order->dish_id);

        return ($order->user_id == Auth::user()->id || $dish->user_id == Auth::user()->id);
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function clientReviews()
    {
        return $this->hasMany('App\Dish', 'user_id')->rightJoin('dish_order', 'dishes.id', '=', 'dish_order.dish_id')->rightJoin('orders', 'dish_order.order_id', '=', 'orders.id')->rightJoin('reviews', 'orders.id', '=', 'reviews.order_id')->select('reviews.*');
    }

    public function isChef()
    {
        return ( ! $this->dishes->isEmpty());
    }

    public function isHungry()
    {
        return ( ! $this->orders->isEmpty());
    }

    public  function isMe()
    {
        return Auth::check() ? (Auth::user()->id == $this->id ? true: false) : false;
    }

    public function dishRatings()
    {
        return $this->hasMany('App\DishRating');
    }

}
