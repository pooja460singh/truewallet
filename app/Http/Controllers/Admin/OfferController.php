<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OfferRequest;
use DB;
use Request;


class OfferController extends Controller
{
    public function index(){

     $offer=DB::table('tbl_offer')->where('status',1)->get();
    	return view('admin.offerbanner.view_offerbanner',compact('offer'));
    }

    public function addOffer(OfferRequest $OfferRequest){
    	$success='';
    	$msg='';
         $heading=$OfferRequest->input('heading');
         $vailidity=$OfferRequest->input('date');
        $offer_description=$OfferRequest->input('offer_description');
       $offerArr = [
                         'heading'=>$heading,
                         'valid_up_to'=>$vailidity,
                         'offer_description' => $offer_description,
                     ];
                    
              $offerId=DB::table('tbl_offer')->insertOrIgnore($offerArr);
                
            if($offerId){
            $success = true;
            $msg = "Offer Banner Add Successfully.";

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

     public function editOffer($id){

    	if($id){
    		$offer_edit=DB::table('tbl_offer')->where('id',$id)->where('status',1)->get();
    		echo json_encode($offer_edit);
    	}
    }

    public function updateOffer(OfferRequest $OfferRequest){
     $success='';
     $msg='';
      $Udate=date('Y-m-d H:i:s');
     $offer_id=$OfferRequest->input('offer_id');
      $vailidity=$OfferRequest->input('date');
     $offer_description=$OfferRequest->input('offer_description');
     $heading=$OfferRequest->input('heading');
       
         if($offer_id){
         $update_offer=DB::table('tbl_offer')->where('id',$offer_id)->where('status',1)->update([
            'heading'=>$heading,
             'valid_up_to'=>$vailidity,
           'offer_description' => $offer_description,
           'updated_at' => $Udate,
         ]);

            $success = true;
            $msg = "Offer Banner Update Successfully.";

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

    public function deleteOffer($id){
    	 $msg = '';
        $success = '';
         if($id) {

            $datas = DB::table('tbl_offer')->where('id', $id)->update(['status' => 0]);
            $success = true;
            $msg = "Offer Banner Delete Successfully";
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
