<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionImg extends Model
{
    protected $table = 'session_img';
    //protected $primaryKey = ['session_id',];
    protected $fillable = ['session_id', 'img_id',];
}
