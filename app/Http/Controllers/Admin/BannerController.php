<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use DB;
use Request;

class BannerController extends Controller
{
    public function index(){
      $banner=DB::table('tbl_banner')->where('status',1)->get();
    	return view('admin.banner.view_banner',compact('banner'));
    }

    public function addBanner(BannerRequest $BannerRequest){
       $success='';
       $msg='';
       $banner_image=$BannerRequest->file('banner_image');
       $orignalName = time() . '.' . $banner_image->getClientOriginalName();
                    $banner_image->move(public_path('images/banner') , $orignalName);
                      $image_path= 'images/banner/'.$orignalName;
                    $orignalImageArr = [
                         'banner_image' => $image_path,
                     ];
                    
              $bannerId=DB::table('tbl_banner')->insertOrIgnore($orignalImageArr);
                
            if($bannerId){
            $success = true;
            $msg = "Banner Add Successfully.";

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

    public function editBanner($id){

    	if($id){
    		$banner_edit=DB::table('tbl_banner')->where('id',$id)->where('status',1)->get();
    		echo json_encode($banner_edit);
    	}
    }

    public function updateBanner(BannerRequest $BannerRequest){
     $success='';
     $msg='';
      $Udate=date('Y-m-d H:i:s');
     $banner_id=$BannerRequest->input('banner_id');
     $banner_image=$BannerRequest->file('banner_image');
       $orignalName = time() . '.' . $banner_image->getClientOriginalName();
        $banner_image->move(public_path('images/banner') , $orignalName);
         $image_path= 'images/banner/'.$orignalName;
         if($banner_id){
         $update_banner=DB::table('tbl_banner')->where('id',$banner_id)->where('status',1)->update([
           'banner_image' => $image_path,
           'updated_at' => $Udate,
         ]);

            $success = true;
            $msg = "Banner Update Successfully.";

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

    public function deleteBanner($id){
    	 $msg = '';
        $success = '';
         if($id) {

            $datas = DB::table('tbl_banner')->where('id', $id)->update(['status' => 0]);
            $success = true;
            $msg = "Banner Delete Successfully";
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
