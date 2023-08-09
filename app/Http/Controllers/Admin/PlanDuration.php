<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlanDurationRequest;
use DB;
use Request;

class PlanDuration extends Controller
{
     public function index(){
      $operator=DB::table('oprater_master')->where('status',1)->get();
      $planduration=DB::table('tbl_planduration')
      ->join('tbl_plan', 'tbl_planduration.plan_id','tbl_plan.id')
      ->join('oprater_master', 'tbl_planduration.operator_typeId','oprater_master.id')
      ->join('oprater', 'tbl_planduration.operator_Id','oprater.id')
       ->join('tbl_package', 'tbl_planduration.pack_id','tbl_package.id')
      ->select('tbl_planduration.*','oprater.oprater_name','oprater_master.name','tbl_plan.plan_name','tbl_package.pack_name')
      ->where('tbl_planduration.status',1)->get();
    	return view('admin.plan.planduration_list',compact('operator','planduration'));

    }

    public function add_PlanDuration(PlanDurationRequest $PlanRequest){
    	$data=$PlanRequest->all();
    	 $success='';
         $msg='';

          if($data['talktime'] == null and $data['data'] == null){
          $data['takltime']='N/A';
          $data['data']='N/A';
          
      }elseif($data['data'] == null){
          $data['data']='N/A';
      }elseif($data['talktime'] == null){
          $data['talktime']='N/A';
      }

      

    	$palArr=[
    		'operator_typeId'=>$data['operator_type'],
    		'operator_Id'=>$data['operator_name'],
    		'pack_id'=>$data['pack_name'],
    		'plan_id'=>$data['plan_name'],
    		'amount'=>$data['amount'],
    		'validity'=>$data['validity'],
        'talktime'=>$data['talktime'],
    		'data'=>$data['data'],
        'description'=>$data['description'],

    	];

    	$planId=DB::table('tbl_planduration')->insertOrIgnore($palArr);
                
       if($planId){
            $success = true;
            $msg = "Plan Duration Add Successfully.";

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

    public function get_plan(){
    	$id = Request::input('id');
        $action = Request::input('action');
        if ($action == "plan")
        {
            $results = DB::table('tbl_plan')->where('pack_name', '=', $id)->where('status',1)->get();
            $option = "<option value=''>Select Plan Name</option>";
            foreach ($results as $row)
            {

                $option .= "<option value=" . $row->id . " >" . $row->plan_name . "</option>";

            }
           
            echo $option;
        }
    }

    public function edit_PlanDuration($id){

    	$id=Request::input('id');
    
    	 if ($id)
        {
    	$plan_data=DB::table('tbl_planduration')
      
      ->join('oprater_master', 'tbl_planduration.operator_typeId','oprater_master.id')
      ->join('oprater', 'tbl_planduration.operator_Id','oprater.id')
    ->join('tbl_plan', 'tbl_planduration.plan_id','tbl_plan.id')
     ->join('tbl_package', 'tbl_planduration.pack_id','tbl_package.id')
      ->select('tbl_planduration.*','oprater.oprater_name','oprater_master.name','tbl_plan.plan_name','tbl_package.pack_name')
      ->where('tbl_planduration.id',$id)
      ->first();

      echo json_encode($plan_data);
    }
  }


  public function update_PlanDuration(PlanDurationRequest $PlanRequest){
         $data=$PlanRequest->all();

    	  $success='';
         $msg='';
         if($data['planduration_id'] != null){
        $plan_update=DB::table('tbl_planduration')->where('id',$data['planduration_id'])->update([
    		'operator_typeId'=>$data['operator_type'],
    		'operator_Id'=>$data['operator_name'],
    		'pack_id'=>$data['pack_name'],
    		'plan_id'=>$data['plan_name'],
    		'amount'=>$data['amount'],
    		'validity'=>$data['validity'],
         'talktime'=>$data['talktime'],
    		'data'=>$data['data'],
        'description'=>$data['description'],

    	]);
       
            $success = true;
            $msg = "Plan Duration Update Successfully.";

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

  public function delete_PlanDuration($id){

  	    $msg = '';
        $success = '';
         if($id) {

            $datas = DB::table('tbl_planduration')->where('id', $id)->update(['status' => 0]);
            $success = true;
            $msg = "Plan Duration Delete Successfully";
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
