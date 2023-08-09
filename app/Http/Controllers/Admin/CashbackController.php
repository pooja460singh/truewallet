<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CashbackRequest;
use DB;
use Request;

class CashbackController extends Controller
{
    public function index(){
    	$Cashback_data=DB::table('tbl_cashback')->where('status',1)->get();
    	return view('admin.cashback.view_cashback',compact('Cashback_data'));
    }

    public function addCashback(CashbackRequest $request){
    	  $success='';
          $msg='';

    	$cashback=$request->input('cashback');
    	$CashbackArr=[
        'cashback'=>$cashback,
    	];
    	$CashbackId=DB::table('tbl_cashback')->insertOrIgnore($CashbackArr);
                
       if($CashbackId){
            $success = true;
            $msg = "Cashback Add Successfully.";

        }
        else
        {
            $success = false;
            $msg = "An error has occurred. Please try again later";

        }
         echo json_encode(array(
            'success' => $success,
            'message' => $msg,
        )); 
    }

     public function editCashback($id){

    	if($id){
    		$cashback_edit=DB::table('tbl_cashback')->where('id',$id)->where('status',1)->get();
    		echo json_encode($cashback_edit);
    	}
    }


     public function updateCashback(CashbackRequest $CashbackRequest){
     $success='';
     $msg='';
      $Udate=date('Y-m-d H:i:s');
     $cashback_id=$CashbackRequest->input('cashback_id');
     $cashback=$CashbackRequest->input('cashback');
         if($cashback_id){
         $update_banner=DB::table('tbl_cashback')->where('id',$cashback_id)->where('status',1)->update([
          'cashback'=>$cashback,
           'updated_at' => $Udate,
         ]);

            $success = true;
            $msg = "Cashback Update Successfully.";

        }
        else
        {
            $success = false;
            $msg = "An error has occurred. Please try again later";

        }
         echo json_encode(array(
            'success' => $success,
            'message' => $msg,
        )); 

    }
}
