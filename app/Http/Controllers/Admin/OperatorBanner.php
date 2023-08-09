<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OperatorBannerRequest;
use DB;
use Request;

class OperatorBanner extends Controller
{
    public function index(){

    	 $oprater_banner=DB::table('tbl_operator_banner')
         ->leftJoin('operator_banner_image', 'operator_banner_image.id', '=', (DB::RAW('(
SELECT id from  operator_banner_image where operator_banner_id=tbl_operator_banner.id ORDER BY operator_banner_image.id DESC LIMIT 1)')))
       ->join('oprater_master', 'tbl_operator_banner.operatorTypeId','oprater_master.id')
      ->join('oprater', 'tbl_operator_banner.operatorId','oprater.id')
      ->select('tbl_operator_banner.*','oprater.oprater_name','oprater_master.name','operator_banner_image.banner_image')
      ->where('tbl_operator_banner.status',1)->get();
       $operator_type=DB::table('oprater_master')->where('status',1)->get();
      return view('admin.oprater.operator_banner',compact('oprater_banner','operator_type'));
    }

    public function Banner_Add(OperatorBannerRequest $Request){
       $success='';
       $msg='';
       $data=$Request->all();
       
              $orignalImageArr = [
                   'operatorTypeId'=>$data['operator_type'],
    		            'operatorId'=>$data['operator_name'],
                     ];
                    
     $bannerId=DB::table('tbl_operator_banner')->insertGetId($orignalImageArr);
                
            if($bannerId){

                           
            foreach ($Request->file('banner') as $orignalFile)
              {
                          
                $orignalName = time() . '.' . $orignalFile->getClientOriginalName();
               $orignalFile->move(public_path('images/operatorbanner') , $orignalName);
                $image_path= 'images/operatorbanner/'.$orignalName;
                        $orignalImageArr = [
                            'operator_banner_id' => $bannerId,
                             'banner_image' => $image_path,
                         ];
                        
                   DB::table('operator_banner_image')->insertOrIgnore($orignalImageArr);
                    }

            $success = true;
            $msg = "Operator Banner Add Successfully.";

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

    public function delete_Banner($id){

  	    $msg = '';
        $success = '';
         if($id) {
         	 $dataimage = DB::table('operator_banner_image')->where('operator_banner_id', $id)->first();
            $image_path = public_path().'/'.$dataimage->banner_image;
                 unlink($image_path);

          $banner_data = DB::table('operator_banner_image')->where('operator_banner_id', $id)->delete();    
              
            $datas = DB::table('tbl_operator_banner')->where('id', $id)->delete();
            $success = true;
            $msg = "Operator Banner Delete Successfully";
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

    public function get_Banner($id){

      $banner_image=DB::table('operator_banner_image')->where('operator_banner_id',$id)->get();

      echo json_encode($banner_image);
    }

}
