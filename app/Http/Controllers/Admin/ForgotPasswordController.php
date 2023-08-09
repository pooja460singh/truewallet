<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ForgotRequest;
use Illuminate\Support\Facades\Hash;
use Crypt;
use Mail;
use DB;
use Auth;

class ForgotPasswordController extends Controller
{
     public static function quickRandom($length = 6)
	{
	    $pool = '1234567890';

	    $refer_code= substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
	    return $refer_code;
	}

	public function forgot_password(ForgotRequest $ForgotRequest){

		$msg = '';
        $success = '';
        $data=$ForgotRequest->all();
        $email=$data['email'];
        $password=$this->quickRandom();
        $password_hash=Hash::make($password);
        $role_result=DB::table('role_users')->where('email',$email)->orwhere('contact',$email)->first();
        if($role_result == null){
        	$success = false;
            $msg = "Your Email Id Not Exist.";
        }else{
        	$role_id=$role_result->role_id;
        	$role_email=$role_result->email;
        	$contact=$role_result->contact;
        	$name=$role_result->name;
        	if($role_id == 1){
        	
        	$upd_role=DB::table('role_users')->where('email',$email)->where('email',$email)->where('status',1)->update([
             
              'password'=> $password_hash,
              'encrypt_password' =>Crypt::encryptString($password) , 

        	]);
            //$this->sendEmail($user,$password,$role_result);
        
           $api_key='25E47C30E7D7D5';
          $from='FLAWAY';
          $number=$contact;
         $sms_text="Your password has been reset successfully,Your new password is".' '.$password;

          $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "http://unicosms.unicotechnologies.com/app/smsapi/index.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=15880&routeid=56&type=text&contacts=".$number."&senderid=".$from."&msg=".$sms_text);
    $response = curl_exec($ch);
    curl_close($ch);
    
          $token='90f57002e24fb852e014e964845bd637';
          $skey ="SST";
          $number=$contact;
          $sender="ETOPUP";
          $message="Your password has been reset successfully,Your new password is".' '.$password;
                
          $url="https://www.apihub.online/api/Services/transact?token=".urlencode($token)."&skey=".urlencode($skey)."&to=".urlencode($number)."&sender=".urlencode($sender)."&smstext=".urlencode($message)."&smsformat=".urlencode('TEXT')."&format=".urlencode('html');
          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $curl_scraped_page = curl_exec($ch);
          $response = curl_exec($ch);
          curl_close($ch);
          
        	 $success = true;
              $msg = "Your password has been sent to your contact number.";

        	}else{
        		$success = false;
               $msg = "An error has occurred. Please try again later.";
        	}
        	

          }
           echo json_encode(array(
            'success' => $success,
            'message' => $msg,
        ));
        }
	}
