<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class session_img extends Model
{
    protected $table = 'session_img';
    //protected $primaryKey = ['session_id',];
    protected $fillable = ['session_id', 'img_id',];
}
