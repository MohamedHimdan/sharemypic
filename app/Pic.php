<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    protected $table = 'pics';

    protected $fillable = ['user_id','piclink','cmnt','like_count'];
}
