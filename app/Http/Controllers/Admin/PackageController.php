<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageRequest;
use DB;
use Request;
class PackageController extends Controller
{
   
     public function index(){
      $operator=DB::table('oprater_master')->where('status',1)->get();
      $package=DB::table('tbl_package')->join('oprater_master', 'tbl_package.operator_type_id','oprater_master.id')
      ->join('oprater', 'tbl_package.operator_id','oprater.id')
      ->select('tbl_package.*','oprater.oprater_name','oprater_master.name')
      ->where('tbl_package.status',1)->get();
    	return view('admin.plan.package_list',compact('operator','package'));

    }
        public function add_Package(PackageRequest $PackageRequest){
    	$data=$PackageRequest->all();
    	 $success='';
         $msg='';

       $packagedata=DB::table('tbl_package')->where('pack_name',$data['pack_name'])->where('status',1)->first(['pack_name']);
        if($packagedata == null){
            $pack_name='';
        }else{
            $pack_name=$packagedata->pack_name;
        }
       

    	$palArr=[
    		'operator_type_id'=>$data['operator_type'],
    		'operator_id'=>$data['operator_name'],
    		'pack_name'=>$data['pack_name'],
    		

    	];

    	$packageId=DB::table('tbl_package')->insertOrIgnore($palArr);
                
       if($packageId){
            $success = true;
            $msg = "Package Add Successfully.";

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
        public function edit_Package($id){

    	$id=Request::input('id');
    
    	 if ($id)
        {
    	$package_data=DB::table('tbl_package')
    	->join('oprater_master', 'tbl_package.operator_type_id','=','oprater_master.id')
      ->join('oprater', 'tbl_package.operator_id','=','oprater.id')
      ->select('tbl_package.*','oprater.oprater_name','oprater_master.name')
      ->where('tbl_package.id',$id)
      ->first();

      echo json_encode($package_data);
    }
  }


  public function update_Package(PackageRequest $PackageRequest){
         $data=$PackageRequest->all();
    	 $success='';
         $msg='';
         $package_update=DB::table('tbl_package')->where('id',$data['pack_id'])->update([
    		'operator_type_id'=>$data['operator_type'],
    		'operator_id'=>$data['operator_name'],
    		'pack_name'=>$data['pack_name'],
    		

    	]);

         if($package_update){
            $success = true;
            $msg = "Package Update Successfully.";

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

  public function delete_Package($id){

  	    $msg = '';
        $success = '';
         if($id) {

            $datas = DB::table('tbl_package')->where('id', $id)->update(['status' => 0]);
            $success = true;
            $msg = "Package Delete Successfully";
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
