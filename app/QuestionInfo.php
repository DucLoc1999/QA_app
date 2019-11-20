<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class QuestionInfo extends Model
{
    use Notifiable;

    protected $table = 'question_info';
/*

quest_id
session_id
content
last_action
asker
total_comment
right_answer
created_at
*/
}
