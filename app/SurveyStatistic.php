<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SurveyStatistic extends Model
{
    use Notifiable;

    protected $table = 'survey_statistic';
/*
survey_id
asker_id
question
option_num
option_content
total_vote
*/
}
