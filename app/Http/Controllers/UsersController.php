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
use App\Commands\CropImage;

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
        if (File::exists('userdata/' . $user->id . '/profile_picture_md.jpg'))
        {
        	$profilePicturePath = 'userdata/' . $user->id . '/profile_picture_md.jpg';
        } else {
        	$profilePicturePath = 'img/default-profile-picture_md.jpg';
        }

        return view('users.show', compact('user', 'profilePicturePath'));
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

        if (File::exists('userdata/' . $user->id . '/profile_picture_md.jpg'))
        {
        	$profilePicturePath = 'userdata/' . $user->id . '/profile_picture_md.jpg';
        } else {
        	$profilePicturePath = 'img/default-profile-picture_md.jpg';
        }

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

        return view('users.edit', compact('user', 'clientOrders', 'profilePicturePath'));
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

        if ($request->input('cropped') === 'true')
        {
        	$picture = Image::make($request->file('picture'));

	        $destinationPath = 'userdata/' . Auth::user()->id;
	        
	        if ( ! File::exists($destinationPath))
	        	File::makeDirectory($destinationPath, 0777, true);

	        //$picture->save($destinationPath . '/profile_picture.jpg');

	        $cropObject = [
				'destinationPath' => $destinationPath,
				'cropw' => (int) $request->input('cropw'),
				'croph' => (int) $request->input('croph'),
				'cropx' => (int) $request->input('cropx'),
				'cropy' => (int) $request->input('cropy'),
			];

			$this->dispatch(new CropImage($cropObject));
        }
        
        
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
