<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['price', 'currency', 'type_id', 'comment', 'served_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function dishes()
    {
        return $this->belongsToMany('App\Dish')->select('dishes.*', 'dish_order.quantity as quantity');
    }

    public function review()
    {
        return $this->hasOne('App\Review');
    }

    public function reviewed()
    {
        return ( ! count($this->review));
    }

}
