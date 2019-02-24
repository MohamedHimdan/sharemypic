<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noti extends Model
{
    protected $table = 'notis';

    protected $fillable = ['liker_id','reciver_id','post_id','opr','seen'];
    
}
