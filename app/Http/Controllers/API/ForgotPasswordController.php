<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use phpmailer\PHPMailerAutoload;
use Crypt;
use Mail;
use DB;

class ForgotPasswordController extends Controller
{
    public static function quickRandom($length = 6)
	{
	    $pool = '1234567890';

	    $refer_code= substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
	    return $refer_code;
	}

	public function forgot_password(Request $request){
          $email=$request->input('email');
          $password=$this->quickRandom();
          $password_hash=Hash::make($password);
          $user=DB::table('role_users')
          ->where('email',$email)
          ->orwhere('contact',$email)
          ->first();
        	$name='';
        	$user_email='';
          $contact='';
          $role_id='';
        	if($user == null)
        	{
        	$name='';
        	$user_email='';
          $contact='';
          $role_id='';
        	}else{
        		$name=$user->name;
        		$user_email=$user->email;
            $contact=$user->contact;
            $role_id=$user->role_id;
        	}
        	if(!empty($user_email)){
            if($role_id == 1){
               
          $upd_role=DB::table('role_users')
          ->where('email',$email)
          ->orwhere('contact',$email)
          ->where('status',1)->update([
              'password'=> $password_hash,
              'encrypt_password' =>Crypt::encryptString($password) , 
          ]);

       }else{
          $upd_customer=DB::table('customer')
            ->where('email',$email)
            ->orwhere('contact',$email)
            ->where('status',1)
            ->update([
              'password'=> $password_hash,
               'encrypt_password' =>Crypt::encryptString($password) , 
          ]);
          $upd_role=DB::table('role_users')
          ->where('email',$email)
          ->orwhere('contact',$email)
          ->where('status',1)->update([
              'password'=> $password_hash,
              'encrypt_password' =>Crypt::encryptString($password) , 
          ]);
       }
        	
        $to = $user_email;
        $subject = 'Forgot Password';
        $message = "Your password has been reset successfully,Your new password is".' '.$password;
        $headers = 'From:  info@truewallet.co.in'. "\r\n" .
        'Reply-To: .$user_email.'. "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        
        $mail=mail($to, $subject, $message, $headers);
        
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

        $data['msg']='Your password has been reset successfully';
        $data['status']=true;
        $data['password']=$password;
        $myJSON = json_encode($data);
        echo $myJSON;
      }else{
        $data['msg']='something wrong ! please try again';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
      } 
        	

	}
}
