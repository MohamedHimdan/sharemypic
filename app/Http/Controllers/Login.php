<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class Login extends Controller
{
    public function login_page(){
    	if(!auth()->guard()->check()){
            return view('login.login');
    	}else{
    		return redirect('/');
    	}
    }
    public function login(Request $request){
            $rememberme = request('rememberme') == 1 ? true:false;
            $user = auth()->guard()->attempt(['username'=>request('username'),'password'=>request('password')],$rememberme);
            if($user){
                $user = auth()->guard()->user();
                //$token = $user->createToken('PersonalToken')->accessToken; // to create personal access token
                return response(['status'=>true]);
            }else{
                return response(['status'=>false]);
            }
    }

    public function register_page(){
    	if(!auth()->guard()->check()){
    		return view('login.register');
    	}else{
    		return redirect('/');
    	}
    }
    public function register(Request $request){
        $rules = [
            'username'=>'required|max:25|unique:users',
            'email'=>'required|email|max:255|unique:users',
            'password'=>'required|min:6|confirmed',
            'password_confirmation'=>'required',
        ];

        $data = $this->validate(request(),$rules,[],[
            'username'=>'Username',
            'email'=>'Email',
            'password'=>'Password',
            'password_confirmation'=>'Confirm password',
            ]
        );
        $created = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar'=> env('APP_URL').'/public/uploads/imgs/no-picture.jpg',
        ]);
        return response(['status'=>true]);
    }

    public function logout(){
        /*auth()->user()->tokens->each(function ($token,$key){
            $token->delete();
        });*/
        auth()->guard()->logout();
        return response()->json('Logged out',200);
    }
}
