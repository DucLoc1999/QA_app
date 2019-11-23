<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Survey extends Model
{
    use Notifiable;

    protected $table = 'surveys';
    protected $fillable = ['content', 'asker_id', 'session_id',];
/*
 *
id
content
asker_id
sesion_id
updated_at
created_at
 */
}
