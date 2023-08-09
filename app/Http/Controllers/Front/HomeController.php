<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{

	public function index(Request $request){
       
        $preoprator=DB::table('oprater')
        ->where('master_id',4)
        ->where('status',1)
        ->get();   
        $oprator=DB::table('oprater')
        ->where('master_id',1)
        ->where('status',1)
        ->get(); 
       $oprator_dth=DB::table('oprater')
       ->where('master_id',2)
       ->where('status',1)
       ->get();
        $oprator_electric=DB::table('oprater')
        ->where('master_id',6)
        ->where('status',1)
        ->get();

        $payment_gateway=DB::table('tbl_payment_gateway')->where('status','on')->first();
        if($payment_gateway == null){
            $payment_mode='';
            $status='';
        }else{
            $payment_mode=$payment_gateway->payment_gateway;
            $status=$payment_gateway->status; 
        }
	 return view('front.index',compact('oprator','preoprator','oprator_dth','oprator_electric','payment_mode','status'));
	}
    public function postpaid_getdata(Request $request){

        $action=$request->input('action');
        if($action == 'Postpaid'){
             $oprator=DB::table('oprater')->where('master_id',4)->where('status',1)->get();
             dd($oprator);
        }else{
            $oprator=DB::table('oprater')->where('master_id',1)->where('status',1)->get(); 
        }

            echo $oprator;
    }

    public function about(){
    	return view('front.about');
    }

    public function services(){
    	return view('front.service');
    }

    public function process(){
    	return view('front.process');
    }

     public function contact(){
    	return view('front.contact');
    }

    public function login(){
    	return view('front.login');
    }

     public function register(){
    	return view('front.register');
    }

    public function download(){

        return view('front.download');
    }

    public function success(){

        return view('front.success');
    }

    public function failed(){

        return view('front.recharge_failed');
    }

     public function app_success(){

        return view('front.app_success');
    }

    public function app_recharge_failed(){

        return view('front.app_recharge_failed');
    }

    public function app_payment_view($checksum, $str){

        return view('front.apppayment_view',compact('checksum','str'));
    }

    public function forgot_password(){

        return view('front.forgot');
    }

    public function privacy(){

        return view('front.privacy');
    }
      public function termscondition(){

        return view('front.termscondition');
    }
      public function refundrancellation(){

        return view('front.refundrancellation');
    }
}
