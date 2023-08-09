<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OpratorController extends Controller
{

    public function oprater_master(){

      $masterlist=DB::table('oprater_master')->where('status',1)->get();

        if($masterlist != null){
        $data['msg']='All Record Get Successfuly';
        $data['status']=true;
        $data['response']=$masterlist;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }else{
        $data['msg']='Record Not Found.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }
    }

    public function oprater_list(Request $request){

    	$master_id=$request->input('master_id');

    	$oprater=DB::table('oprater')
    	->join('oprater_master', 'oprater.master_id', '=', 'oprater_master.id')
            ->select('oprater.*','oprater_master.name')
            ->Where('oprater.master_id', $master_id)
             ->Where('oprater.status', 1)
            ->get(); 

             $materID='';
           if($oprater == null){

            $materID=$oprater[0]['master_id'];
           }else{
              foreach($oprater as $key=>&$oprater_master)
                {
                  $materID=$oprater_master->master_id;
                
             } 
             $materID;
           }  

        if($materID != null){
        $data['msg']='All Record Get Successfuly';
        $data['status']=true;
        $data['response']=$oprater;
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
