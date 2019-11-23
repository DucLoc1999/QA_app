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
option_num
content
total_vote
*/
}
