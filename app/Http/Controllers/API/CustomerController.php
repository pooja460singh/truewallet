<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Crypt;
use Validator;

class CustomerController extends Controller
{

    public static function quickRandom($length = 4)
    {
        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
        $refer_code= substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
        return $refer_code;
    }

    public function customer_register(Request $request){

       $validator= Validator::make($request->all(),[
            'customer_name'=>'required|string',
            'email' =>'required|string|max:255|email|unique:customer',
            'contact' => 'required|string|max:255|unique:customer',
            'password' => 'required|string',
            
        ]);
        $email=$request->input('email');
        $contact=$request->input('contact');
        $password=Hash::make($request->input('password'));
        $encrypt_password=Crypt::encryptString($request->input('password'));
        $referal_code=$request->input('referal_code');

        $customer=DB::table('customer')->where('email',$email)->orwhere('contact',$contact)->get();
      $customer_email='';
      $customer_contact='';
    if($customer == null){
         $customer_email=$customer[0]['email'];
          $customer_contact=$customer[0]['econtactmail'];

    }else{
    foreach ($customer as $key => $customer) {
            $customer_email=$customer->email; 
            $customer_contact=$customer->contact;  
        }
     $customer_email; 
     $customer_contact;  
    }
    
    if($validator){
        if($customer_email != $email and $customer_contact != $contact)
        {
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
              'remarked'=> '50 Rs Refer on Mobile No'. " (" . $contact_referal . ")",
              'voucher'=>'Referal',
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
         $data['msg']='Thank You ! Your Registration Successfuly.';
        $data['status']=true;
        $data['response']=$customerId;
        $myJSON = json_encode($data);
        echo $myJSON;
    }else{
        $data['msg']='Your Registration Not Successfuly.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
    }  
  }else{
        $data['msg']='Your Email Id Or Contact No Already Exist.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
  }
      

}else{
        $data['msg']='Please Enter Email Id Unique.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
    }
   }
}
