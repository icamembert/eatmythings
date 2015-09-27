<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Dish extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dishes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['price', 'currency', 'name', 'description', 'rating'];

    /*public function setPictureAttribute($picture)
    {
        $this->attributes['picture'] = $picture;
        $this->attributes['thumbnail'] = 'th_'.$picture;
    }*/

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function getTagsListAttribute()
    {
        return $this->tags->lists('id');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function wasOrderedByUser()
    {
        return Auth::check() ? (Auth::user()->orders()->rightJoin('dish_order', 'orders.id', '=', 'dish_order.order_id')->where('dish_order.dish_id', $this->id)->where('orders.status_id', 1)->get()->isEmpty() ? false : true) : false;
    }

    public function isMyDish()
    {
        return Auth::check() ? (Auth::user()->id == $this->user_id ? true : false) : false;
    }

    public function dishRatings()
    {
        return $this->hasMany('App\DishRating');
    }

}
