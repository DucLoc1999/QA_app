<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Answer extends Authenticatable
{
    use Notifiable;

    protected $table = 'answers';
    //protected $primaryKey = ['id',];
    //protected $guarded = ['create_time',];
    protected $fillable = [ 'content', 'is_hidden', 'question_id', 'user_id', 'right_answer'];


}
