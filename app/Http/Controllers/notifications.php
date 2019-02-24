<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noti;
use App\User;
use App\Pic;

class notifications extends Controller
{
    public function noti_counter(){
    	$user = auth()->guard()->user()->id;
    	$data = Noti::where('reciver_id','=',$user)->where('seen','=','0')->count('id');
    	if($data){
    		return response(['status'=>true,'data'=>$data]);
    	}else{
			return response(['status'=>false]);
    	}
    }

    public function noti_get(){
    	$userAuth = auth()->guard()->user()->id;
    	$data = Noti::orderBy('id','desc')->where('reciver_id','=',$userAuth)->limit(3)->get();
    	if($data > '[]'){
 			foreach($data as $newData => $key){
 				$user = User::where('id', '=',$data[$newData]['liker_id'])->first();
 				$data[$newData]['liker_id'] = $user->username;
 				$data[$newData]['avatar'] = $user->avatar;
                $data[$newData]['img'] = Pic::where('id','=',$data[$newData]['post_id'])->first()->piclink;
 				//$post = Pic::; //for post info
 			}
    		return response(['status'=>true,'data'=>$data]);
    	}else{
			return response(['status'=>false]);
    	}
    }

    public function noti_update(){
    	$user = auth()->guard()->user()->id;
    	Noti::where('reciver_id',$user)->update(['seen'=>'1']);
    }
}
