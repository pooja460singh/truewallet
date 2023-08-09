<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PaymenHistoryController extends Controller
{
    public function payment_history(Request $request){

    	$email=$request->input('email');
    	$contact=$request->input('contact');
        $fromDate=$request->input('fromDate');
         $toDate=$request->input('toDate');
         
       if(!empty($email) && !empty($contact) && !empty($fromDate) && !empty($toDate)){
           
           $paymentlist=DB::table('tbl_payment_history')->where('email',$email)->where('contact',$contact)->where('status',1)->where('created_at','>=', $fromDate)->where('created_at','<=', $toDate)->get();   
      
       }else if(!empty($email) && !empty($contact)){
        $paymentlist=DB::table('tbl_payment_history')->where('email',$email)->where('contact',$contact)->where('status',1)->get();  
        
           
       }else if(!empty($email) && !empty($fromDate) && !empty($toDate)){
           $paymentlist=DB::table('tbl_payment_history')->where('email',$email)->whereBetween('created_at', [$fromDate, $toDate])->where('status',1)->get();    
       }else{
           $paymentlist=DB::table('tbl_payment_history')->where('email',$email)->where('status',1)->orderBy('created_at', 'desc')->get();   
       }
    	
        $payment_email='';
        if($paymentlist == null){

            $payment_email=$paymentlist[0]['email'];
        }else{
            foreach ($paymentlist as $key => $list_email) {
               $payment_email=$list_email->email;
            }
            $payment_email;
        }

    	if($payment_email != null){
        $data['msg']='All Record Get Successfuly';
        $data['status']=true;
        $data['response']=$paymentlist;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }else{
        $data['msg']='Record Not Found.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }
    }


    public function share_referal(Request $request){

        $referalcode=$request->input('referal_code');
        $url=$request->input('url');
        $email=$request->input('email');

        if($referalcode != null){
        $data['msg']='Please register Here.';
        $data['status']=true;
        $data['response']='http://kohinoorcollections.com/truejourney/user/register?referalcode='.$referalcode;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }else{
        $data['msg']='Referal Code Not Found.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }


    }

     public function wallet_amount(Request $request){
        $email=$request->input('email');
        $walletlist=DB::table('customer')->where('email',$email)->orwhere('contact',$email)->where('status',1)->first(['wallet_amount']);
        $walletamount='';
        if($walletlist == null)
        {
           $walletamount=$walletlist[0]['wallet_amount']; 
        }else{
            $walletamount=$walletlist->wallet_amount; 
        }

        if($walletamount != null){
        $data['msg']='All Record Get Successfuly';
        $data['status']=true;
        $data['response']=$walletlist;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }else{
        $data['msg']='Record Not Found.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }
      }

       public function wallethistory(Request $request){
        $email=$request->input('email');
        $wallethistory=DB::table('tbl_wallettowallet')->where('senderId',$email)->where('status',1)->get();
        $walletemail='';
        if($wallethistory == null)
        {
           $walletemail=$wallethistory[0]['senderId']; 
          
        }else{
            foreach($wallethistory as $wallet_history)
            {
            $walletemail=$wallet_history->senderId; 
            }
           $walletemail; 
            
        }

        if($walletemail != null){
        $data['msg']='All Record Get Successfuly';
        $data['status']=true;
        $data['response']=$wallethistory;
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
