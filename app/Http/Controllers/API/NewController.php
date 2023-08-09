<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class NewController extends Controller
{
     public function news_history(Request $request){

    
    	$newslist=DB::table('tbl_news')->where('status',1)->get();
        $status='';
        if($newslist == null){

            $status=$newslist[0]['status'];
        }else{
            foreach ($newslist as $key => $list) {
            	 $images=$list->news_image;
                 $list->news_image=stripslashes('public').stripslashes('/').$images;
               $status=$list->status;
            }
            $status;
        }

    	if($status != 0){
        $data['msg']='All Record Get Successfuly';
        $data['status']=true;
        $data['response']=$newslist;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }else{
        $data['msg']='Record Not Found.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }
    }

    public function recieved_credit(Request $request){

    	$recieved=$request->input('recieved');
    	$email=$request->input('email');
    	 $contact=$request->input('contact');
        $fromDate=$request->input('fromDate');
         $toDate=$request->input('toDate');
    	if($recieved == 'recieved')
    	{
    	    if(!empty($email) && !empty($contact) && !empty($fromDate) && !empty($toDate)){
    	          $recpaymentlist=DB::table('tbl_payment_history')->where('email',$email)->where('contact',$contact)->where('created_at','>=', $fromDate)->where('created_at','<=', $toDate)->where('credit_amount','>',0)->where('status',1)->get();
    	    
    	         
    	     }else  if(!empty($email) && !empty($contact)){
    	         $recpaymentlist=DB::table('tbl_payment_history')->where('email',$email)->where('contact',$contact)->where('credit_amount','>',0)->where('status',1)->get();
    	          
    	     }else if(!empty($email) && !empty($fromDate) && !empty($toDate)){
    	          $recpaymentlist=DB::table('tbl_payment_history')->where('email',$email)->whereBetween('created_at', [$fromDate, $toDate])->where('credit_amount','>',0)->where('status',1)->get();
    	     }else{
    	          $recpaymentlist=DB::table('tbl_payment_history')->where('email',$email)->where('credit_amount','>',0)->where('status',1)->get();
    	     }
    		
    	}else{
    	    
    	    if(!empty($email) && !empty($contact) && !empty($fromDate) && !empty($toDate)){
    	         
    	         	$recpaymentlist=DB::table('tbl_payment_history')->where('email',$email)->where('contact',$contact)->where('created_at','>=', $fromDate)->where('created_at','<=', $toDate)->where('debit_amount','>',0)->where('status',1)->get();
    	   
    	         	
    	     }else  if(!empty($email) && !empty($contact)){
    	         	$recpaymentlist=DB::table('tbl_payment_history')->where('email',$email)->where('contact',$contact)->where('debit_amount','>',0)->where('status',1)->get();
    	         	
    	     }else if(!empty($email) && !empty($fromDate) && !empty($toDate)){
    	         
    	          	$recpaymentlist=DB::table('tbl_payment_history')->where('email',$email)->whereBetween('created_at', [$fromDate, $toDate])->where('debit_amount','>',0)->where('status',1)->get();
    	     }else{
    	         	$recpaymentlist=DB::table('tbl_payment_history')->where('email',$email)->where('debit_amount','>',0)->where('status',1)->orderBy('created_at', 'desc')->get();
    	     }
    	
    	}
    	$payment_email='';
        if($recpaymentlist == null){

            $payment_email=$recpaymentlist[0]['email'];
        }else{
            foreach ($recpaymentlist as $key => $list_email) {
               $payment_email=$list_email->email;
            }
            $payment_email;
        }

    	if($payment_email != null){
        $data['msg']='All Record Get Successfuly';
        $data['status']=true;
        $data['response']=$recpaymentlist;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }else{
        $data['msg']='Record Not Found.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }
    }
    
    public function receipt_list(Request $request){

        $id=$request->input('id');

       $receiptList=DB::table('tbl_payment_history')
        ->join('tbl_payment','tbl_payment_history.id','tbl_payment.history_id')
//         ->leftJoin('tbl_payment', 'tbl_payment.id', '=', (DB::RAW('(
// SELECT id from  tbl_payment where email=tbl_payment_history.email ORDER BY tbl_payment.id DESC LIMIT 1)')))
        ->select('tbl_payment_history.*','tbl_payment.OrderId')->where('tbl_payment_history.id',$id)->where('tbl_payment_history.status',1)->get();
         if($receiptList != null){
        $data['msg']='All Record Get Successfuly';
        $data['status']=true;
        $data['response']=$receiptList;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }else{
        $data['msg']='Record Not Found.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }
    }
}
