<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Question extends Authenticatable
{
    use Notifiable;

    protected $table = 'questions';
    //protected $primaryKey = ['id',];
    //protected $guarded = ['create_time',];
    protected $fillable = ['content', 'session_id', 'asker_id'];
}
