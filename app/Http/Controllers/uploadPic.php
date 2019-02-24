<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem\Storage;
use App\Pic;
use App\Http\Controllers\Controller;

class uploadPic extends Controller
{
    public function uploadPost(Request $request){
    	$rules = [
            'image'=>'mimes:jpeg,jpg,png,gif|required',
        ];

        $data = $this->validate(request(),$rules,[],[
            'image'=>'Image',
        ]
        );
        $data['user_id'] = auth()->guard()->user()->id;
        $data['cmnt'] = $request->cmnt;
        $data['like_count'] = 0;
        $news = Pic::create($data);
        $data['piclink'] = $request->image->store('image/'.$news->id);
        $data['piclink'] = env('APP_URL').'/public/uploads/'.$data['piclink'];
        Pic::where('id',$news->id)->update(['piclink'=>$data['piclink']]);
        $news['like_count'] = $news['like_count'] == 0?'No':$news['like_count'];
        $news['user_name'] = auth()->guard()->user()->username;
        $news['avatar'] = auth()->guard()->user()->avatar;
        $news['piclink'] = $data['piclink'];
        return response(['status'=>true,'data'=>$news]);
    }
}
