<?php namespace App\Http\Controllers;

use App\Order;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Request;
use DB;

class OrdersController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('order.related', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('orders.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
     * @param  OrderRequest $request
	 * @return Response
	 */
	public function store(OrderRequest $request)
	{
        $order = Auth::user()->orders()->create($request->all());

        foreach (Cart::content() as $item)
        {
        	$order->dishes()->attach($item->id, array('quantity' => $item->qty));
        }

        Cart::destroy();

        $totalPrice = 0;

        foreach ($order->dishes as $orderedDish)
        {
        	$totalPrice = $totalPrice + $orderedDish->quantity * $orderedDish->price;
        }

        $order->price = $totalPrice;
        $order->save();

        flash()->success('Your order has been placed!');

        return redirect()->intended('/my-account')->with('flash_message', 'Your order has been placed!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Order  $order
	 * @return Response
	 */
	public function show(Order $order)
	{
		return view('orders.show', compact('order'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Order  $order
	 * @return Response
	 */
	public function edit(Order $order)
	{
		return view('orders.edit', compact('order'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Order  $order
     * @param  OrderRequest $request
	 * @return Response
	 */
	public function update(Order $order, OrderRequest $request)
	{
        $order->update($request->all());

        flash()->success('Your order has been updated!');

        return redirect()->intended('/my-account')->with('flash_message', 'Your order has been updated!');
	}

    public function accept(Order $order)
    {
        $order->status_id = 1;

        $order->update();

        flash()->success('You have accepted ' . $order->user->name . '\'s order!');

        return redirect()->intended('my-account')->with('flash_message', 'You have accepted ' . $order->user->name . '\'s order!');
    }

    public function reject(Order $order)
    {
        $order->status_id = 2;

        $order->update();

        flash()->success('You have accepted ' . $order->user->name . '\'s order!');

        return redirect()->intended('my-account')->with('flash_message', 'You have rejected ' . $order->user->name . '\'s order!');
    }

    public function cancel(Order $order)
    {
        $order->status_id = 3;

        $order->save();

        flash()->success('Your order has been canceled!');

        return redirect()->intended('my-account')->with('flash_message', 'Your order has been canceled!');
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
