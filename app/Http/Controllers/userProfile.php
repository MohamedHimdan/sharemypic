<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pic;
use Storage;

class userProfile extends Controller
{
    public function user_profile($id){
    	return view('userProfile');
    }

    public function user_info($id){
    	$data = User::where('username',$id)->first();
    	if($data != ''){
            $data->id == auth()->guard()->user()->id ? $data['loggedUser'] = true:$data['loggedUser'] = false;
    		$data['posts'] = Pic::where('user_id',$data->id)->count('id');
    		return response(['result'=>true,'data'=>$data]);
    	}
    	return response(['result'=>'No User']);
    }

    public function user_pics($id){
    	$id = User::where('username',$id)->first();
    	if($id != ''){
	    	$data = Pic::where('user_id',$id->id)->paginate(6);
	    	if($data != '[]'){
	    		return response(['status'=>true,'data'=>$data]);
	    	}
	    	return response(['status'=>false]);
	    }
	    return response(['status'=>'No User']);
    }

    public function logged_user(){
    	$data['id'] = auth()->guard()->user()->id;
    	$data['username'] = auth()->guard()->user()->username;
    	$data['email'] = auth()->guard()->user()->email;
    	$data['avatar'] = auth()->guard()->user()->avatar;
    	return $data;
    }

    public function updatePic(Request $request){
        $rules = [
            'image'=>'mimes:jpeg,jpg,png,gif|required',
        ];

        $data = $this->validate(request(),$rules,[],[
            'image'=>'Image',
        ]
        );
        $user_id = auth()->guard()->user()->id;
        Storage::deleteDirectory('avatar/'.$user_id);
        $new_avatar = $request->image->store('avatar/'.$user_id);
        $new_link = env('APP_URL').'/public/uploads/'.$new_avatar;
        $data = User::where('id',$user_id)->update(['avatar'=>$new_link]);
        return $data == 1 ? response(['status'=>true,'new_link'=>$new_link]):response(['status'=>false]);
    }
}
