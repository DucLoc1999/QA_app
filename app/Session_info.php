<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Session_info extends Model
{
    use Notifiable;

    protected $table = 'session_info';
    //protected $primaryKey = ['session_id',];
    //protected $guarded = ['topic', 'password', 'close_time', 'auther', 'create_time', 'quest_num', 'session_img'];
}
