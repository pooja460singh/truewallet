<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
 use Illuminate\Http\Request;
use Auth;
use Redirect;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'home';


    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);
       

         if(auth()->attempt(array('email' => $request->email,'password' => $request->password)) || auth()->attempt(array('contact' => $request->email,'password' => $request->password))) {
             if (auth()->user()->role_id == 1 and auth()->user()->email == $request->email or auth()->user()->contact == $request->email) {

            return redirect()->route('home')->with('success', 'You are now logged in.');
             }else{
               return redirect()->route('/')->with('warning','Please enter valid login credentials.');
            }
        }else{
             return Redirect::back()->with('warning','Please enter valid login credentials.');
        }
    
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
         
    }
      public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('/');
    } 
}
