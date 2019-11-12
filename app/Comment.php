<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Comment extends Authenticatable
{
    use Notifiable;

    protected $table = 'comments';
    //protected $primaryKey = ['id',];
    //protected $guarded = ['create_time',];
    protected $fillable = ['content', 'user_id', 'answer_id', 'is_hidden'];
}
