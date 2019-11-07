<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Question_info extends Model
{
    use Notifiable;

    protected $table = 'question_info';
}
