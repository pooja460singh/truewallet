<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PaymentController extends Controller
{
    public function index(){

      $history=DB::table('tbl_payment_history')->where('status',1)->get();
       $c=1;
    	return view('admin.payment.payment_history',compact('history','c'));
    }

    public function recharge_report(){

    	$report=DB::table('tbl_payment')
    	->join('tbl_payment_history','tbl_payment.OrderId','tbl_payment_history.orderID')
    	->join('customer','tbl_payment.email','customer.email')
    	->select('tbl_payment_history.*','customer.customer_name','customer.contact','tbl_payment.amount','tbl_payment.recharge_status')
    	->where('tbl_payment_history.status',1)->get();
       $c=1;
    	return view('admin.recharge_report',compact('report','c'));

    }
}
