<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DB;

class PaymentGateway extends Controller
{

  public function index(){
      $payment_mode=DB::table('tbl_payment_gateway')
      ->get();
      $c=1;
      return view('admin.payment.payment_view',compact('payment_mode','c'));
    }
    
     public function payment_gateway_status(Request $Request) {
        
        $Id =$Request->input('id');
        $affected = DB::table('tbl_payment_gateway')
        ->where('id', $Id)
        ->first();
        if($affected == null){
          $Status='';  
        }else{
            $Status=$affected->status;
        }
        
        $status = $Status;
     
        if ($affected != null) {
            if($status == 'on') {

               $role_users= DB::table('tbl_payment_gateway')
               ->where('status', 'off')
               ->update(['status' => 'on']);

              $role_users= DB::table('tbl_payment_gateway')
               ->where('id', $Id)
               ->update(['status' => 'off']);
               $message='Your payment gateway off successfully';
               
            } elseif($status == 'off') {
               $role_users= DB::table('tbl_payment_gateway')
               ->where('status', 'on')
               ->update(['status' => 'off']);

                $role_users= DB::table('tbl_payment_gateway')
                ->where('id', $Id)
                ->update(['status' => 'on']);
                $message='Your payment gateway on successfully'; 
            }

             return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'An error has occurred. Please try again later.'
            ]);
        }
    }

    //public $razorpayId='rzp_test_8hiQnQB6fWa6dt';
  //public $razorpaykey='6CS9uIZEXSaz6AHRtYixaiID';
  private $razorpayId='rzp_test_M7saxP5WSqpsTw';
  private $razorpaykey='KGiNeOmvHm26HNQHKcdlG0eQ';

  //NUMBER GENERATOR
      /*
 * function to get specific length number or padding with zero
 */
 public static function quickRandomAjent($length = 16)
{
    $pool = 'abcdefghij1234567890-klmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $refer_code= substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    return $refer_code;
}        

 public function payment(Request $Request){

         $data=$Request->all();
       // dd($data);
        $amount=$data['amount'] * 100;
        $phone_number=$data['phone_number'];
        $oprater_code=$data['oprator'];
        $voucher=$data['selector1'];
        $token=$data['_token'];
        $order_id=$this->quickRandomAjent();
        $payment=[
          'OrderId'=> $order_id,
          'contact'=>$phone_number,
          'amount'=>$data['amount'],
          'oprator_code'=>$oprater_code,
          'voucher'=>$voucher,
          'status'=>'Pending'

        ];
         $paymenttId=DB::table('tbl_payment')->insertGetId($payment);


      $api = new Api($this->razorpayId, $this->razorpaykey);

      $order = $api->order->create(array(
      'receipt' => $order_id,
      'amount' => $amount,
      'currency' => 'INR'
      )
      );
      /**********let create response for payment page************/
      $response =[
        'order_id'=>$order['id'],
        'razorpayId'=>$this->razorpayId,
        'amount'=>$amount,
        'name'=>'pooja',
        'email'=>'ps6224220@gmail.com',
        'contactNumber'=>$phone_number,
        'address'=>'ballia',
        'description'=>'Test Description',
        'orderno'=>$order_id,

      ];
       $responseId = DB::table('tbl_response')->insertGetId($response);
           if($responseId)
           {

            $success = true;
            $msg = "Now You Go To Payment Page.";
            $data=$responseId;

           }else{
           $success = false;
           $msg = "An error has occurred. Please try again later.";
         }
            
         // $apiResp = [
         //  'success' => $success,
         //  'message' => $msg,
         //  'response' => $data
         // ];
         //dd($apiResp);
         echo json_encode(array(
          'success' => $success,
          'message' => $msg,
          'response' => $data
        )); 
        // echo json_encode($apiResp);   
      }

      public function payment_complete(Request $Request){

         
         date_default_timezone_set("Asia/Kolkata");
          $time=date('H:i:s');
          $Udate = date('Y-m-d').' '.$time;
          $date=date('Y-m-d').' '.$time;
       
          
         $api = new Api($this->razorpayId, $this->razorpaykey);
          $signature_id=$Request->input('rzp_signature');
          $payment_id =$Request->input('rzp_paymentid');
          $orderId=$Request->input('rzp_orderid');

          $order = $api->order->fetch($orderId);
          $order_Id=$order->receipt;

          $upd_paymentstatus=DB::table('tbl_payment')
        ->where('OrderId',$order_Id)
        ->update([
       'status'=>'success',
        ]);
        $payment_data=DB::table('tbl_payment')
        ->where('OrderId',$order_Id)->first();
        //dd($payment_data);
        if($payment_data == null){
        $contact=$payment_data[0]['contact'];
        $oprater_code=$payment_data[0]['oprator_code'];
        $voucher=$payment_data[0]['voucher'];
        $amount=$payment_data[0]['amount'];
        }else{
            
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
          
  
          
          
    if($signature_id and $payment_id and $orderId){


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
   if($STATUS == 'INVALID ACCESS TOKEN IP 117.96.173.122'){
         return view('front.failed',compact('STATUS'));
   }else{
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
         $upd_paymentstatus=DB::table('tbl_payment')
         ->where('OrderId',$order_Id)
         ->update([
       'recharge_status'=>'FAILED',
       ]);
           return view('front.recharge_failed',compact('STATUS'));
      }
       return view('front.success');
     }
    }else{
         $order_id=$msgerr[1];
         $upd_paymentstatus=DB::table('tbl_payment')->where('OrderId',$order_id)->update([
       'status'=>'FAILED',
        ]);
       return view('front.failed');

     }
  }

       public function payment_view($id){
      $response_data=DB::table('tbl_response')
      ->where('id',$id)
      ->get();
      foreach ($response_data as $key => $data) {
        $razorpayId=$data->razorpayId;
        $order_id=$data->order_id;
        $amount=$data->amount;
        $name=$data->name;
        $email=$data->email;
        $contactNumber=$data->contactNumber;
        $description=$data->description;
        $address=$data->address;
      }
      $response=[
       'order_id'=>$order_id,
       'razorpayId'=>$razorpayId,
       'amount'=>$amount,
       'name'=>$name,
       'email'=>$email,
       'contactNumber'=>$contactNumber,
       'description'=>$description,
       'address'=>$address

      ];
        return view('front.payment',compact('response'));
      }
    
}
