<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Session extends Authenticatable
{
    use Notifiable;

    protected $table = 'session';
    protected $fillable = [
        'id', 'topic', 'creator_id', 'password', 'created_time', 'update_time', 'close_time'
    ];
}
