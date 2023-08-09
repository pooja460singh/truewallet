<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlanRequest;
use DB;
use Request;

class PlanController extends Controller
{
    public function index(){
      $operator=DB::table('oprater_master')->where('status',1)->get();
      $plan=DB::table('tbl_plan')
      ->join('oprater_master', 'tbl_plan.operator_type','oprater_master.id')
      ->join('oprater', 'tbl_plan.operator_ID','oprater.id')
       ->join('tbl_package', 'tbl_plan.pack_name','tbl_package.id')
      ->select('tbl_plan.*','oprater.oprater_name','oprater_master.name','tbl_package.pack_name')
      ->where('tbl_plan.status',1)->get();
    	return view('admin.plan.plan_list',compact('operator','plan'));

    }

    public function add_Plan(PlanRequest $PlanRequest){
    	$data=$PlanRequest->all();
    	 $success='';
         $msg='';

       $plandata=DB::table('tbl_plan')->where('plan_name',$data['plan_name'])->where('status',1)->first(['plan_name']);
        if($plandata == null){
            $plan_name='';
        }else{
            $plan_name=$plandata->plan_name;
        }
       

    	$palArr=[
    		'operator_type'=>$data['operator_type'],
    		'operator_ID'=>$data['operator_name'],
    		'pack_name'=>$data['pack_name'],
        'plan_name'=>$data['plan_name'],
    		

    	];

    	$planId=DB::table('tbl_plan')->insertOrIgnore($palArr);
                
       if($planId){
            $success = true;
            $msg = "Plan Add Successfully.";

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

    public function get_operator(){
    	$id = Request::input('id');
        $action = Request::input('action');
        if ($action == "operator")
        {
            $results = DB::table('oprater')->where('master_id', '=', $id)->where('status',1)->get();
            $option = "<option value=''>Select Operator</option>";
            foreach ($results as $row)
            {

                $option .= "<option value=" . $row->id . " >" . $row->oprater_name . "</option>";

            }
           
            echo $option;
        }
    }

     public function get_operatortype(){
      $id = Request::input('id');
        $action = Request::input('action');
        if ($action == "operator")
        {
            $results = DB::table('tbl_package')->where('operator_id', '=', $id)->where('status',1)->get();
            $option = "<option value=''>Select Pack Name</option>";
            foreach ($results as $row)
            {

                $option .= "<option value=" . $row->id . " >" . $row->pack_name . "</option>";

            }
           
            echo $option;
        }
    }

    public function edit_Plan($id){

    	$id=Request::input('id');
    
    	 if ($id)
        {
    	$plan_data=DB::table('tbl_plan')
    	->join('oprater_master', 'tbl_plan.operator_type','=','oprater_master.id')
      ->join('oprater', 'tbl_plan.operator_ID','=','oprater.id')
      ->select('tbl_plan.*','oprater.oprater_name','oprater_master.name')
      ->where('tbl_plan.id',$id)
      ->first();

      echo json_encode($plan_data);
    }
  }


  public function update_Plan(PlanRequest $PlanRequest){
         $data=$PlanRequest->all();
    	 $success='';
         $msg='';
         $plan_update=DB::table('tbl_plan')->where('id',$data['plan_id'])->update([
    		'operator_type'=>$data['operator_type'],
    		'operator_ID'=>$data['operator_name'],
        'pack_name'=>$data['pack_name'],
    		'plan_name'=>$data['plan_name'],
    		

    	]);

         if($plan_update){
            $success = true;
            $msg = "Plan Update Successfully.";

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

  public function delete_Plan($id){

  	    $msg = '';
        $success = '';
         if($id) {

            $datas = DB::table('tbl_plan')->where('id', $id)->update(['status' => 0]);
            $success = true;
            $msg = "Plan Delete Successfully";
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
