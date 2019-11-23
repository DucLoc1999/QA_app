<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SurveyOption extends Model
{
    use Notifiable;

    protected $table = 'survey_options';
    protected $fillable = ['survey_id', 'option_num', 'content',];
/*
 *
survey_id
option_num
content
updated_at
created_at
 * */
}
