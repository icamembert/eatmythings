<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Collection;
use DB;

class UsersController extends Controller {

    public function __construct()
    {
        $this->middleware('user.himself', ['only' => ['update', 'destroy']]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $users = User::all();

        return view('users.index', compact('users'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  User  $user
	 * @return Response
	 */
	public function show(User $user)
	{
        return view('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  User  $user
	 * @return Response
	 */
	public function edit()
	{
        $user = Auth::user();

        $clientOrders = Order::select('orders.*')
        						->leftJoin('dish_order', 'orders.id', '=', 'dish_order.order_id')
        						->join('dishes', 'dish_order.dish_id', '=', 'dishes.id')
        						->where('dishes.user_id', '=', $user->id)
        						->groupBy('orders.id')
        						->orderBy('orders.served_at')
        						->get();

        /*foreach ($user->dishes as $dish)
        {
		   	foreach ($dish->orders as $order)
		   	{
		   		$clientOrders->push($order->toArray());
		   	}
        }*/

        /*foreach ($clientOrders as $clientOrder)
        {
        	dd($clientOrder->price);
        }*/
        //dd($clientOrders);

        //$clientOrders = $clientOrders->sortByDesc('updated_at');

        return view('users.edit', compact('user', 'clientOrders'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  User  $user
     * @param  UserRequest $request
	 * @return Response
	 */
	public function update(User $user, UserRequest $request)
	{
        $user->update($request->all());

        $picture = Image::make($request->file('picture'));

        $destinationPath = 'userdata/' . Auth::user()->id;
        
        if ( ! File::exists($destinationPath))
        {
        	File::makeDirectory($destinationPath, 0777, true);
        }

        $croppedPicture = $picture->crop((int)$request->input('cropw'), (int)$request->input('croph'), (int)$request->input('cropx'), (int)$request->input('cropy'));
        $croppedPicture->save($destinationPath . '/profile_picture.jpg');

        $croppedPictureMedium = $croppedPicture->resize(300, 300);
        $croppedPictureMedium->save($destinationPath . '/profile_picture_md.jpg');

        $croppedPictureSmall = $croppedPictureMedium->resize(100, 100);
        $croppedPictureSmall->save($destinationPath . '/profile_picture_sm.jpg');
        
        flash()->success('Your profile has been updated!');

        return redirect()->intended('/my-account')->with('flash_message', 'Your profile has been updated!');
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

}
