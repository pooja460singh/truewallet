<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerRequest;
use App\Http\Requests\Admin\MobileRequest;
use Illuminate\Support\Facades\Hash;
use DB;
use Crypt;
use Request;

class AdminController extends Controller
{
    public function index(){
     
     $customer= DB::table('customer')->where('status',1)->get();
     $customer_count=count($customer);
     $payment=DB::table('tbl_payment')->where('status','success')
     ->where('recharge_status','success')->get();
     $transaction=Count($payment);
      $revenue=DB::table('tbl_payment')->where('status','success')
     ->where('recharge_status','success')->sum('amount');
     $expense=DB::table('tbl_payment_history')->where('status',1)->sum('credit_amount');
     $history=DB::table('tbl_payment_history')->where('status',1)->get();
       $c=1;
      return view('admin.index',compact('customer_count','transaction','revenue','expense','history','c'));
    }

    public function customerlist(){
        
        $customer=DB::table('customer')->where('status',1)->get();
       

      return view('admin.customer.view_customer',compact('customer'));
    }


    public static function quickRandom($length = 4)
{
    $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $refer_code= substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    return $refer_code;
}

    public function customer_register(CustomerRequest $request){

       $success='';
       $msg='';
        $email=$request->input('email');
        $contact=$request->input('contact');
        $password=Hash::make($request->input('password'));
        $encrypt_password=Crypt::encryptString($request->input('password'));
        $referal_code=$request->input('referal_code');

          if($referal_code != null)
          {
            $get_referal=DB::table('customer')->where('user_code',$referal_code)->first(['wallet_amount','contact','email']);
            $get_wallet=$get_referal->wallet_amount;
            $contact_referal=$get_referal->contact;
            $email_referal=$get_referal->email;
            $referal_amount= $get_wallet + 50;
            $update_referal=DB::table('customer')->where('user_code',$referal_code)->update([
             'wallet_amount'=>$referal_amount ,
            ]);

             $ReferalArr=[
            'remarked'=> '50 Rs Refearal on Mobile No'. " (" . $contact_referal . ")",
            'voucher'=>'Refearal',
            'credit_amount'=>50,
            'debit_amount'=>0,
            'email'=>$email_referal,
            'contact'=>$contact_referal,
         ];
                $ReferalId=DB::table('tbl_payment_history')->insertGetId($ReferalArr);
          }
              $customerArr = [
              'customer_name' => $request->input('customer_name') , 
              'email' => $request->input('email') ,
              'password' => $password ,  
              'encrypt_password'=>$encrypt_password,
              'contact' => $request->input('contact') ,
              'user_code'=>$this->quickRandom(),
              'referal_code'=> $referal_code, 
               ];
              $customerId = DB::table('customer')->insertGetId($customerArr);

               $RoleArr=[
                  'role_id'=>2,
                  'customer_id' =>$customerId,
                  'name'=>$request->input('customer_name') ,
                  'email' =>$request->input('email') ,
                  'password' =>$password ,
                  'encrypt_password'=>$encrypt_password,
                   'contact' => $request->input('contact') ,  
               ];
            
            $roleId = DB::table('role_users')->insertGetId($RoleArr);
            if($roleId){
             $success = true;
              $msg = "Thank You ! Your Registration Successfuly.";
             }else{
                 $success = false;
                  $msg = "An error has occurred. Please try again later";
          } 

        echo json_encode(array(
            'success' => $success,
            'message' => $msg,
            ));  
          }
 public static function quickRandomAjent($length = 16)
{
    $pool = 'abcdefghij1234567890-klmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $refer_code= substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    return $refer_code;
}

public function mobileRecharge(){   
    if (isset($_REQUEST['msg']))
    {
    $msg = $_REQUEST['msg'];
    
    $msgerr = explode("|", $msg);
     $order_id=$msgerr[1]; 
    
    if($msgerr[14] == "0300"){
      //dd($msgerr[14]);
        $upd_paymentstatus=DB::table('tbl_payment')
        ->where('OrderId',$msgerr[1])
        ->update([
       'status'=>'success',
      ]);
        $payment_data=DB::table('tbl_payment')
        ->where('OrderId',$order_id)->first();
        //dd($payment_data);
        if($payment_data == null){
        $contact=$payment_data[0]['contact'];
        $oprater_code=$payment_data[0]['oprator_code'];
        $voucher=$payment_data[0]['voucher'];
        $amount=$payment_data[0]['amount'];
        }else{
            // foreach ($payment_data as $key => $value) {
            //     $contact=$value->contact;
            //     $oprater_code=$value->oprator_code;
            //     $voucher=$value->voucher;
            //     $amount=$value->amount;
            // }
                $contact=$payment_data->contact;
                $oprater_code=$payment_data->oprator_code;
                $voucher=$payment_data->voucher;
                $amount=$payment_data->amount;
        }
        
        
        $agentid=$this->quickRandomAjent();

      $opratorlist=DB::table('oprater')
      ->where('oprater_code',$oprater_code)
      ->where('status',1)->first();
      
      $oprater_name='';
     if($opratorlist == null){
         $oprater_name=$opratorlist[0]['oprater_name'];
     }else{
         $oprater_name=$opratorlist->oprater_name;
     }
     

      $url='https://truejourney.co.in/API/APIService.aspx?userid=9889576340&pass=930591&mob='.$contact.'&opt='.$oprater_code.'&amt='.$amount.'&agentid='.$agentid.'&fmt=Json';
      
    //   $url='https://truejourney.co.in/API/APIService.aspx?userid=9889576340&pass=930591&mob=9450019249&opt=RB&amt=10&agentid=TRW0123456&fmt=Json';

     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_POST, 0);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

     $response = curl_exec ($ch);
     $err = curl_error($ch);  //if you need
     curl_close ($ch);
     $json= json_decode($response, true);
     foreach ($json as $key => $jsonrecharge) {
         $STATUS=$jsonrecharge;
       
     }
    //  $STATUS = 'Transaction successfully done!';
   // dd($STATUS);
     if($STATUS == 'Transaction successfully done!')
     {

         $RechargeArr=[
        'contact'=> $contact,
        'amount'=>$amount,
        'oprater_name'=>$oprater_name,
        'oprater_code'=>$oprater_code,
        'agent_id'=>$agentid,
     ];

     $RechargeId=DB::table('tbl_recharge')->insertGetId($RechargeArr);
      $date=date('d-m-y');
      $d=date("h:i:s");
       $dd=date('h:i A', strtotime($d));
      if($dd == date('h:i A')){
        
         $time=date("h:i:s")."AM";
      }else{
          $date=(date("h:i:s")."PM");
          echo $time;
      }
      $RechargehistArr=[
        'orderID'=> $order_id, 
        'remarked'=> 'Recharge of Rs.'.' '.$amount. ' ' .'is successful for your'.' '.$contact.' ' . $oprater_name . ' '.$voucher.' '.'on'.' '.$date.' '.'at'.' '.$time,
         'oprater_name'=>$oprater_name,
        'voucher'=>$voucher,
        'credit_amount'=>0,
        'debit_amount'=>$amount,
        'contact'=>$contact,
        'signal'=>'web Recharge',
     ];
      $RechargehistId=DB::table('tbl_payment_history')->insertGetId($RechargehistArr);
       $upd_paymentstatus=DB::table('tbl_payment')->where('OrderId',$order_id)->update([
       'recharge_status'=>'Success',
       ]);
       
       $sms_text="Hello Dear
                      Welcome To Truewallet.Thank you for recharge from Truewallet.";
      $api_key='25E47C30E7D7D5';
      $from='FLAWAY';
       
          $ch = curl_init();
          curl_setopt($ch,CURLOPT_URL, "http://unicosms.unicotechnologies.com/app/smsapi/index.php");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=15880&routeid=56&type=text&contacts=".$contact."&senderid=".$from."&msg=".$sms_text);
          $response = curl_exec($ch);
          curl_close($ch);
          
         $token='90f57002e24fb852e014e964845bd637';
          $skey ="SST";
          $number=$contact;
          $sender="ETOPUP";
          $message="Hello Dear
                      Welcome To Truewallet.Thank you for recharge from Truewallet.";
                
          $url="https://www.apihub.online/api/Services/transact?token=".urlencode($token)."&skey=".urlencode($skey)."&to=".urlencode($number)."&sender=".urlencode($sender)."&smstext=".urlencode($message)."&smsformat=".urlencode('TEXT')."&format=".urlencode('html');
          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $curl_scraped_page = curl_exec($ch);
          $response = curl_exec($ch);
          curl_close($ch);

        $upd_paymentstatus=DB::table('tbl_payment')->where('OrderId',$order_id)->update([
               'recharge_status'=>'Success',
                ]);
       return view('front.success',compact('STATUS'));
      }
      else{
         $upd_paymentstatus=DB::table('tbl_payment')->where('OrderId',$order_id)->update([
       'recharge_status'=>'FAILED',
       ]);
           return view('front.recharge_failed',compact('STATUS'));
      }
       return view('front.success');
    }
      else if($msgerr[14] == "0399"){
          $order_id=$msgerr[1];
         $upd_paymentstatus=DB::table('tbl_payment')->where('OrderId',$order_id)->update([
       'status'=>'FAILED',
      ]);
     return view('front.failed');
    }
      return view('front.success');
   }
     else{
        $msg ="NA";
         return view('front.failed');
    }
}

