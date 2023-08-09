<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class BannerController extends Controller
{
     public function banner(){

      $bannerlist=DB::table('tbl_banner')->where('status',1)->get();
      $bannerstatus='';
           if($bannerlist == null){

            $bannerstatus=$bannerlist[0]['status'];
           }else{
             foreach($bannerlist as $key=>&$banners)
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
        $data['response']=$bannerlist;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }else{
        $data['msg']='Record Not Found.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON; 
        }
    }



    public function offer_banner(){

    	$offerlist=DB::table('tbl_offer')->where('status',1)->orderBy('created_at', 'desc')->get();
        $status='';
        if($offerlist == null){
          $status=$offerlist[0]['status'];
        }
        else{
          foreach ($offerlist as $key => $offer) {
             $status=$offer->status;
          }
          $status;
        }
        if($status != 0){
        $data['msg']='All Record Get Successfuly';
        $data['status']=true;
        $data['response']=$offerlist;
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
