<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class RechargeController extends Controller
{
             public static function quickRandomAjent($length = 16)
        {
            $pool = 'abcdefghij1234567890-klmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
            $refer_code= substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
            return $refer_code;
        }
    
     public function checksum(Request $Request){
     $data=$Request->all();
       // dd($data);
        $amount=$data['amount'];
         $wallet_amount=$data['wallet_amount'];
        $phone_number=$data['phone_number'];
        $oprater_code=$data['oprator'];
        $voucher=$data['voucher'];
        $signal_status=$data['signal'];
        $email=$data['email'];
        $total_amount=$amount - $wallet_amount; 
        $order_id=$this->quickRandomAjent();
        $payment=[
          'OrderId'=> $order_id,
          'contact'=>$phone_number,
          'amount'=>$amount,
          'wallet_amount'=>$wallet_amount,
          'email'=>$email,
          'oprator_code'=>$oprater_code,
          'voucher'=>$voucher,
          'status'=>'Pending',
          'signal_status'=>$signal_status,

        ];
         $paymenttId=DB::table('tbl_payment')->insertGetId($payment);

  $url="https://truewallet.co.in/api/recharge";
   $base_url=stripslashes('').$url;
   
    $str = 'TRUEWALET|'.$order_id.'|NA|'.$total_amount.'|NA|NA|NA|INR|NA|R|truewalet|NA|NA|F|NA|'.$phone_number.'|NA|NA|NA|NA|NA|';
    
    $checksum = hash_hmac('sha256', $str.$url, 'V0rJdW7cV9iI9QaBUZyDNU93nQt2F12D', false);
    $checksum = strtoupper($checksum);

    
    //   $data=array(
    //  'checksum'=>$checksum,
    //  'str'=>$str,
    // );
    //echo json_encode($data);
        $data['status']=true;
        $data['checksum']=$checksum;
        $data['string']=$str;
        $myJSON = json_encode($data);
        echo $myJSON;
       

  }
    public function pay_recharge(Request $request){
          if (isset($_REQUEST['msg']))
       {
          $msg = $_REQUEST['msg'];
      $msgerr = explode("|", $msg);
     if($msgerr[14] == "0300"){

       $order_id=$msgerr[1]; 
        $upd_paymentstatus=DB::table('tbl_payment')->where('OrderId',$order_id)->update([
       'status'=>'success',
      ]);
        $payment_data=DB::table('tbl_payment')->where('OrderId',$order_id)->first();
         if($payment_data == null){
        $contact=$payment_data[0]['contact'];
        $oprater_code=$payment_data[0]['oprator_code'];
        $voucher=$payment_data[0]['voucher'];
        $amount=$payment_data[0]['amount'];
        $wallet_amount=$payment_data[0]['wallet_amount'];
        $email=$payment_data[0]['email'];
        $signal=$payment_data[0]['signal_status'];
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
                $wallet_amount=$payment_data->wallet_amount;
                $email=$payment_data->email;
                $signal=$payment_data->signal_status;    
        }
        $agentid=$this->quickRandomAjent();
        $recharge_amount=$amount + $wallet_amount;

      $opratorlist=DB::table('oprater')->where('oprater_code',$oprater_code)->where('status',1)->first();
      $oprater_name='';
     if($opratorlist == null){
         $oprater_name=$opratorlist[0]['oprater_name'];
     }else{
         $oprater_name=$opratorlist->oprater_name;
     }
        $customer=DB::table('customer')->where('email', $email)->first();
        $walletamount='';
        if($customer == null){
          $walletamount=$customer[0]['wallet_amount'];
        }else{
             $walletamount=$customer->wallet_amount;
        }
     

    	$url='https://truejourney.co.in/API/APIService.aspx?userid=9889576340&pass=930591&mob='.$contact.'&opt='.$oprater_code.'&amt='.$recharge_amount.'&agentid='.$agentid.'&fmt=Json';

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
        'orderId'=>$order_id,
        'remarked'=> 'Recharge of Rs.'.' '.$amount. ' ' .'is successful for your'.' '.$contact. ' ' . $oprater_name . ' ' .$voucher. ' ' .'on'. ' ' .$date.' '.'at'.' '.$time,
        'voucher'=>$voucher,
        'oprater_name'=>$oprater_name,
        'credit_amount'=>0,
        'debit_amount'=>$amount,
        'email'=>$email,
        'contact'=>$contact,
        'signal'=>$signal,
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
        'agent_id'=>$agentid,
     ];
     $CommissionRechargeId=DB::table('tbl_wallet')->insertGetId($CommissionRechargeArr);
      $CommissionRechargehisArr=[
        'remarked'=> '1% Cashback on'.' '.$oprater_name. ' ' .$voucher.' '.$contact.' '.'with'.' '. $commission_amount,
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

         return view('front.app_success');
    }else{
         $upd_paymentstatus=DB::table('tbl_payment')->where('OrderId',$order_id)->update([
       'recharge_status'=>'FAILED',
       ]);
         return view('front.app_recharge_failed',compact('STATUS'));
       } 
     }
     return view('front.app_success');
    }else if($msgerr[14] == "0399"){
          $order_id=$msgerr[1];
         $upd_paymentstatus=DB::table('tbl_payment')->where('OrderId',$order_id)->update([
       'status'=>'FAILED',
      ]);
     return view('front.app_failed',compact('STATUS'));
    }
    else{
       return view('front.app_failed',compact('STATUS'));
    }
   }
 }



  public function wallet_to_wallet(Request $request){

    $senderId=$request->input('senderId');
    $recieverId=$request->input('recieverId');
    $amount=$request->input('amount');

    $customerId=DB::table('customer')->where('email',$senderId)->orwhere('contact',$senderId)->first();
    $customer_amount='';
    $customer_email='';
     $customer_contact='';
    if($customerId == null){
      $customer_amount= $customerId[0]['wallet_amount'];
       $customer_email= $customerId[0]['email'];
        $customer_contact= $customerId[0]['contact'];
    }else{
         $customer_amount= $customerId->wallet_amount;
         $customer_email= $customerId->email;
         $customer_contact= $customerId->contact;
    }
     $revercustomerId=DB::table('customer')->where('email',$recieverId)->orwhere('contact',$recieverId)->first();
    $rec_customer_amount='';
    $rec_customerId='';
    $rec_contact='';
    if($revercustomerId == null){
      $rec_customer_amount= $revercustomerId[0]['wallet_amount'];
       $rec_customerId= $revercustomerId[0]['email'];
      $rec_contact= $revercustomerId[0]['contact'];
    }else{
         $rec_customer_amount= $revercustomerId->wallet_amount;
          $rec_customerId= $revercustomerId->email;
          $rec_contact= $revercustomerId->contact;
    }
    
    
   
     if($senderId != $recieverId){
    if($customer_amount >= $amount){

    $total_amount=$customer_amount - $amount;
    $update_customer=DB::table('customer')->where('email',$customer_email)->orwhere('contact',$customer_contact)->update([

        'wallet_amount'=>$total_amount,

    ]);
    $reciver_amount=$rec_customer_amount + $amount;
    $update_reccustomer=DB::table('customer')->where('email',$rec_customerId)->orwhere('contact',$rec_contact)->update([

       'wallet_amount'=>$reciver_amount,

    ]);

         $walletArr= [
          'senderId'=>$senderId,
          'recieverId'=>$recieverId,
          'amount'=>$amount,
           ];

          $walletID=DB::table('tbl_wallettowallet')->insertGetId($walletArr);
           if($customer_email != null){
                $WalletRechargehisArr=[
               'remarked'=> $amount. ' ' .'Rs Rechage on'.' '.$rec_contact . ' ' .'Mobile No.',
              'voucher'=>'Wallet',
              'credit_amount'=>0,
              'debit_amount'=>$amount,
              'email'=>$customer_email,
              'contact'=>$customer_contact,
           ];
   }else{
            $WalletRechargehisArr=[
               'remarked'=> $amount. ' ' .'Rs Rechage on'.' '.$rec_contact . ' ' .'Mobile No.',
              'voucher'=>'Wallet',
              'credit_amount'=>0,
              'debit_amount'=>$amount,
              'email'=>$customer_email,
              'contact'=>$customer_contact,
           ];
     
     }
      $WalletRechargehisId=DB::table('tbl_payment_history')->insertGetId($WalletRechargehisArr);

        if($rec_customerId != null)
        {
                $data['msg']='Thank You ! Your Transaction Successfuly.';
                $data['status']=true;
                $myJSON = json_encode($data);
                echo $myJSON;
       }else{
                $data['msg']='Your Transaction Failed.';
                $data['status']=false;
                $myJSON = json_encode($data);
                echo $myJSON;
            } 
        }else{
                $data['msg']='Your wallet amount is low.';
                $data['status']=false;
                $data['amount']=$customer_amount;
                $myJSON = json_encode($data);
                echo $myJSON;
            } 
          }else{
            $data['msg']='You can not send to own number.';
            $data['status']=false;
            $data['amount']=$customer_amount;
            $myJSON = json_encode($data);
            echo $myJSON;
        } 

      }
       public function payment_success(){

      if (isset($_REQUEST['msg']))
    {
       $msg = $_REQUEST['msg'];
      $msgerr = explode("|", $msg);
     if($msgerr[14] == "0300"){
       $data['msg']='Payment Successfuly.';
            $data['status']=true;
            $myJSON = json_encode($data);
            echo $myJSON;
      }else{
            $data['msg']='Payment Failed.';
            $data['status']=false;
            $myJSON = json_encode($data);
            echo $myJSON;
        } 
          }
       }


 }