public function mobilepayment(){
        $data=Request::all();
       // dd($data);
        $amount=$data['amount'];
        $phone_number=$data['phone_number'];
        $oprater_code=$data['oprator'];
        $voucher=$data['selector1'];
        $token=$data['_token'];
        $order_id=$this->quickRandomAjent();
        $payment=[
          'OrderId'=> $order_id,
          'contact'=>$phone_number,
          'amount'=>$amount,
          'oprator_code'=>$oprater_code,
          'voucher'=>$voucher,
          'status'=>'Pending'

        ];
         $paymenttId=DB::table('tbl_payment')->insertGetId($payment);

    $str = 'TRUEWALET|'.$order_id.'|NA|'.$amount.'|NA|NA|NA|INR|NA|R|truewalet|NA|NA|F|NA|'.$phone_number.'|NA|NA|NA|NA|NA|NA';
    
    $checksum = hash_hmac('sha256', $str, 'V0rJdW7cV9iI9QaBUZyDNU93nQt2F12D', false);
    $checksum = strtoupper($checksum);
  $data=array(
     'checksum'=>$checksum,
     'str'=>$order_id,
     'amount'=>$amount,
     'str'=>$str,
     'token'=>$token
    );
    echo json_encode($data);
       
     }
     
      public function changePassword()
     {

      $msg = '';
            $success = '';
            $email=auth()->user()->email;
            $customer_email=Request::input('email');
            $old_password=Request::input('old_password');
            $password=Request::input('password');
            $confirm_password=Request::input('confirm_password');

            $old_data=DB::table('role_users')->where('email',$email)->first(['password']);
            $old_pass='';       
            if($old_data == null){
            $old_pass=$old_data[0]['password'];
            }else{

            $old_pass=$old_data->password;
            }
            
            if (Hash::check($old_password, $old_pass)) { 
            if($password == $confirm_password){
            if ($email != null)
            {
            if(auth()->user()->role_id == 1){
              $result1 = DB::table('role_users')->where('email', $email)->update([
            'password' => Hash::make($password),
            'encrypt_password' =>Crypt::encryptString($password) , 
               ]);
            }
            $success = true;
            $msg = "Thank You!Your Password Update Successfully";

            }
            else
            {
            $success = false;
            $msg = "An error has occurred. Please try again later";
            }
            }else{
            $success = false;
            $msg = "Your New Password And Confirm Password Not Match...";
            }
            }else{
            $success = false;
            $msg = "Your Old Password Not Match.";
            }

        echo json_encode(array(
            'success' => $success,
            'message' => $msg,
        ));

     }
     
  /**************Profile change*****************/
   public function editprofile(){
        $email=auth()->user()->email;
         $inputemail=Request::input('email');

                 $msg = '';
                 $success = '';
                  $orignalFile=Request::file('profile_image');
                 $orignalName = time() . '.' . $orignalFile->getClientOriginalName();
                $orignalFile->move(public_path('images/admin') , $orignalName);
                $image_path= 'images/admin/'.$orignalName;
                 
       
       
        if ($inputemail == $email)
        {
              if(auth()->user()->role_id == 1){
                 $result1 = DB::table('role_users')->where('email', $email)->update([
                'image' => $image_path,
                   ]);
              }
           $success = true;
            $msg = "Thank You!Your Profile Update Successfully";

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




  }
  
