<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OperatorBanner extends Controller
{
    public function OperatorBanner_list(Request $Request){

    	$operator_master=$Request->input('operator_master');
    	$operator=$Request->input('operator');

    	$operator_banner=DB::table('tbl_operator_banner')
    	->join('operator_banner_image','tbl_operator_banner.id','operator_banner_image.operator_banner_id')
       ->join('oprater_master', 'tbl_operator_banner.operatorTypeId','oprater_master.id')
      ->join('oprater', 'tbl_operator_banner.operatorId','oprater.id')
      ->select('tbl_operator_banner.*','oprater.oprater_name','oprater_master.name','operator_banner_image.banner_image')
       ->where('tbl_operator_banner.operatorTypeId',$operator_master)
       ->where('tbl_operator_banner.operatorId',$operator)
      ->where('tbl_operator_banner.status',1)->get();
      

       $bannerstatus='';
           if($operator_banner == null){

            $bannerstatus=$operator_banner[0]['status'];
           }else{
             foreach($operator_banner as $key=>&$banners)
                {
                $images=$banners->banner_image;
                 $banners->banner_image=stripslashes('public').stripslashes('/').$images;
                $bannerstatus=$banners->status;
                } 
             $bannerstatus;
           } 

        if($bannerstatus != null){
        $data['msg']='All Record Get Successfuly';
        $data['status']=true;
        $data['response']=$operator_banner;
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
