<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OpraterRequest;
use DB;
use Request;

class OpraterController extends Controller
{
    public function index(){

      $oprater=DB::table('oprater')->where('status',1)->get();
       $oprater_type=DB::table('oprater_master')->where('status',1)->get();
      return view('admin.oprater.view_oprater',compact('oprater','oprater_type'));
    }

      public function addOprater(OpraterRequest $OpraterRequest){
    	$success='';
    	$msg='';
         $data=$OpraterRequest->all();
       
       $opraterArr = [
       	                 'master_id'=>$data['oprator_type'],
                         'oprater_name'=>$data['oprator_name'],
                         'oprater_code' => $data['oprator_code'],
                         'commission_type'=>$data['commission_type'],
                         'commission_rate' => $data['commission_rate'],
                     ];
                    
              $opraterId=DB::table('oprater')->insertOrIgnore($opraterArr);
                
            if($opraterId){
            $success = true;
            $msg = "Oprator Add Successfully.";

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

     public function editOprater($id){

    	if($id){
    		$oprater_edit=DB::table('oprater')->join('oprater_master','oprater.master_id','=','oprater_master.id')
    		->select('oprater.*','oprater_master.name')
    		->where('oprater.id',$id)->where('oprater.status',1)->get();
    		echo json_encode($oprater_edit);
    	}
    }

    public function updateOprater(){
     $success='';
     $msg='';
      $Udate=date('Y-m-d H:i:s');
     $oprater_id=Request::input('oprater_id');
     $data=Request::all();
     
       
         if($oprater_id){
         $update_oprater=DB::table('oprater')->where('id',$oprater_id)->where('status',1)->update([
                       'master_id'=>$data['oprator_type'],
                         'oprater_name'=>$data['oprator_name'],
                         'oprater_code' => $data['oprator_code'],
                         'commission_type'=>$data['commission_type'],
                         'commission_rate' => $data['commission_rate'],
         ]);

            $success = true;
            $msg = "Oprator Update Successfully.";

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

    public function deleteOprater($id){
    	 $msg = '';
        $success = '';
         if($id) {

            $datas = DB::table('oprater')->where('id', $id)->update(['status' => 0]);
            $success = true;
            $msg = "Oprator Delete Successfully";
        }
        else
        {
            $success = false;
            $msg = "Somthing worng Please try again...";

        }  
      
        echo json_encode(array(
            'valid' => $success,
            'message' => $msg,
        ));
    }
}
