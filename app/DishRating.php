<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DishRating extends Model {

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function dish()
    {
        return $this->belongsTo('App\Dish');
    }

}
