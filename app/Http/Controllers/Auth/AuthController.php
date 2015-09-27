<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	protected $redirectPath = '/';
	
	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	/**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        $this->auth->logout();

        Cart::destroy();

        return Redirect::route('home');
    }

    /**
     * Log the user in the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $tvar = $request->input('email');
        $pw = $request->input('password');

        if ($this->auth->attempt(['email' => $tvar, 'password' => $pw]))
        {
            return Redirect::route('home');
        }
        
    }

    /**
     * Register the user in the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->registrar->validator($request->all());
        $tvar = $request->input('email');
        $pw = $request->input('password');
        
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $this->registrar->create($request->all());

        if ($this->auth->attempt(['email' => $tvar, 'password' => $pw]))
        {
        	return Redirect::route('home'); //$this->loginPath()
        }
    }

}
