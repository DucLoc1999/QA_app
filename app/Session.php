<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Session extends Authenticatable
{
    use Notifiable;

    protected $table = 'sessions';
    //protected $primaryKey = ['id',];
    //protected $guarded = ['create_time',];
    //protected $fillable = ['topic', 'creator_id', 'password', 'update_time', 'close_time'];
}
