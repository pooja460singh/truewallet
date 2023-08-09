<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SwitchingController extends Controller
{
    public function get_switch_gateway(){
      
      $payment_gateway=DB::table('tbl_payment_gateway')
      ->where('status','on')
      ->first();

            $status='';
           if($payment_gateway == null){
             $status=$payment_gateway[0]['status'];
           }else{
                $status=$payment_gateway->status;    
           } 

        if($status != null){
        $data['msg']='All Record Get Successfuly';
        $data['status']=true;
        $data['response']=$payment_gateway;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }else{
        $data['msg']='Record Not Found.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }

    } 

    public function payment_gateway_status(Request $Request) {
        
        $Id =$Request->input('Id');
        $affected = DB::table('tbl_payment_gateway')
        ->where('id', $Id)
        ->first();
        if($affected == null){
          $Status='';  
        }else{
            $Status=$affected->status;
        }
        
           $status = $Status;
        if ($affected != null) {
            if($status == 'on') {

               $role_users= DB::table('tbl_payment_gateway')
               ->where('status', 'off')
               ->update(['status' => 'on']);

              $role_users= DB::table('tbl_payment_gateway')
               ->where('id', $Id)
               ->update(['status' => 'off']);
               $data['msg']='Your payment gateway off successfully';
               
            } elseif($status == 'off') {
               $role_users= DB::table('tbl_payment_gateway')
               ->where('status', 'on')
               ->update(['status' => 'off']);

                $role_users= DB::table('tbl_payment_gateway')
                ->where('id', $Id)
                ->update(['status' => 'on']);
                $data['msg']='Your payment gateway on successfully'; 
               
            }
                $data['status']=true;
		        $myJSON = json_encode($data);
		        echo $myJSON;
           
        } else {
        	$data['msg']='An error has occurred. Please try again later.';
		    $data['status']=true;
		    $myJSON = json_encode($data);
		    echo $myJSON;
        }
    }

}
