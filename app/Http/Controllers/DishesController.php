<?php namespace App\Http\Controllers;

use App\Dish;
use App\Http\Requests\DishRequest;
use App\Order;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Gloudemans\Shoppingcart\Facades\Cart;
use Request;

class DishesController extends Controller {

    public function __construct()
    {
       $this->middleware('auth', ['only' => ['create', 'edit', 'update', 'destroy']]);
       $this->middleware('dish.creator', ['only' => ['edit', 'update', 'destroy']]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$dishes = Dish::all();

        return view('dishes.index', compact('dishes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $tags = Tag::lists('name', 'id');

		return view('dishes.create', compact('tags'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
     * @param  DishRequest $request
	 * @return Response
	 */
	public function store(DishRequest $request)
	{
        $dish = Auth::user()->dishes()->create($request->all());

        $picture = Image::make($request->file('picture'));

        $destinationPath = 'userdata/' . Auth::user()->id . '/dishes/' . $dish->id;
        
        if ( ! File::exists($destinationPath))
        {
        	File::makeDirectory($destinationPath, 0777, true);
        }

        $croppedPicture = $picture->crop((int)$request->input('cropw'), (int)$request->input('croph'), (int)$request->input('cropx'), (int)$request->input('cropy'));
        $croppedPicture->save($destinationPath . '/picture.jpg');

        $croppedPictureMedium = $croppedPicture->resize(300, 300);
        $croppedPictureMedium->save($destinationPath . '/picture_md.jpg');

        $croppedPictureSmall = $croppedPictureMedium->resize(100, 100);
        $croppedPictureSmall->save($destinationPath . '/picture_sm.jpg');

        $dish->tags()->attach($request->input('tags_list'));

        flash()->success('Your dish has been created!');

        return redirect('/my-account');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Dish  $dish
	 * @return Response
	 */
	public function show(Dish $dish)
	{
       $isBeingOrdered = Input::get('isBeingOrdered');

        if (Auth::check() && ! Auth::user()->dishes()->find($dish->id))
            session(['dishId' => $dish->id]);
        
        if (Input::get('order'))
        {
            $order = Order::findOrFail(Input::get('order'));
            return view('dishes.show', compact('dish', 'isBeingOrdered', 'order'));
        } else {
            return view('dishes.show', compact('dish', 'isBeingOrdered'));
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Dish  $dish
	 * @return Response
	 */
	public function edit(Dish $dish)
	{
        $tags = Tag::lists('name', 'id');

        return view('dishes.edit', compact('dish', 'tags'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Dish  $dish
     * @param  DishRequest $request
	 * @return Response
	 */
	public function update(Dish $dish, DishRequest $request)
	{
        $dish->update($request->all());

        $picture = Image::make($request->file('picture'));

        $destinationPath = 'userdata/' . Auth::user()->id . '/dishes/' . $dish->id;
        
        if ( ! File::exists($destinationPath))
        {
        	File::makeDirectory($destinationPath, 0777, true);
        }

        $croppedPicture = $picture->crop((int)$request->input('cropw'), (int)$request->input('croph'), (int)$request->input('cropx'), (int)$request->input('cropy'));
        $croppedPicture->save($destinationPath . '/picture.jpg');

        $croppedPictureMedium = $croppedPicture->resize(300, 300);
        $croppedPictureMedium->save($destinationPath . '/picture_md.jpg');

        $croppedPictureSmall = $croppedPictureMedium->resize(100, 100);
        $croppedPictureSmall->save($destinationPath . '/picture_sm.jpg');

        $dish->tags()->sync(is_null($request->input('tags_list')) ? [] : $request->input('tags_list'));

        flash()->success('Your dish has been updated!');

        return redirect('/my-account');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * Add dish to cart.
	 *
	 * @return Response
	 */
	public function addToCart(Dish $dish)
	{
		$quantity = Request::input('quantity');

		if (Cart::count() && $dish->user_id != Cart::content()->first()->options->chefId)
		{
			return redirect()->back()->with('flash_message', 'You must order dishes from one chef at once!');	
		}
		else {
			Cart::add($dish->id, $dish->name, $quantity, $dish->price, ['chefId' => $dish->user_id, 'dish' => $dish]);
			return redirect()->back()->with('flash_message', 'Your cart has been updated!');
		}
		
	}

	/**
	 * View cart.
	 *
	 * @return Response
	 */
	public function viewCart()
	{
		return view('dishes.view-cart');
	}

}
