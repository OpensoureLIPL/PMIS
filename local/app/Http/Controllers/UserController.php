<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\UserType;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdatePassRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\UpdatePasswordForgotRequest;
use App\Http\Requests\UserRequest;
use Session;
use Input;
use Validator;
use Mail;


class UserController extends Controller{
 public function __construct() { 
   //$this->middleware('revalidate');
   //$this->middleware('auth');
    }
    public function index(){
        
    }
    /*
    *Profile information details of user
    */
   public function userprofile()
    {
    	$id = \Session::get('user_id');
    	$user=User::find($id);
    	$user_type_name = DB::table('users as u')->select('ut.name as type_name')
        ->leftJoin('user_types as ut', 'ut.id', '=', 'u.user_type_id')
        ->where('u.id',$id)->get();
        return view('users.profile', ['title'=>'My Profile', 'user'=>$user,'user_type_name'=>$user_type_name]);
    }
    /*
    *Profile update of user from Own panel
    */
   public function userprofileUpdate(UpdateUserRequest $request)
    {
        $data = $request->all();
        
        if(isset($data['id']) && (int)$data['id'] != 0){
            $user = User::find($data['id']);
        }else{
            $user = new User();
        }
        if ($request->hasFile('profile_pic')){
            
            $filePath = public_path().'\images\profile';
            $file = $request->file('profile_pic');
            $timestamp = rand().time().rand();
            $extension  = $file->getClientOriginalExtension();
            
            $name = $timestamp.'.'.$extension;
            $user->profile_pic = $name;
            $data['profile_pic'] = $name;
            $file->move($filePath, $name);
           
            \File::copy($filePath.'\\'.$name, $filePath.'\thumb\\'.$name);
            \Image::make($filePath.'\thumb\\'.$name)->resize(50,50)->save($filePath.'\thumb\\'.$name);
        }
        if($user->fill($data)->save()){
           
            \Session()->flash('flash_message', 'User Profile updated  successfully!');
            
            return redirect('/profile');
        }else{
             \Session()->flash('error_message', 'Invalid request, please try again!');
             return redirect('/profile');
        }
    }
    /*
    *View page of settings 
    */
    public function settings()
    {
       $user = new User();
         return view('users.settings', ['title'=>'Change Password','user'=>$user]);
       
    }
    /*
    *Update the password from settings form
    */
    public function update_settings(UpdatePassRequest $request)
    {
        $id=\Session::get('user_id');
        $user= User::find($id);
        
        if($user->password == bcrypt($request->input('password')))
        {
            echo "password matched";
            return false;
           \Session()->flash('error_message', 'Please enter new password !'); 
            return redirect('/settings'); 
        }
        else
        {
            //  $user->passowrd=bcrypt($request->input('password'));
            $data['password']=bcrypt($request->input('password'));
            if($user->fill($data)->save()){
              \Session()->flash('flash_message', 'Password updated  successfully!');
            return redirect('/settings');
            }
            else{
              \Session()->flash('error_message', 'Invalid request, please try again!');
              return redirect('/settings');
                }
        }

        
        
    }
    /*
    *View page will be returned for forgot password
    */
    public function viewforgotPassword()
    {
       return view('users.forgotpassword');
    }
    /*
    *Verify the email provided by the user for forgot password
    *Call sendLink method 
    */
    public function forgotPassword(forgotPasswordRequest $request){
        
        $user = DB::table('users')->where('email', $request->input('email'))->first();
       
        if(sizeof($user))
        {

             $succ=DB::table('users')
                        ->where('id', $user->id)
                        ->update(['updated_at' => date('Y-m-d H:i:s')]);
            $this->sendLink(
                $user->id,
                $user->email,
                'emails.forgetPassTemplate',
                'Password Reset Link',
                url('verifyforgotPassword/' . base64_encode( $user->id . '*' . date('Y-m-d H:i:s')))
            );
            return redirect('/forgotpassword')->with('success', ['Check your email inbox for the instruction to change password']);
                
        }
        else{
                 return redirect('/forgotpassword')->with('errors', ['Invalid Credentials']);
                
            }
    
    }
    /*
    *Password reset link will be fired to email account of the user by this function
    *@param $uid user_id
    *@param $email for user email
    *@param $subject for email subject
    *@param $verifyCode is the Verification link
    */
    protected  function sendLink($uid, $email, $template, $subject, $verificationCode) {
            $data = array( 'email' =>$email,'from' => 'info@lipl.in','subject'=>$subject);
            Mail::send(['html' => $template], ['verify_code'=>$verificationCode],function ($message) use ($data) {
            $message->to( $data['email'] )->from( $data['from'])->subject( $data['subject']);
                });

            return true;
     }
     /*
     * Verify the password reset link and redirect to password reset page
     */
     public function verifyforgotPassword($vdata)
     {
           
            $vData = explode('*', base64_decode($vdata));
            
               
            if (count($vData) < 2) {
           return redirect('/forgotpassword')
            ->with('error', ['It seems you just followed a wrong link.Please follow a correct link sent to you']);
                }
            // fetch the user data and match the time 
            $user = User::find($vData[0]);
            if ($user) {
                
                // if link is too old
                if ((strtotime($vData[1]) - strtotime( $user->updated_at)) > (48 * 3600)) {      
                    return redirect('/forgotpassword')
                   ->with('warning', ['Reset password link expired .Please try to reset the password once again']);
                    }
                    else{
                       
                        return view('users.changePass', ['title'=>'Change Password here','user'=>$user]);
                    }
                    
                }
                else
                 {
                    
                return redirect($this->redirectPath())
                   ->with('warning', ['It seems you just followed a wrong link. '
                    . 'Please follow a correct link sent to you.']);
                 }
           
    }   
    /*
    *Update the password from forgotpassword Option
    */
    public function updatepassword(updatePasswordForgotRequest $request)
    {
        
        
             $user= User::find($request->input('id'));
            //  $user->passowrd=bcrypt($request->input('password'));
             $data['password']=bcrypt($request->input('password'));
             if($user->fill($data)->save())
               {
           
              return redirect('/')->with('success', ['Password updated  successfully!']);
               }
             else
                {
                 \Session()->flash('error_message', 'Invalid request, please try again!');
                 return redirect('/forgotpassword');
                }
        
    }
    /*
    *Users list
    */
    public function users()
    {
            $user= DB::table('users')->where('is_trash',0)->get();
            return view('users.userslist', ['users' => $user  ,'title'=>'Users List']);
    }
    /*
    *User create
    */
    public function createUser()
    {
            $user = new User;
            $userType=new UserType();
            $userTypeList   = [''=>'--Select User Type--'] + $userType->where('is_trash',0)->where('is_enable',1)->lists('name', 'id')->toArray();
            
            return view('users.createUser', ['user' => $user,'type'=>' ','parentList'=>$userTypeList,'title'=>'Add New User' ]); 
    }
    /*
    *User Edit
    */
    public function useredit($id)
    {
            $user =  User::find($id);
            $userType=new UserType();
            $userTypeList   = [''=>'--Select User Type--'] + $userType->where('is_trash',0)->where('is_enable',1)->lists('name', 'id')->toArray();
            $type=$user->user_type_id;
            return view('users.createUser', ['user' => $user,'type'=>$type ,'parentList'=>$userTypeList,'title'=>'Update User' ]);

    }
    /*
    *User save or update
    */
    public function usersave(UserRequest $request)
    {
       
            $data = $request->all();
            if(isset($data['id']) && (int)$data['id'] != 0){
                $user = User::find($data['id']);
            }else{
                $user = new User();
            }
            $data['password']=bcrypt($data['password']);
            if($user->fill($data)->save()){
                \Session()->flash('flash_message', 'User data saved successfully!');
            }else{
                \Session()->flash('error_message', 'Invalid request, please try again!');
            }
            return redirect('users');
    }
    /*
    *User Delete
    */
    public function userdelete($id){
        $user = User::find($id);
        $user->is_trash = 1;
        $user->save();
        if($user->save()){
            \Session()->flash('flash_message', 'User deleted successfully!');
        }else{
            \Session()->flash('error_message', 'Invalid request, please try again!');
        }
        return redirect('users');
    }
    /*
    *Action to enable or disable
    */
    public function userAction($id){
        $user = User::find($id);
        
        if(isset($user->is_enable) && $user->is_enable == 1){
            $user['is_enable'] = 0;
        }else{
            $user['is_enable'] = 1;
        }
        if($user->save()){
            if($user->is_enable == 0){
                \Session()->flash('flash_message', 'User disabled successfully!');
            }else{
                \Session()->flash('flash_message', 'User enabled successfully!');
            }
        }else{
            \Session()->flash('error_message', 'Invalid request, please try again!');
        }
        return redirect('users');
    }  


}
