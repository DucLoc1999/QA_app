<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Question extends Authenticatable
{
    use Notifiable;

    protected $table = 'question';
    protected $fillable = [
        'id', 'content', 'session_id', 'asker_id', 'created_time'
    ];
}
