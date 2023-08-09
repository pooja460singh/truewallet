<?php

namespace App\Http\Controllers\API;

use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Validator;
use DB;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){ 
        if(auth()->attempt(array('email' => $request->email,'password' => $request->password)) || auth()->attempt(array('contact' => $request->email,'password' => $request->password))) {
        if (auth()->user()->role_id == 1 and auth()->user()->email == $request->email or auth()->user()->contact == $request->email) { 

            $user = Auth::user(); 
            $result1=DB::table('role_users')
            ->where('role_users.email',request('email'))
             ->orwhere('role_users.contact',request('email'))
            ->get();
             foreach($result1 as $key=>&$banners)
                {
                 $images=$banners->image;
                 $banners->image=stripslashes('public').stripslashes('/').$images;
                }
            //$success['token'] =  $user->createToken('MyApp')-> accessToken; 

            return response()->json(['status'=> true ,'message' => 'Logged In Successfully', 'data' => $result1]); 
        }elseif (auth()->user()->role_id == 2 and auth()->user()->email == $request->email or auth()->user()->contact == $request->email) { 

            $user = Auth::user(); 
            $result1=DB::table('role_users')
            ->join('customer','role_users.email','=','customer.email')
            ->select('role_users.*','customer.contact','customer.user_code')
            ->where('role_users.email',request('email'))
             ->orwhere('role_users.contact',request('email'))
            ->get();
             foreach($result1 as $key=>&$banners)
                {
                $images=$banners->image;
                 $banners->image=stripslashes('public').stripslashes('/').$images;
                }
            //$success['token'] =  $user->createToken('MyApp')-> accessToken; 

            return response()->json(['status'=> true ,'message' => 'Logged In Successfully', 'data' => $result1]); 
        }else{
     
            return response()->json(['status'=> false,'message'=>'Not Verified'], 401);

        } 
       } else{ 
            return response()->json(['status'=> false,'message'=>'Your Email Id Or Password Invaild'], 401); 
        } 
    }
}
