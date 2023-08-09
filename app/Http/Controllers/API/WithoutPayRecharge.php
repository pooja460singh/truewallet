<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class WithoutPayRecharge extends Controller
{

	   public static function quickRandomAjent($length = 16)
        {
            $pool = 'abcdefghij1234567890-klmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
            $refer_code= substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
            return $refer_code;
        }
     public function withoutpay_recharge(Request $Request){

     $data=$Request->all();
       // dd($data);
        $amount=$data['amount'];
         $wallet_amount=$data['wallet_amount'];
        $contact=$data['phone_number'];
        $oprater_code=$data['oprator'];
        $voucher=$data['voucher'];
        $signal=$data['signal'];
        $email=$data['email'];
        $order_id=$this->quickRandomAjent();
        $payment=[
          'OrderId'=> $order_id,
          'contact'=>$contact,
          'amount'=>$amount,
          'wallet_amount'=>$wallet_amount,
          'email'=>$email,
          'oprator_code'=>$oprater_code,
          'voucher'=>$voucher,
          'status'=>'Pending',
         'signal_status'=>$signal,

        ];
         $paymenttId=DB::table('tbl_payment')->insertGetId($payment);
         
      $opratorlist=DB::table('oprater')
      ->where('oprater_code',$oprater_code)
      ->where('status',1)
      ->first();
      
     $oprater_name='';
      if($opratorlist == null){
         $oprater_name='null';
      }else{
         $oprater_name=$opratorlist->oprater_name;
      }
        $customer=DB::table('customer')->where('email', $email)->first();
        $walletamount='';
     if($customer == null){
              $walletamount=0;
        }else{
             $walletamount=$customer->wallet_amount;
        }

    $url='https://truejourney.co.in/API/APIService.aspx?userid=9889576340&pass=930591&mob='.$contact.'&opt='.$oprater_code.'&amt='.$wallet_amount.'&agentid='.$order_id.'&fmt=Json';

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
     if($STATUS == 'INVALID ACCESS TOKEN IP 27.0.176.17'){
       $data['msg']='Your Recharge Not Successfuly.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
     }
     else{
     if($STATUS == 'Transaction successfully done!')
     {
     $RechargeArr=[
         'email'=>$email,
        'contact'=> $contact,
        'amount'=>$amount,
        'oprater_name'=>$oprater_name,
        'oprater_code'=>$oprater_code,
        'agent_id'=>$order_id,
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
          'orderID'=>$order_id,
        'remarked'=> 'Recharge of Rs.'.' '.$amount. ' ' .'is successful for your'.' '.$contact. ' ' . $oprater_name . ' ' .$voucher. ' ' .'on'. ' ' .$date.' '.'at'.' '.$time,
        'voucher'=>$voucher,
        'oprater_name'=>$oprater_name,
        'credit_amount'=>0,
        'debit_amount'=>$amount,
        'email'=>$email,
        'contact'=>$contact,
        'signal'=>$signal
     ];
      $RechargehistId=DB::table('tbl_payment_history')->insertGetId($RechargehistArr);
      $cashbackdata=DB::table('oprater')->where('oprater_code',$oprater_code)->where('status',1)->first();
      $cashback_per='';
      $commission_type='';
      if($cashbackdata == null){
        $cashback_per='';
         $commission_type='';
      }else{
        $cashback_per=$cashbackdata->commission_rate;
        $commission_type=$cashbackdata->commission_type;
      }
      if($commission_type == 'Percent'){
        $commission_amount=$amount * $cashback_per /100 ;
      }else if($commission_type == 'Flat'){
         $commission_amount=$cashback_per;
      }else{
           $commission_amount=0;
      }
     
      $CommissionRechargeArr=[
        'email'=>$email,
        'contact'=> $contact,
        'amount'=>$commission_amount,
         'oprater_name'=>$oprater_name,
        'oprater_code'=>$oprater_code,
        'agent_id'=>$order_id,
     ];
     $CommissionRechargeId=DB::table('tbl_wallet')->insertGetId($CommissionRechargeArr);
       $CommissionRechargehisArr=[
        'remarked'=> '1% Cashback on'.' '.$oprater_name.$voucher. ' ' .$contact.' '.'with'.' '. $commission_amount,
        'oprater_name'=>$oprater_name,
        'voucher'=>$voucher,
        'credit_amount'=>$commission_amount,
        'debit_amount'=>0,
        'email'=>$email,
        'contact'=>$contact,
     ];
      $CommissionRechargehisId=DB::table('tbl_payment_history')->insertGetId($CommissionRechargehisArr);
      $cashback_amount=$walletamount - $wallet_amount;
      $customer_upd=DB::table('customer')->where('email',$email)
      ->update([
       'wallet_amount'=>$cashback_amount,
      ]);
      $actual_amount=$cashback_amount + $commission_amount;
      $customer_upd_second=DB::table('customer')->where('email',$email)
      ->update([
       'wallet_amount'=>+$actual_amount,
      ]);
       $upd_paymentstatus=DB::table('tbl_payment')->where('OrderId',$order_id)->update([
        'history_id'=>$RechargehistId,
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
          
         $succes_url=stripslashes(url('app-success'));
          $failed_url=stripslashes(url('app-recharge-failed'));

         $data['msg']='Congrate! Your Recharge Successfuly';
        $data['status']=true;
        $data['success-url']='app-success';
        $myJSON = json_encode($data);
        echo $myJSON; 
       }else{
         $upd_paymentstatus=DB::table('tbl_payment')->where('OrderId',$order_id)->update([
       'recharge_status'=>'FAILED',
       ]);
        $data['msg']='Your Recharge Not Complete Successfuly.';
        $data['status']=false;
        $data['failed-url']='app-recharge-failed';
        $myJSON = json_encode($data);
        echo $myJSON; 
       } 
     }

   }
}
