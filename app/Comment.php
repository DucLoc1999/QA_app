<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Comment extends Authenticatable
{
    use Notifiable;

    protected $table = 'comments';
    protected $fillable = [
        'id', 'content', 'user_id', 'answer_id', 'created_time', 'is_hidden'
    ];
}
