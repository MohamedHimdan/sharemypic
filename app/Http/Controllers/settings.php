<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class settings extends Controller
{
    public function restapi(){
    	return view('settings.restapi',['url'=>env('APP_URL').'/api/']);
    }
}
