<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Answer extends Authenticatable
{
    use Notifiable;

    protected $table = 'answers';
    protected $fillable = [
        'id', 'content', 'question_id', 'user_id', 'create_time', 'is_hidden'
    ];
}
