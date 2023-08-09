<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PlanController extends Controller
{

  public function plan_list(Request $request){
     $operator_master=$request->input('operator_master');
      $operator=$request->input('operator');
      $pack_id=$request->input('pack_id');
      
       $plan_list=DB::table('tbl_planduration')
      ->join('tbl_plan', 'tbl_planduration.plan_id','tbl_plan.id')
      ->join('oprater_master', 'tbl_planduration.operator_typeId','oprater_master.id')
      ->join('oprater', 'tbl_planduration.operator_Id','oprater.id')
      ->join('tbl_package', 'tbl_planduration.pack_id','tbl_package.id')
      ->select('tbl_planduration.*','oprater.oprater_name','oprater_master.name','tbl_plan.plan_name','tbl_package.pack_name')->where('tbl_planduration.operator_Id',$operator)->where('tbl_planduration.operator_typeId',$operator_master)->where('tbl_planduration.pack_id',$pack_id)
      ->where('tbl_planduration.status',1)->get();
        if($plan_list == null){
          $status='';
      }else{
          foreach($plan_list as $list){
              $status=$list->status;
          }
          $status;
      }

      if($status != null){
        $data['msg']='All Record Get Successfuly';
        $data['status']=true;
        $data['response']=$plan_list;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }else{
        $data['msg']='Record Not Found.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }

   
  }

   
    public function package_list(Request $request){

      $operator_master=$request->input('operator_master');
      $operator=$request->input('operator');
      $status='';

      $package_list=DB::table('tbl_package')->where('operator_type_id',$operator_master)->where('operator_id',$operator)->get();
        if($package_list == null){
          $status='';
      }else{
          foreach($package_list as $list){
              $status=$list->status;
          }
          $status;
      }

      if($status != null){
        $data['msg']='All Record Get Successfuly';
        $data['status']=true;
        $data['response']=$package_list;
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
