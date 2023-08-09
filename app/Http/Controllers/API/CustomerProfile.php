<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Crypt;

class CustomerProfile extends Controller
{
    public function changeprofile(Request $request){

        $email=$request->input('email');
       // $contact=$request->input('contact');
        $customer_profile=$request->file('customer_profile');
        $orignalName = time() . '.' . $customer_profile->getClientOriginalName();
        $customer_profile->move(public_path('images/customer') , $orignalName);
        $image_path= 'images/customer/'.$orignalName;

        $data=DB::table('role_users')
          ->where('email',$email)
          ->orwhere('contact',$email)
          ->first();
          $roleId='';      
          if($data == null){
            $roleId=$data[0]['role_id'];
          }else{
             $roleId=$data->role_id;
          }
         
      if($roleId == 1){
        $profile_upd=DB::table('role_users')
        ->where('email',$email)
        ->orwhere('contact',$email)
        ->update([
          'image'=>$image_path,
        ]);
      }else{

         $profile_upd=DB::table('role_users')
        ->where('email',$email)
        ->orwhere('contact',$email)
        ->update([
          'image'=>$image_path,
        ]);

        $customer_profile_upd=DB::table('customer')
        ->where('email',$email)
        ->orwhere('contact',$email)
        ->update([
          'image'=>$image_path,
        ]);
      }
        $roleuser=DB::table('role_users')
        ->where('email',$email)
        ->first();

        if($roleuser == null){
          $image_url='';
        }else{
          $images=$roleuser->image;
          $roleuser->image=stripslashes('public').stripslashes('/').$images;
          $image_url=$roleuser->image;
        }

        if($profile_upd){
         $data=array(
             'msg'=>'Thank You ! Your Profile Image Change Successfuly.',
            'status'=>true,
            'image-path'=>$image_url,
            );
        $myJSON = json_encode($data);
        echo $myJSON;
       }else{
        $data['msg']='Your Profile Image Not Change Successfuly.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
        }  

    }


    public function changepassword(Request $request){

        $email=$request->input('email');
         $old_password=$request->input('old_password');
         $new_password=$request->input('new_password');
          $confirm_password=$request->input('confirm_password');
          
          $old_data=DB::table('role_users')
          ->where('email',$email)
          ->orwhere('contact',$email)
          ->first();
          $old_pass=''; 
          $roleId='';      
          if($old_data == null){
            $old_pass=$old_data[0]['password'];
            $roleId=$old_data[0]['role_id'];
          }else{

            $old_pass=$old_data->password;
             $roleId=$old_data->role_id;
          }

         if (Hash::check($old_password, $old_pass)) { 
            if($new_password == $confirm_password){

        if($roleId == 1){
                $upd_rolepassword=DB::table('role_users')
                ->where('email',$email)
                ->orwhere('contact',$email)->update([
                'password'=>hash::make($new_password), 
                'encrypt_password'=>Crypt::encryptString($request->input('new_password')),

              ]);
          }else{

             $upd_rolepassword=DB::table('role_users')
                ->where('email',$email)
                ->orwhere('contact',$email)
                ->update([
                   'password'=>hash::make($new_password), 
                   'encrypt_password'=>Crypt::encryptString($request->input('new_password')),
              ]);

             $upd_customer_password=DB::table('customer')
             ->where('email',$email)
             ->orwhere('contact',$email)
             ->update([
            'password'=>hash::make($new_password),
            'encrypt_password'=>Crypt::encryptString($request->input('new_password')),
             ]);
          }
        
         if($upd_rolepassword){
         $data['msg']='Your Password Update Successfuly.';
        $data['status']=true;
        $myJSON = json_encode($data);
        echo $myJSON;
        }else{
        $data['msg']='Your Password Update Not  Successfuly.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
        } 
       }else{
        $data['msg']='Your confirm password not match.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
      }
        }else{
        $data['msg']='Your old password not match.';
        $data['status']=false;
        //$data['ol+pass']=$old_pass;
       // $data['new_pass']=hash::make($old_password);
        $myJSON = json_encode($data);
        echo $myJSON;
      }

    }
    public function profile(Request $request){
         
         $email=$request->input('email');
         $profile=DB::table('customer')
         ->join('role_users', 'customer.email','=','role_users.email')
         ->select('customer.*','role_users.address')
         ->where('customer.email',$email)
         ->where('customer.status',1)
         ->get();

         if($profile == null){
          $status='';
          $roleid='';
         }else{

          foreach ($profile as $key => $profile_image) {
             $images=$profile_image->image;
             $profile_image->image=stripslashes('public').stripslashes('/').$images;
                $status=$profile_image->status;
                $roleid=$profile_image->role_id;
          }
          $status;
          $roleid;
         }
          if(!empty($status)){
         $data['msg']='Record Get Successfuly.';
        $data['status']=true;
        $data['responce']=$profile;
        $myJSON = json_encode($data);
        echo $myJSON;
        }else{
        $data['msg']='No Record Found.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
        } 

    }
    
     public function profileupdate(Request $request){

      $email=$request->input('email');
      $name=$request->input('name');
      $address=$request->input('address');

      $upd_role=DB::table('role_users')
      ->where('email',$email)
      ->where('status',1)
      ->update([
        'name'=>$name,
        'address'=>$address,
      ]);
       $upd_customer=DB::table('customer')
       ->where('email',$email)
       ->where('status',1)
       ->update([
        'customer_name'=>$name,
      ]);

       if($email){
       $data['msg']='Your Profile Update Successfuly.';
        $data['status']=true;
        $myJSON = json_encode($data);
        echo $myJSON;
        }else{
        $data['msg']='Your Profile Update Not Successfuly.';
        $data['status']=false;
        $myJSON = json_encode($data);
        echo $myJSON;
        } 
    }
}
