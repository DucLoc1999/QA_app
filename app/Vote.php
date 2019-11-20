<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vote extends Model
{
    use Notifiable;

    protected $table = 'votes';
    protected $fillable = ['survey_id', 'vote', 'user_id'];
/*
survey_id
vote
user_id
updated_at
created_at*/
}
