<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;
use DB;
use Request;

class NewsController extends Controller
{
    public function index(){
       
       $news_list=DB::table('tbl_news')->where('status',1)->get();
    	return view('admin.news.view_news',compact('news_list'));
    }

    public function addNews(NewsRequest $NewsRequest){
    	  $success='';
    	  $msg='';
    	  $banner_image=$NewsRequest->file('news_image');
          $orignalName = time() . '.' . $banner_image->getClientOriginalName();
          $banner_image->move(public_path('images/news') , $orignalName);
          $image_path= 'images/news/'.$orignalName;
       	  $title=$NewsRequest->input('title');
          $description=$NewsRequest->input('news_description');
           $NewsArr = [
           	             'news_image'=>$image_path,
                         'title'=>$title,
                         'description' => $description,
                     ];
                    
              $NewsId=DB::table('tbl_news')->insertOrIgnore($NewsArr);
                
       if($NewsId){
            $success = true;
            $msg = "News Add Successfully.";

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

      public function editNews($id){

    	if($id){
    		$news_edit=DB::table('tbl_news')->where('id',$id)->where('status',1)->get();
    		echo json_encode($news_edit);
    	}
    }

     public function updateNews(NewsRequest $NewsRequest){
     $success='';
     $msg='';
      $Udate=date('Y-m-d H:i:s');
     $news_id=$NewsRequest->input('news_id');
     $description=$NewsRequest->input('news_description');
     $title=$NewsRequest->input('title');
       
         if($news_id){

         	 $orignalFile=$NewsRequest->file('news_image');
            if($orignalFile){
              $orignalName = time() . '.' . $orignalFile->getClientOriginalName();
            $orignalFile->move(public_path('images/news') , $orignalName);
             $image_path= 'images/news/'.$orignalName;
            $update_news = DB::table('tbl_news')->where('id', $news_id)->where('status',1)->update(
            	[
            		    'news_image'=>$image_path,
                         'title'=>$title,
                         'description' => $description,
            		      'updated_at' => $Udate, 
            	]);  
        }else{
         $update_news=DB::table('tbl_news')->where('id',$news_id)->where('status',1)->update([
                         'title'=>$title,
                         'description' => $description,
                         'updated_at' => $Udate,
         ]);
        }

            $success = true;
            $msg = "News Update Successfully.";

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

     public function deleteNews($id){
    	 $msg = '';
         $success = '';
         if($id) {

            $datas = DB::table('tbl_news')->where('id', $id)->delete();
            $success = true;
            $msg = "News Delete Successfully";
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
