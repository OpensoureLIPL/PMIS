<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    
    
    /**
     * For Guard
     *
     * @var Authenticator
     */
    protected $auth;
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
     public function __construct(Guard $auth, User $user)
        {
            
            $this->auth = $auth;        
            $this->middleware('guest', ['except' => 'getLogout']);
        }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
     /* Login get post methods */
    protected function Login() {
        return View('users.login');
    }

    public function Authenticate(LoginRequest $request)
    {
       
       
         if ( $this->auth->attempt($request->only('email', 'password'))) {
           // Authentication passed...
            $data = User::whereEmail($request->only('email'))->first();
            
            \Session::put('user_id', $data->id);
            \Session::put('name', $data->name);
            \Session::put('email', $data->email);
            \Session::put('user_type_id', $data->user_type_id);
            \Session::put('profile_pic', $data->profile_pic);
               
            return redirect()->intended('/dashboard');
        }
          return redirect('/')->withErrors([
            'email' => 'The email or the password is invalid. Please try again.',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    protected function getLogout()
    {
        $this->auth->logout();
        
        return redirect('/');
    } 


}
