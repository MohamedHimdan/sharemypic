<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pic;
use App\User;
use App\Like;

class News extends Controller
{
    public function index(){
    	return view('news');
    }
    //get all news in main page
    public function get_allnews(){
    	$authUser = auth()->guard()->user()->id;
    	$data = Pic::orderBy('id','desc')->paginate(10);
    	foreach($data as $newData => $key){
 			$user = User::where('id', $data[$newData]['user_id'])->first();
 			$data[$newData]['user_name'] = $user->username;
 			$data[$newData]['user_id'] = $user->id;
 			$data[$newData]['avatar'] = $user->avatar;
 			$data[$newData]['like_count'] = $data[$newData]['like_count'] == 0?'No':$data[$newData]['like_count'];
 			$data[$newData]['liked'] = Like::where('user_id','=',$authUser)->where('pic_id','=',$data[$newData]['id'])->count('id') == 1?true:false;
 			//$post = Pic::; //for post info
 		}
    	return response(['data'=>$data]);
    }

    public function news_from($id){
        $authUser = auth()->guard()->user()->id;
        $data = Pic::orderBy('id','desc')->where('id','>',$id)->get();
        foreach($data as $newData => $key){
            $user = User::where('id', $data[$newData]['user_id'])->first();
            $data[$newData]['user_name'] = $user->username;
            $data[$newData]['user_id'] = $user->id;
            $data[$newData]['avatar'] = $user->avatar;
            $data[$newData]['like_count'] = $data[$newData]['like_count'] == 0?'No':$data[$newData]['like_count'];
            $data[$newData]['liked'] = Like::where('user_id','=',$authUser)->where('pic_id','=',$data[$newData]['id'])->count('id') == 1?true:false;
            //$post = Pic::; //for post info
        }
        if($data != '[]'){
            return response(['status'=>true,'data'=>$data]);
        }else{
            return response(['status'=>false]);
        }
    }
}
