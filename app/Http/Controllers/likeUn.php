<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pic;
use App\Like;
use App\Noti;

class likeUn extends Controller
{
    //for like ,unlike picture
    public function likeUn(Request $request){
    	$authUser = auth()->guard()->user()->id;
    	$counter = Pic::where('id','=',$request->id)->first();
    	$check = Like::where('user_id','=',$authUser)->where('pic_id','=',$request->id)->delete();
    	if ($check == 1){
    		Pic::where('id','=',$request->id)->update(['like_count'=>$counter->like_count-1]);
    		$newCounter = Pic::where('id','=',$request->id)->first()->like_count;
    		Noti::where('liker_id','=',$authUser)->where('post_id','=',$request->id)->delete();
    		return response(['status'=>$check,'newCounter'=>$newCounter]);
    	}else{
    		Pic::where('id','=',$request->id)->update(['like_count'=>$counter->like_count+1]);
    		$newCounter = Pic::where('id','=',$request->id)->first()->like_count;
    		Noti::create(['liker_id'=>$authUser,'reciver_id'=>$request->reciver_id,'post_id'=>$request->id,'opr'=>0,'seen'=>0]);
    		Like::create(['user_id'=>$authUser,'pic_id'=>$request->id]);
    		return response(['status'=>$check,'newCounter'=>$newCounter]);
    	}
    }
}
